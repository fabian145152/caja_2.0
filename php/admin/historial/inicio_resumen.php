<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");

//----------ACTUALIZA DEL BALANCE DE CAJA------------------



$leo_caj_1 = "SELECT * FROM caja_final WHERE 1 ORDER BY id DESC LIMIT 10 ";

$res_le_1 = $con->query($leo_caj_1);

//--------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGOS X MOVIL</title>
    <?php head() ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>

</head>

<body>
    <div>
        <h1>HISTORIAL DE PAGOS DEL MOVIL</h1>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">ID</th>
                    <th style="border: 1px solid black; padding: 8px;">FECHA</th>
                    <th style="border: 1px solid black; padding: 8px;">MOVIL</th>
                    <th style="border: 1px solid black; padding: 8px;">FT en caja</th>
                    <th style="border: 1px solid black; padding: 8px;">OBSERVACION</th>
                    <th style="border: 1px solid black; padding: 8px;">USUARIO</th>

                </tr>
            </thead>
            <tbody>

                <?php



                //if ($res_le->num_rows > 0) {

                while ($row = $res_le_1->fetch_assoc()) {
                    $saldo_ft = $row['haber_ft'] - $row['debe_ft'];
                    $saldo_mp = $row['haber_mp'] - $row['debe_mp'];
                ?>
                    <form action="#" method="">
                        <?php
                        ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['id'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['fecha'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['movil'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['dep_ft'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['observaciones'] ?></th>
                            <th style="border: 1px solid black; padding: 8px;"><?php echo $row['usuario'] ?></th>

                        </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</body>

</html>