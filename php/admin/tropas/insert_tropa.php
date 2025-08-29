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
                <form class="form-group" accept=-"charset utf8" action="save_tropa.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label">NUMERO DE TROPA</label>
                        <input type="text" class="form-control" placeholder="NUMERO DE TROPA" required="" name="tropa" id="tropa" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">MOVILES SEPARADOS POR COMA</label>
                        <input type="text" class="form-control" placeholder="MOVILES" required="" name="moviles" id="moviles" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">NOMBRE</label>
                        <input type="text" class="form-control" placeholder="NOMBRE" name="nombre" id="nombre" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">APELLIDO</label>
                        <input type="text" class="form-control" placeholder="APELLIDO" name="apellido" id="apellido" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">DNI</label>
                        <input type="text" class="form-control" placeholder="DNI" name="dni" id="dni" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">DIRECCION</label>
                        <input type="text" class="form-control" placeholder="DIRECCION" name="direccion" id="direccion" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">CP</label>
                        <input type="text" class="form-control" placeholder="CP" name="cp" id="cp" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">CELULAR</label>
                        <input type="text" class="form-control" placeholder="CELULAR" name="cel" id="cel" autofocus>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="AÑADIR NUEVA TROPA">
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="lista_tropas.php" class="btn btn-success" value="SALIR">SALIR</a>

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