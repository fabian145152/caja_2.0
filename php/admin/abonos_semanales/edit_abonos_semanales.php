<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


$id_abono = $_GET['q'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTUALIZA ABONO SEMANAL</title>
    <?php head(); ?>
</head>

<body>

    <br>
    <div class="btn-group d-flex w-50">
        <a href="inicio_abonos_semanales.php" class="btn btn-primary btn-sm">VOLVER</a>

    </div>
    <?php
    $sql_abonos = "SELECT * FROM abono_semanal WHERE id='$id_abono'";
    $result = $con->query($sql_abonos);
    $row = $result->fetch_assoc();


    ?>
    <div class="container">
        <h3 class="text-center">ACTUALIZAR IMPORTES SEMANALES</h3>
        <div class="row">
            <br><br>
            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_abonos_semanales.php" method="post">

                    <div class="from-group">
                        <label class="control-label"></label>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                    </div>

                    <div class="from-group">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" name="abono" value="<?php echo $row['abono']; ?>">
                    </div>
                    <br><br>
                    <div class="from-group">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" name="importe" value="<?php echo $row['importe']; ?>">
                    </div>
                    <br><br>
                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR DATOS">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <br><br>
    <?php foot(); ?>
</body>

</html>s