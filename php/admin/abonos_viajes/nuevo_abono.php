<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUEVO IMPORTE</title>
    <?php head(); ?>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CREACION NUMEROS DE MOVIL.</h3>
            </div>

            <div class="col-md-12">
                <form class="form-group" accept=-"charset utf8" action="save_abono.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="Modelo">NOMBRE</label>
                        <input type="text" class="form-control" required="" name="nombre" id="nombre" autofocus>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label" for="Modelo">IMPORTE</label>
                        <input type="text" class="form-control" required="" name="importe" id="importe" autofocus>
                    </div>


                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="NUEVO IMPORTE DE VIAJE">
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="inicio_abonos.php" class="btn btn-success" value="SALIR">SALIR</a>

                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>


    <br><br>
    <?php foot(); ?>
</body>

</html>