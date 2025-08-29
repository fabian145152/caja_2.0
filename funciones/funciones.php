<?php

## conexion a la base de datos
function conexion()
{
    $con = new mysqli("127.0.0.1", "root", "belgrado", "acaja", 3306);
    if ($con->connect_errno) {
        echo "<br><br><br><br><br>";
        echo "Fallo al conectar a la DDBB: (" . $con->connect_errno . ") " . $con->connect_error;
    }
    return $con;
}

## actualiza semana
function leerArchivoTXT($rutaArchivo)
{
    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Leer el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);
        return $contenido;
    } else {
        return "El archivo TXT para actualizar semanas no existe.";
    }
}

##Pie depagina
function foot()
{
?>
    <style>
        .footer {
            width: 100%;
            bottom: 0;
            height: 30px;
            position: fixed;
            background: #fff;
            box-shadow: 1px 1px 5px #000;
            text-align: center;
            left: 0;
            /* Alinear con el borde izquierdo de la pantalla */
            right: 0;
            /* Alinear con el borde derecho de la pantalla */
        }
    </style>

    <div class="footer">Ver 1.2</div>
<?php
}

##Encabezado de la pagina
function head()
{
?>
    <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ultima.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootbox.min.js"></script>
<?php
}

## Esta funcion se utiliza para borrar todos los archivos de una carpeta
function deleteAllFilesInDirectory($dir)
{
    // Verificar si el directorio existe
    if (!is_dir($dir)) {
        return false;
    }

    // Obtener los archivos en el directorio
    $files = scandir($dir);

    foreach ($files as $file) {
        // Ignorar los directorios "." y ".."
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Eliminar el archivo
        if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
            unlink($dir . DIRECTORY_SEPARATOR . $file);
        }
    }

    return true;
}

function procesarCobroSemanas($con, $movil)
{
    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    // Consulta SQL para obtener los datos del móvil
    $sql = "SELECT c.movil, c.saldo_a_favor_ft, s.x_semana, s.total, 
                   (c.saldo_a_favor_ft - s.x_semana) AS nuevo_saldo
            FROM completa c
            JOIN semanas s ON c.movil = s.movil
            WHERE c.saldo_a_favor_ft >= s.x_semana AND c.movil = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $movil);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<br>";
            echo "<strong style='color: green;'>Procesando móvil: " . $fila["movil"] . "</strong><br>";

            // Bucle para actualizar hasta que total sea igual a x_semana
            while ($fila["total"] > $fila["x_semana"]) {
                // Restar x_semana a saldo_a_favor_ft en completa
                $sql_update_completa = "UPDATE completa SET saldo_a_favor_ft = saldo_a_favor_ft - ? WHERE movil = ?";
                $stmt_completa = $con->prepare($sql_update_completa);
                $stmt_completa->bind_param("is", $fila["x_semana"], $fila["movil"]);
                $stmt_completa->execute();

                if ($stmt_completa->affected_rows > 0) {
                    echo "<strong style='color: blue;'>✅ Saldo actualizado en 'completa'.</strong><br>";
                } else {
                    echo "<strong style='color: orange;'>⚠ No se pudo actualizar el saldo en 'completa'.</strong><br>";
                    break; // Si no se actualiza, salir del bucle
                }

                // Restar x_semana a total en semanas
                $sql_update_semanas = "UPDATE semanas SET total = total - ? WHERE movil = ?";
                $stmt_semanas = $con->prepare($sql_update_semanas);
                $stmt_semanas->bind_param("is", $fila["x_semana"], $fila["movil"]);
                $stmt_semanas->execute();

                if ($stmt_semanas->affected_rows > 0) {
                    echo "<strong style='color: blue;'>✅ Total actualizado en 'semanas'.</strong><br>";
                } else {
                    echo "<strong style='color: orange;'>⚠ No se pudo actualizar el total en 'semanas'.</strong><br>";
                    break; // Si no se actualiza, salir del bucle
                }

                // Actualizar el valor de total en $fila para la próxima iteración
                $fila["total"] -= $fila["x_semana"];
            }

            echo "<strong style='color: green;'>Debia semanas el móvil: " . $fila["movil"] . "</strong><br><hr>";
        }
    } else {
        echo "<strong style='color: orange;'>⚠ No se descontaron semanas del saldo a favor.</strong>";
    }
}

