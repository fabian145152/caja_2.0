<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id_upd = $_GET['q'];
//echo $id_upd;


$sql_movil = "SELECT * FROM completa WHERE id=" . $id_upd;
$result_movil = $con->query($sql_movil);
$row_movil = $result_movil->fetch_assoc();
echo $movil = $row_movil['movil'];
echo "<br>";

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $movil;
$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();
echo $movil_semana = $row_semana['movil'];
echo "<br>";

$sql_caja = "SELECT * FROM caja_movil WHERE movil=" . $movil;
$result_caja = $con->query($sql_caja);
$row_caja = $result_caja->fetch_assoc();
echo $movil_caja = $row_caja['movil'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar-products</title>
    <?php head() ?>
</head>

<body>

    <?php



    ?>

    <div class="container">
        <h3 class="text-center">ACTUALIZAR NUMEROS DE MOVIL</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_no_movil.php" method="post">
                    <div class="from-group">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">movil</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $row_movil['movil']; ?>">
                    </div>

                    <div class="form-group">

                        <input type="hidden" class="form-control" id="semana_movil" name="semana_movil" value="<?php echo $row_semana['movil']; ?>">
                    </div>



                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR MOVIL">
                        <br>
                        <br><br>
                        <a href="list_no_movil.php" class="btn btn-primary">SALIR</a>
                    </div>
            </div>
        </div>
    </div>

    <?php foot() ?>

</html>