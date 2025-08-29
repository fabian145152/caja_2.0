<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTOS</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/columnas.css">
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CREACION DE NUEVOS PRODUCTOS.</h3>
            </div>

            <div class="col-md-12">
                <form class="form-group" accept=-"charset utf8" action="save_prod.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="nombre">Nombre</label>
                        <input type="text" class="form-control" required="" name="nombre" id="nombre" autofocus>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label" for="desc">Descripción</label>
                        <input type="text" class="form-control" required="" name="desc" id="desc" autofocus>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label" for="precio">Precio</label>
                        <input type="text" class="form-control" required="" name="precio" id="precio" autofocus>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label" for="precio">stock</label>
                        <input type="text" class="form-control" required="" name="stock" id="stock" autofocus>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Añadir Productos">
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="venta_prod.php" class="btn btn-success" value="SALIR">SALIR</a>

                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>