function debeSemanas($con, $movil)
{
    $sql_sem = $con->query("SELECT * FROM semanas WHERE movil = '$movil'");
    $row = $sql_sem->fetch_assoc();

    if ($row) {
        $imp_sem = $row['total'];
        $imp_x_sem = $row['x_semana'];
        return [
            'total ' => $imp_sem,

            'x_semana ' => $imp_x_sem
        ];
    } else {
        echo "<strong>Error en la lectura de semanas</strong>";
        return null; // Manejo de casos sin resultados
    }
}

//Consulta para actualizar semanas pagadas por movil
function actualizaSemPagadas($con, $movil, $total)
{
    // Definimos la consulta preparada
    $sql_sem = "UPDATE semanas SET total = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_sem);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("ii", $total, $movil);

    if ($stmt->execute()) {
        echo "Semanas actualizadas correctamente.";
        return true;
    } else {
        echo "<strong>Error al actualizar semanas: </strong>" . $stmt->error;
        return false;
    }
}

//Consulta para actualizar ventas de la tabla completa
function actualizaVenta1($con, $movil, $venta_1)
{
    // Definimos la consulta preparada
    $sql_venta = "UPDATE completa SET venta_1 = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_venta);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("di", $venta_1, $movil);

    if ($stmt->execute()) {
        echo "Ventas actualizadas correctamente.";
        return true;
    } else {
        echo "<strong>Error al actualizar venta 1: </strong>" . $stmt->error;
        return false;
    }
}
//Actualiza deuda anterior y sado a favor cuando paga en FT
//Entrar con los nuevos valores de deuda anterior y saldo a favor y movil
function actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5)
{

    // Definimos la consulta preparada

    $sql_deuda = "UPDATE completa SET deuda_anterior = ?, 
                                        saldo_a_favor_ft = ?, 
                                        venta_1 = ?, 
                                        venta_2 = ?, 
                                        venta_3 = ?, 
                                        venta_4 = ?, 
                                        venta_5 = ?
                                          WHERE movil = ?";
    $stmt = $con->prepare($sql_deuda);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("iiiiiiii", $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5, $movil);

    if ($stmt->execute()) {
        
        echo "<br>Deuda anterior y saldo a favor actualizada correctamente.";
        
        return true;
    } else {
        echo "<strong>Error al actualizar deuda anterior: </strong>" . $stmt->error;
        return false;
    }
}

function ultimosDep($con)
{
    // Consulta para obtener el último registro
    $query = "SELECT * FROM caja_final WHERE movil > 0 ORDER BY id DESC LIMIT 1";
    $result = $con->query($query);

    // Verificamos si se obtuvo algún registro
    if ($result && $result->num_rows > 0) {
        // Obtenemos los datos del registro
        $row = $result->fetch_assoc();
        $dep_ft = $row['dep_ft'];
        $dep_mp = $row['dep_mp'];

        // También puedes retornar los valores como array si lo prefieres
        return $row;
    } else {
        echo "<strong>No se encontraron registros. </strong>";
        return null;
    }
}
/*
    Guarda los depositos de caja y suma el valor del registro anterior
    para resumen de caja
*/
function guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones)
{

    //Lee el anteultiomo registro
    $lee_anteultimo_registro = "SELECT saldo_ft, dep_ft, dep_voucher, saldo_voucher FROM caja_final ORDER BY id DESC LIMIT 1";;
    $res_le = $con->query($lee_anteultimo_registro);
    $row_reg = $res_le->fetch_assoc();
    $total_caja = $row_reg['saldo_ft'];
    $total_caja_voucher = $row_reg['saldo_voucher'];



    echo "<br>Total_caja anteultimo registro ft: " . $total_caja;
    echo "<br>Depsoito en ft " . $new_dep_ft;
    $saldo_ft = $new_dep_ft + $total_caja;
    echo "<br>Saldo actual de caja: " . $saldo_ft;





    echo "<br>Total_caja anteultimo registro voucher: " . $total_caja_voucher;
    echo "<br>Depsoito en voucher " . $dep_voucher;
    $saldo_voucher = $dep_voucher + $total_caja_voucher;
    echo "<br>Saldo actual de caja en voucher: " . $saldo_voucher;

    //exit;

    $sql_gua_ca_ft = "INSERT INTO caja_final (movil, fecha, dep_ft, saldo_ft, dep_voucher, saldo_voucher, usuario, observaciones) ";
    $sql_gua_ca_ft .= "VALUES (?,?,?,?,?,?,?,?)";
    $guarda_caja = $con->prepare($sql_gua_ca_ft);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    $guarda_caja->bind_param("isiiiiss", $movil, $fecha, $new_dep_ft, $saldo_ft, $dep_voucher, $saldo_voucher, $usuario, $observaciones);

    if ($guarda_caja->execute()) {

        echo "Datos guardados en caja_final correctamente.";

        return true;
    } else {
        echo "<strong>Error al insertar datos en caja_final: </strong>" . $guarda_caja->error;
        return false;
    }
}


