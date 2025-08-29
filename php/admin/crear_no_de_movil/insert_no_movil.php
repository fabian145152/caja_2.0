<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREAR NUEVO NUMERO</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway&display=swap" rel="stylesheet">
    <?php head() ?>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CREACION NUMEROS DE MOVIL.</h3>
            </div>

            <div class="col-md-12">
                <form class="form-group" accept=-"charset utf8" action="save_no_movil.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="Modelo">MOVIL</label>
                        <input type="text" class="form-control" placeholder="MOVIL" required="" name="id" id="id" autofocus>
                    </div>


                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Añadir Numero de movil">
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="../../menu.php" class="btn btn-success" value="SALIR">SALIR</a>

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