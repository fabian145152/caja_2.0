<?php
session_start();

include_once "../../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");


$tropa = $_POST['tropa'];


$sql_tro = "SELECT * FROM completa WHERE tropa";
$sql_trop = $con->query($sql_tro);
$dato_tropa = $sql_trop->fetch_assoc();
$nombre_titu = $dato_tropa['nombre_titu'];
$apellido_titu = $dato_tropa['apellido_titu'];
$obs = $dato_tropa['obs'];

## Voucher validads
$sql_voucher = "SELECT * FROM voucher_validado WHERE tropa = '$tropa' ORDER BY viaje_no";
$resultado = $con->query($sql_voucher); // Usamos $resultado para mantener consistencia

if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc(); // Obtiene la primera fila como array asociativo
    echo $fila['movil']; // Muestra el valor de la columna 'movil'
} else {
    //echo "No se encontraron resultados.";
}

$sql = "SELECT * FROM completa WHERE tropa = $tropa ORDER BY movil";
$resultado = $con->query($sql);

$moviles = []; // Creamos el array vacío

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $moviles[] = $fila['movil']; // Guardamos cada móvil en el array
    }
}

?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COBRAR TROPAS</title>
    <?php head() ?>
    <link rel="stylesheet" href="../../../css/vista_con_voucher.css">

    <link rel="stylesheet" href="../cobro_moviles/vista_cobro.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function deleteProduct(cod_voucher) {
            //window.location = "borra_voucher.php?q=" + cod_voucher;
            const nuevaVentana = window.open("borra_voucher.php?q=" + cod_voucher, "_blank");
        }

        // Selecciona el enlace por su ID
        var enlace = document.getElementById('miEnlace');

        // Añade un evento de clic al enlace
        enlace.addEventListener('click', function(event) {
            // Evita el comportamiento predeterminado del enlace (navegación)
            event.preventDefault();

            // Muestra un mensaje de alerta
            alert('¡Va a borrar todos los vouher!.....');
        });

        function cerrarPagina() {
            window.close();
        }
    </script>
    <style>
        .zoom-vertical {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        ul {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        #contenedor {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .column {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        h5,
        h6 {
            margin-bottom: 0;
        }

        .recuadros-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            /* Espacio mínimo entre recuadros */
            margin-top: 1px;
            flex-wrap: wrap;
        }

        .recuadro {
            border: 2px solid black;
            padding: 15px;
            border-radius: 10px;
            list-style-type: none;
            width: 480px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            margin: 0;
            /* Elimina margen extra */
        }

        .recuadro+.recuadro {
            margin-left: 10px;
            /* Espacio solo entre recuadros adyacentes */
        }

        .recuadro-botones {
            margin-top: 1px;
            /* Solo un espacio debajo */
            text-align: center;
        }


        .recuadro-botones {
            border: 2px solid black;
            padding: 20px;
            border-radius: 10px;
            width: 500px;
            margin: 30px auto;
            text-align: center;
            background-color: #f1f1f1;
        }

        .botonera {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .botonera button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .botonera button:hover {
            background-color: #0056b3;
        }

        table {
            font-size: 13px;
            /* Tamaño de texto más pequeño */
            border-collapse: collapse;
            margin: 20px auto;
        }

        table th,
        table td {
            padding: 4px 8px;
            /* Menos espacio vertical */
            line-height: 1.2;
            /* Reduce la altura de línea */
            text-align: center;
        }

        table th {
            background-color: #f0f0f0;
        }

        #contenedor {
            padding-bottom: 0px;
        }
    </style>
    <?php foot(); ?>
</head>

<body>
    <div class="zoom-vertical">
        <br>
        <form action="cobro_fin.php" method="post" id="formulario" target="_blank"></form>
        <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
            <div id="contenedor">
                <?php $dia = date("w"); ?>
                <h4>Estado de cuenta de la <strong>TROPA: </strong> <?php echo $tropa . "." ?></h4>
                <h5>Fecha:
                    <?php
                    switch ($dia) {
                        case 0:
                            echo "Domingo";
                            break;
                        case 1:
                            echo "Lunes";
                            break;
                        case 2:
                            echo "Martes";
                            break;
                        case 3:
                            echo "Miércoles";
                            break;
                        case 4:
                            echo "Jueves";
                            break;
                        case 5:
                            echo "Viernes";
                            break;
                        case 6:
                            echo "Sábado";
                            break;
                        default:
                            echo "Día desconocido";
                    }
                    ?>
                    <?php
                    $dia;
                    echo date("d/m/Y");
                    ?>
                    Se le esta cobrando la semana <?php echo $semana = date('W') - 1 ?>
                </h5>
                <!-- <form action="cobro_fin.php" method="post" id="formulario" target="_blank"> -->

                <input type="hidden" id="movil" name="movil" value="<?php echo $movil ?>">


                <div class="column left-column">
                    <h6> <?php echo "<strong>TITULAR: </strong>" . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br>
                </div>
                <div class="column left-column">
                    <?php
                    $obs;

                    echo '';
                    echo "<strong>COMENTARIOS: </strong>" . $obs;

                    ?>
                    <a href="../../observaciones/ver_obs.php?movil=<?php echo $movil ?>" class="btn btn-success" target="_blank">EDITAR</a>
                </div>

            </div>
        </ul>
    </div>

    <div class="recuadros-container">
        <ul class="recuadro">
            <h3>UNIDADES</h3>
            <?php
            $sql = "SELECT * FROM completa WHERE tropa = $tropa ORDER BY movil";
            $resultado = $con->query($sql);

            // Mostrar resultados
            if ($resultado && $resultado->num_rows > 0) {

            ?>
                <table border='1' cellpadding='10' style='margin: 20px auto; border-collapse: collapse;'>
                    <tr>
                        <th>id</th>
                        <th>Movil</th>
                        <th>Apellido</th>
                        <th>Semana</th>
                        <th>Debe</th>
                    </tr>
                    <?php
                    while ($fila = $resultado->fetch_assoc()) {

                        $id_mov = $fila['id'];
                        $mov = $fila['movil'];
                        $ape = $fila['apellido_chof_1'];
                        $x_semana = $fila['x_semana'];
                        $sql_se = "SELECT * FROM semanas WHERE movil=$mov";
                        $res_sem = $con->query($sql_se);
                        $ver_sem = $res_sem->fetch_assoc();
                        $x_se = $ver_sem['x_semana'];
                        $deb_sem = $ver_sem['total'];



                    ?>
                        <tr>
                            <td><?php echo $id_mov ?></td>
                            <td><?php echo $mov ?></td>
                            <td><?php echo $ape ?></td>
                            <td><?php echo $x_se ?></td>
                            <td><?php echo $deb_sem ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <p style='text-align:center;'>No se encontraron registros para la tropa 1.</p>

            <?php
            }
            ?>

        </ul>
        <?php

        // Ejemplo de uso
        foreach ($moviles as $index => $movil) {
            echo "Móvil #" . ($index + 1) . ": " . $movil . "<br>";
        }
        //---------------------------------------------------
        $SSql = "SELECT * FROM voucher_validados WHERE movil = '$movil'";
        $sql_vou = $con->query($SSql);

        // Verificamos si hay resultados
        if ($sql_vou && $sql_vou->num_rows > 0) {
            $sql_voucher = $sql_vou->fetch_assoc();

            // Acceder a los datos
            echo "ID: " . $sql_voucher['id'] . "<br>";
            echo "Móvil: " . $sql_voucher['movil'] . "<br>";
            echo "Fecha: " . $sql_voucher['fecha'] . "<br>";
            echo "Usuario: " . $sql_voucher['usuario'] . "<br>";
            // Agregá más campos según tu estructura de tabla
        } else {
            echo "No se encontraron vouchers para el móvil $movil.";
        }
        //---------------------------------------------------
        ?>
        <ul class="recuadro">

            <h3>VOUCHER</h3>


            <table border='1' cellpadding='10' style='margin: 20px auto; border-collapse: collapse;'>
                <tr>
                    <th>Movil</th>
                    <th>Viaje_no</th>
                    <th>Total</th>
                </tr>

                <tr>
                    <td><?php //echo $movil 
                        ?></td>
                    <td><?php //echo $viaje_no 
                        ?></td>
                    <td><?php //echo $tot_vou 
                        ?></td>
                </tr>

            </table>
        </ul>
    </div>
    <div class="recuadro-botones">

        <div class="botonera">
            <button onclick="accion1()">DEPOSITAR</button>
            <button onclick="accion2()">COBRAR</button>
            <a href="../cobro_moviles/inicio_cobros.php">VOLVER</a>
        </div>
    </div>
    </form>

</body>

</html>