function debitaCaja($con, $movil)
{
    $lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";

    $lee_caja = $con->query($lee_ca);

    // Verificamos si la consulta se ejecutó correctamente
    if (!$lee_caja) {
        die("Error en la consulta: " . $con->error);
    }

    // Verificamos si hay registros antes de acceder a los datos
    if ($row = $lee_caja->fetch_assoc()) {
        return $saldo_leido = $row['saldo_ft']; // Retornamos el saldo
    } else {
        return null; // Retorna null si no hay datos
    }
}

/*
    Lee la deuda anterior
*/
function deudaAnterior($con, $movil)
{
    $stmt = $con->prepare("SELECT * FROM completa WHERE movil = ?");
    $stmt->bind_param("s", $movil); // "s" indica tipo string para $movil
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $deuda_anterior = $row['deuda_anterior'];
    $saldo_a_favor = $row['saldo_a_favor_ft'];
    return $deuda_anterior;
}


function saldoAfavor($con, $movil)
{
    $stmt = $con->prepare("SELECT * FROM completa WHERE movil = ?");
    $stmt->bind_param("s", $movil); // "s" indica tipo string para $movil
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //$deuda_anterior = $row['deuda_anterior'];
    $saldo_a_favor = $row['saldo_a_favor_ft'];
    return $saldo_a_favor;
}


//GUARDA CANTIDAD DE VIAJES QUE SE COBRARAN LA SEMANA SIGUIENTE
function viajesSemSig($con, $movil, $viajes_semana_que_viene)
{


    $sql = "UPDATE completa SET v_sem_siguiente = '$viajes_semana_que_viene' WHERE movil = '$movil'";
    if ($con->query($sql) === TRUE) {
        echo "<br>cantidad de viajes guardados para la semana que viene correctamente";
    } else {
        echo "<br>Error al guardar viajes para la semana que viene: " . $con->error;
    }
}

// GUARDA DEPOSITOS A LOS MOVILES
function depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado)
{




    echo "<br>Resto dep movil dentro de la funcion..." . $resto_dep_mov;

    $stmt = $con->prepare("INSERT INTO depositos_a_moviles (movil, fecha, efectivo, voucher, est) VALUES (?, ?, ?, ?, ?)");


    $stmt->bind_param("isddi", $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    if ($stmt->execute()) {
        echo "<br>Depósito a móvil guardado correctamente.";
    } else {
        echo "<br>Error al depositar al móvil: " . $stmt->error;
    }
    $stmt->close();
}

function efectivoEnCaja($con, $movil, $fecha, $new_dep_ft, $usuario)
{
    $sql_a = $con->prepare("INSERT INTO caja_final (movil, fecha, dep_ft, usuario) VALUES (?,?,?,?)");
    if (!$sql_a) {
        die("<br>Error en la preparación de la consulta: " . $con->error);
    }
    $sql_a->bind_param("idis", $movil, $fecha, $new_dep_ft, $usuario);
    if ($sql_a->execute()) {
        echo "<br>Depósito a móvil guardado correctamente.";
    } else {
        echo "<br>Error al depositar al móvil: " . $sql_a->error;
    }
    $sql_a->close();
}

//Borra los voucher validados
function borraVoucher($con, $movil)
{
    // Verificar conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    // Preparar la consulta
    $stmt = $con->prepare("DELETE FROM voucher_validado WHERE movil = ?");
    // Vincular parámetros
    $stmt->bind_param("i", $movil);
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<br>Registro eliminado correctamente";
    } else {
        echo "<br>Error al eliminar el registro: " . $stmt->error;
    }
    // Cerrar la consulta y la conexión

}

