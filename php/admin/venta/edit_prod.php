<?php session_start();
include_once '../../../funciones/funciones.php';
$con = conexion();
$con->set_charset("utf8mb4");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR PRODUCTOS</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/form.css">
</head>

<body>
    <h1>Edit</h1>
    <br>
    <?php

    $id = $_GET['q'];
    echo $id;



    $sql = "SELECT * FROM productos WHERE id=" . $id;
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <div class="container">
        <h3 class="text-center">ACTUALIZAR PRODUCTO</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_prod.php" method="POST">
                    <div class="from-group">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo  $row['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo  $row['descripcion']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo  $row['precio']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" value="<?php echo  $row['stock']; ?>">
                    </div>




                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR PRODUCTO">
                        <br>
                        <br><br>
                        <a href="venta_prod.php" class="btn btn-primary">SALIR</a>
                    </div>
            </div>
        </div>
    </div>

</body>

</html>