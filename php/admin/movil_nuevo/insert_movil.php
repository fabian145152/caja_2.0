<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREAR NUMERO</title>
    <?php head() ?>
    <style>
        body {
            zoom: 80%;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CREAR TITULAR Y MOVIL.</h3>
            </div>

            <div class="col-md-12">
                <br><br>
                <form class="form-group" accept=-"charset utf8" action="save_movil.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                    <label class="control-label">NOMBRE</label>
                        <input type="text" class="form-control" placeholder="NOMBRE" required="" name="nombre_titu" id="nombre_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">APELLIDO</label>
                        <input type="text" class="form-control" placeholder="APELLIDO" required="" name="apellido_titu" id="apellido_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">DNI</label>
                        <input type="text" class="form-control" placeholder="DNI" required="" name="dni_titu" id="dni_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">DIRECCION</label>
                        <input type="text" class="form-control" placeholder="DIRECCION" required="" name="direccion_titu" id="direccion_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">CP</label>
                        <input type="text" class="form-control" placeholder="CP" required="" name="cp_titu" id="cp_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">CELULAR</label>
                        <input type="text" class="form-control" placeholder="CELULAR" required="" name="cel_titu" id="cel_titu" autofocus>
                    </div>
                    <div class="form-group">
                    <label class="control-label">LICENCIA</label>
                        <input type="text" class="form-control" placeholder="LICENCIA" required="" name="licencia_titu" id="licencia_titu" autofocus>
                    </div>

                    <div class="form-group">
                    <label class="control-label">MOVIL</label>
                        <input type="text" class="form-control" placeholder="MOVIL" required="" name="movil" id="movil" autofocus>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="CREAR NUEVO TITULAR Y MOVIL">
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="lista_movil.php" class="btn btn-success" value="SALIR">SALIR</a>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="..js/jquery-3.4.1.min.js"> </script>
    <script src="../js/bootstrap.min.js"> </script>
    <?php foot() ?>
</body>

</html>