function DescuetaCaja($con, $movil, $para_movil, $usuario, $fecha)
{

    $lee_comp = "SELECT * FROM completa WHERE movil = '$movil'";
    $resu = $con->query($lee_comp);
    $row = $resu->fetch_assoc();
    $saldo_a_favor = $row['saldo_a_favor_ft'];


    $lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
    $lee_caja = $con->query($lee_ca);
    // Verificamos si la consulta se ejecutó correctamente  
    $row = $lee_caja->fetch_assoc();
    $saldo_leido = $row['saldo_ft']; // Retornamos el saldo
    $id = $row['id'];
    echo "<br>Saldo actual de caja: " . $saldo_leido;

    echo "<br>Para movil: " . $para_movil;
    echo "<br>Movil: " . $movil;
    $saldo_caja = $saldo_leido - $para_movil + $saldo_a_favor;
    echo "<br>Saldo descontado de caja: " . $saldo_caja;
    $observaciones = "Al móvil: " . $movil . " Se le depositaran: " . "$" . $para_movil;
    echo "<br>Para guardar en observaciones: " . $observaciones;
    if ($saldo_caja > 0) {
        echo "<br>Sobra plata en caja: ";
        //exit;
        $saldo_a_favor = $para_movil;
    } elseif ($saldo_caja == 0) {
        echo "<br>Caja con saldo 0 ";
    } elseif ($saldo_caja < 0) {
        $saldo_a_favor = 0;
        //echo "<strong style='color: red;'>No hay saldo suficiente en caja para descontar el importe del móvil.</strong>";
        /*
        ?>
               <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
               <script>
                   Swal.fire({
                       icon: "warning",
                       title: "<span style='color: red;'>Saldo insuficiente</span>",
                       html: "<span style='color: red;'>No hay saldo suficiente en caja para descontar el importe al móvil. Deposite mas efectivo...</span>",
                       confirmButtonText: "Aceptar"
                   }).then(() => {
                       // Cerrar la pestaña
                       window.close();

                       // Redireccionar a otra página
                       window.location.href = "inicio_cobros.php";
                   });
               </script>
       <?php
       */
        return; // Salir de la función si no hay saldo suficiente
    }

    $saldo_caja = $saldo_caja + $saldo_a_favor;

    // Preparar la consulta
    $stmt = $con->prepare("INSERT INTO caja_final (saldo_ft, observaciones, fecha, usuario) VALUES (?, ?, ?, ?)");
    // Vincular parámetros
    $stmt->bind_param("dsss", $saldo_caja, $observaciones, $fecha, $usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Saldo registrado correctamente en la caja.";
    } else {
        echo "Error al registrar el saldo en la caja: " . $stmt->error;
    }
}

function saldoCaja($con, $para_movil)
{
    $lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
    $lee_caja = $con->query($lee_ca);
    // Verificamos si la consulta se ejecutó correctamente  
    if ($lee_caja && $row = $lee_caja->fetch_assoc()) {
        $saldo_leido = $row['saldo_ft']; // Guardamos el saldo
        $id = $row['id'];
        //return $saldo_leido; // Retornamos el saldo leído correctamente
    } else {
        echo "<br>Error al obtener el saldo de la caja.";
        return null; // Devolvemos null si hay un error en la consulta
    }
    if ($saldo_leido >= $para_movil) {
        return $saldo_leido; // Retornamos el saldo si es suficiente
    } else {
        /*
    ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: "warning",
                title: "<span style='color: red;'>Saldo insuficiente</span>",
                html: "<span style='color: red;'>No hay saldo suficiente en caja para descontar el importe al móvil. Deposite mas efectivo...</span>",
                confirmButtonText: "Aceptar"
            }).then(() => {
                // Cerrar la pestaña
                window.close();

                // Redireccionar a otra página
                window.location.href = "inicio_cobros.php";
            });
        </script>
        <?php
        */
        //echo "<strong style='color: red;'>No hay saldo suficiente en caja para descontar el importe del móvil.</strong>";
        return null; // Retornamos null si no hay saldo suficiente
    }
}

##Edita solo el campo observaciones de deuda y deuda anteriors
function obsDeuda($con, $movil, $postergar_pago, $mensaje)
{

    if ($postergar_pago > 0) {

        $mensaje;

        $sql_lee = "SELECT * FROM completa WHERE movil = '$movil'";
        $res_lee = mysqli_query($con, $sql_lee);
        if (!$res_lee) {
            echo "<br>Error al leer completa: " . mysqli_error($con);
        }
        $row_comp = mysqli_fetch_assoc($res_lee);
        $observaciones = $row_comp['observaciones_deuda'];

        echo "<br>Observaciones: " . $observaciones;


        $seg = $observaciones . " " . $mensaje;
        echo "<br>Nuevo obs: " . $seg;

        //exit;
        $sql_edi = "UPDATE completa SET observaciones_deuda = '$seg' WHERE movil = '$movil'";
        $res_edi = mysqli_query($con, $sql_edi);
        if (!$res_edi) {
            echo "<br>Error al actualizar postergar pago: " . mysqli_error($con);
        } else {
            echo "<br>Postergar pago actualizado correctamente.";
        }
    }
}
