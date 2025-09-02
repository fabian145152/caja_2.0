<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");

//----------ACTUALIZA DEL BALANCE DE CAJA------------------




$leo_caj_1 = "SELECT * FROM caja_final WHERE 1 ORDER BY id DESC ";

$res_le_1 = $con->query($leo_caj_1);

//echo $leo_caj_1['dep_ft'];
//--------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESUMEN DE CAJA</title>
    <?php head() ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>

</head>

<body>
    <div>
        <h1>Resumen de caja</h1>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>



        <div style="display: flex; justify-content: center; align-items: flex-start; height: 100vh; padding-top: 20px;">
            <table style="border-collapse: collapse; width: 80%; text-align: center;">
                <thead>
                    <tr>

                        <th style="border: 1px solid black; padding: 5px;">FECHA</th>
                        <th style="border: 1px solid black; padding: 5px;">MOVIL</th>
                        <th style="border: 1px solid black; padding: 5px;">ULT DEP FT</th>
                        <th style="border: 1px solid black; padding: 5px;">TOTAL EN FT</th>
                        <th style="border: 1px solid black; padding: 5px;">ULT DEP VOUCHER </th>
                        <th style="border: 1px solid black; padding: 5px;">TOTAL EN VOUCHER</th>
                        <th style="border: 1px solid black; padding: 5px;">PAGA DE VIAJES</th>
                        <th style="border: 1px solid black; padding: 5px;">USUARIO</th>
                        <th style="border: 1px solid black; padding: 5px;">OBSERVACIONES</th>

                    </tr>
                </thead>
                <tbody>

                    <?php



                    //if ($res_le->num_rows > 0) {

                    while ($row = $res_le_1->fetch_assoc()) {
                        $dep_ft = $row['dep_ft'] . "<br><br>";
                        $saldo_caja = $row['saldo_ft'] . "<br>";
                        $dep_ft = abs($dep_ft);
                        $saldo_caja = abs($saldo_caja);

                        $tot_caja = $dep_ft + $saldo_caja;




                        $saldo_ft = $row['haber_ft'] - $row['debe_ft'];
                        $saldo_mp = $row['haber_mp'] - $row['debe_mp'];
                    ?>
                        <form action="#" method="">
                            <?php
                            $deposito_ft = $row['dep_ft'];
                            $pesos = number_format($deposito_ft, 2, ',', '.');
                            $saldo_caja = $row['saldo_ft'];
                            $saldo_ca = number_format($saldo_caja, 2, ',', '.');
                            $viajes = $row['paga_de_viajes'];

                            ?>
                            <tr>

                                <th style="border: 1px solid black; padding: 3px;"><?php $fechazz = $row['fecha'];
                                                                                    echo substr($fechazz, 0, 10)  ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $row['movil'] ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $pesos ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $saldo_ca ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $row['diez'] ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $row['noventa'] ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $viajes ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $row['usuario'] ?></th>
                                <th style="border: 1px solid black; padding: 3px;"><?php echo $row['observaciones'] ?></th>

                            </tr>
                        <?php
                    }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>