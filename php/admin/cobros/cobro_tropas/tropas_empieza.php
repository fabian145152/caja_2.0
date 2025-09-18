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
// 1️⃣ Obtener los móviles de la tropa
$sql = "SELECT movil FROM completa WHERE tropa = $tropa ORDER BY movil";
$resultado = $con->query($sql);

$moviles = [];

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $moviles[] = $fila['movil'];
    }
}

if (!empty($moviles)) {
    $moviles_str = implode(',', $moviles);

    // 2️⃣ Consulta SUM con ajuste por x_semana
    $sql = "SELECT SUM(
                CASE 
                    WHEN total > x_semana THEN total - x_semana
                    ELSE total
                END
            ) AS total_ajustado
            FROM semanas
            WHERE movil IN ($moviles_str)";

    $resultado = $con->query($sql);

    $total_ajustado = 0;

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $total_ajustado = $fila['total_ajustado'];
    }
}


/// Crear placeholders para prepared statement
$placeholders = implode(',', array_fill(0, count($moviles), '?'));

// Consulta usando JOIN para traer x_viaje y el importe de abono_viaje
$sql = "
    SELECT c.movil, c.x_viaje, a.importe
    FROM completa c
    LEFT JOIN abono_viaje a ON c.x_viaje = a.id
    WHERE c.movil IN ($placeholders)
";

$stmt = $con->prepare($sql);

// Tipos de datos, asumimos string para móvil
$tipos = str_repeat('s', count($moviles));
$stmt->bind_param($tipos, ...$moviles);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Movil</th><th>X_Viaje</th><th>Importe</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['movil'] . "</td>";
        echo "<td>" . $row['x_viaje'] . "</td>";
        echo "<td>" . $row['importe'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros para los móviles indicados.";
}



//exit;


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
        function accion1() {
            alert("¡Botón presionado!");
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
        <form action="deposito_tropas.php" method="post" id="formulario" target="_blank">
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
                        $total = $deb_sem - $x_se;




                    ?>
                        <tr>
                            
                            <td><?php echo $mov ?></td>
                            <td><?php echo $ape ?></td>
                            <td><?= number_format($x_se, 2, ',', '.') ?></td>
                            <td><?= number_format($total, 2, ',', '.') ?></td>


                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <h4>Total: <?= number_format($total_ajustado, 2, ',', '.') ?></h4>
            <?php
            } else {
            ?>
                <p style='text-align:center;'>No se encontraron registros para la tropa 1.</p>

            <?php
            }
            ?>

        </ul>
        <ul class="recuadro">

            <h3>VOUCHER</h3>
            <table border='1' cellpadding='10' style='margin: 20px auto; border-collapse: collapse;'>
                <tr>
                    <th>Movil</th>
                    <th>Viaje_no</th>
                    <th>Total</th>
                </tr>

                <?php

                $gran_total = 0; // ya lo tienes
                $total_vouchers = 0; // contador de vouchers

                foreach ($moviles as $index => $movil) {
                    $SSql = "SELECT * FROM voucher_validado WHERE movil = '$movil'";
                    $sql_vou = $con->query($SSql);

                    if ($sql_vou && $sql_vou->num_rows > 0) {
                        while ($sql_voucher = $sql_vou->fetch_assoc()) {
                            $movil_db = $sql_voucher['movil'];
                            $viaje_no = $sql_voucher['viaje_no'];
                            $reloj = $sql_voucher['reloj'];
                            $peaje = $sql_voucher['peaje'];
                            $equipaje = $sql_voucher['equipaje'];
                            $adicional = $sql_voucher['adicional'];
                            $plus = $sql_voucher['plus'];

                            $tot_voucher = $reloj + $peaje + $equipaje + $adicional + $plus;

                            // sumamos al acumulador general
                            $gran_total += $tot_voucher;

                            // ✅ sumamos al contador de vouchers
                            $total_vouchers++;

                ?>
                            <tr>
                                <td><?= $movil_db ?></td>
                                <td><?= $viaje_no ?></td>
                                <td><?= number_format($tot_voucher, 2, ',', '.') ?></td>
                            </tr>
                <?php
                            echo $movil_db;
                        }
                    }
                }

                // cálculos de porcentaje
                $diez = $gran_total * 0.10;
                $noventa = $gran_total * 0.90;
                $para_tropa = $gran_total - $diez;
                $descuento = $gran_total - $para_tropa;
                ?>

                <!-- fila con el total general -->
                <tr style="font-weight:bold; background:#f0f0f0;">
                    <td colspan="2">TOTAL GENERAL</td>
                    <td><?= number_format($gran_total, 2, ',', '.') ?></td>
                </tr>

                <tr style="background:#e0ffe0;">
                    <td colspan="2">VOUCHER VALIDADOS</td>
                    <td><?php echo $total_vouchers ?></td>
                </tr>


                <tr style="background:#e0ffe0;">
                    <td colspan="2">DESCUENTOS</td>
                    <td><?= number_format($para_tropa, 2, ',', '.') ?></td>
                </tr>

                <tr style="background:#e0ffe0;">
                    <td colspan="2">Total de Semanas</td>
                    <td><?= number_format($total_ajustado, 2, ',', '.') ?></td>
                </tr>


                <?php
                $total_trop = $para_tropa - $total_ajustado;


                ?>


                <tr style="background:#ffe0e0;">

                    <td colspan="2">
                        <h4>A DEPOSITAR</h4>
                    </td>
                    <td>
                        <h4><?= number_format($total_trop, 2, ',', '.') ?></h4>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="tropa" name="tropa" value="<?php echo $tropa ?>">

            <?php foreach ($moviles as $movil): ?>
                <input type="hidden" name="moviles[]" value="<?= $movil ?>">
            <?php endforeach; ?>




        </ul>
    </div>
    <div class="recuadro-botones">

        <div class="botonera">
            <a href="../cobro_moviles/inicio_cobros.php">VOLVER</a>
            <button type="submit">DEPOSITAR</button>


        </div>
    </div>
    </form>

</body>

</html>