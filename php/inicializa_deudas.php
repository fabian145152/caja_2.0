<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    // Si se envía el formulario
    if (isset($_POST['actualizar'])) {
        // Consulta para actualizar todos los registros
        $sql_completa = "UPDATE completa SET deuda_anterior = 0, 
                                            saldo_a_favor_ft = 0, 
                                            venta_1 = 0, 
                                            venta_2 = 0, 
                                            venta_3 = 0, 
                                            venta_4 = 0, 
                                            venta_5 = 0, 
                                            v_sem_siguiente = 0, 
                                            observaciones_deuda = '' ";

        if ($con->query($sql_completa) === TRUE) {
            echo "<br>";
            echo "Los tabla completa se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar la tabla completa... " . $con->error;
            exit;
        }




        $fecha = date("Y-m-d");
        $sql = "UPDATE semanas SET total = x_semana, fecha = '$fecha'";
        if ($con->query($sql) === TRUE) {
            echo "Los valores se han actualizado correctamente.";
        } else {
            echo "Error al actualizar los valores: " . $con->error;
        }




        $sql_recibo = "UPDATE recibo set numero = 1";

        if ($con->query($sql_recibo) === TRUE) {
            echo "<br>";
            echo "El numero de recibo se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_voucher_nuevos = "TRUNCATE TABLE voucher_nuevos";
        if ($con->query($sql_voucher_nuevos) === TRUE) {
            echo "<br>";
            echo "La tabla voucher nuevos se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_caja_final = "TRUNCATE TABLE caja_final";
        if ($con->query($sql_caja_final) === TRUE) {
            echo "<br>";
            echo "La tabla caja_final se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar la Caja_final: " . $con->error;
            exit;
        }

        $sql_dep_mov = "TRUNCATE TABLE depositos_a_moviles";
        if ($con->query($sql_dep_mov) === TRUE) {
            echo "<br>";
            echo "La tabla depositos a moviles se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar La tabla depositos a moviles: " . $con->error;
            exit;
        }


        $fecha = date("Y-m-d");
        $sql_crea_reg_0 = "INSERT INTO caja_final (movil, fecha) VALUES (0, '$fecha' )";
        $sql_guarda_reg_0 = $con->query($sql_crea_reg_0); // Ejecuta la consulta

        // Verificamos el resultado de la ejecución
        if ($sql_guarda_reg_0 === TRUE) {
            echo "<br>";
            echo "Registro 0 creado exitosamente.";
            echo "<br>";
        } else {
            echo "Error al crear el registro 0: " . $con->error;
            echo "<br>";
            exit;
        }


        $sql_voucher_temporales = "TRUNCATE TABLE voucher_temporales";
        if ($con->query($sql_voucher_temporales) === TRUE) {
            echo "<br>";
            echo "La tabla voucher temporales se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_voucher_validado = "TRUNCATE TABLE voucher_validado";
        if ($con->query($sql_voucher_validado) === TRUE) {
            echo "<br>";
            echo "La tabla voucher validado se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_user_logeado = "TRUNCATE TABLE users_logeado";
        if ($con->query($sql_user_logeado) === TRUE) {
            echo "<br>";
            echo "La tabla usuarios logeados se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }


        // Ejemplo de uso
        $directorio = 'admin/cobros/recibos/';
        if (deleteAllFilesInDirectory($directorio)) {
            echo "<br>";
            echo "Todos los recibos se eliminaron exitosamente.";
            echo "<br>";
        } else {
            echo "Error al eliminar los recibos.";
            //exit;
        }


        $sql_historial_de_pago = "TRUNCATE TABLE historial_de_pago";
        if ($con->query($sql_historial_de_pago) === TRUE) {
            echo "<br>";
            echo "La tabla historial de pago se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }


        echo "<br></BR>";
        echo "<strong>TODOS LOS REGISTROS ACTUALIZADOS CORRECTAMENTE, NINGUNA UNIDAD DEBE NADA</strong>";
        echo "<br></BR>";
        echo "<a href='menu.php'>VOLVER</a>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <?php head() ?>
    </head>

    <body>

        <h1>INICIALIZA PROGRAMA</h1>
        <div class="col-md-3">
            <div class="list-group">
                <form method="post">
                    <button type="submit" name="actualizar" class=" btn btn-success btn-block btn-sm">BORRAR TODAS LAS
                        DEUDAS</button>
                </form>
                <br><br><br>
                <a href="menu.php" class=" btn btn-info btn-block btn-sm">NOBORRAR NADA Y VOLVER AL MENU PRINCIPAL</a>
            </div>
        </div>

    </body>

    </html>


<?php
}
?>