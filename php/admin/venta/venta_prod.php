<?php session_start();
include "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTOS</title>
    <?php head() ?>
    <script>
        function deleteProd(cod_titular) {

            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                if (result) {
                    window.location = "delete_prod.php?q=" + cod_titular;
                }
            });
        }

        function updateProd(cod_titular) {
            window.location = "edit_prod.php?q=" + cod_titular;
        }
    </script>
</head>

<body>
    <?php

    if ($con->connect_error) {
        die("Error de conexión a la primera base de datos: " . $con->connect_error);
    }

    $sql = "SELECT * FROM productos WHERE 1";
    $listar = $con->query($sql);

    ?>
    <br>
    <a href="new_prod.php" class="btn btn-success btn-sm">Nuevo Producto</a>
    <br>
    <br>
    <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

    <br>
    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>precio</th>
                <th>Stock</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <div>
            <thead>
                <?php

                while ($ver = $listar->fetch_assoc()) {
                ?>
                    <tr>
                        <th><?php echo $ver['id'] ?></th>
                        <th><?php echo $ver['nombre'] ?></th>
                        <th><?php echo $ver['descripcion'] ?></th>
                        <th><?php echo $ver['precio'] ?></th>
                        <th><?php echo $ver['stock'] ?></th>
                        <td> <a class="btn btn-success btn-sm" href="#" onclick="updateProd(<?php echo $ver['id']; ?>)">Editar</td>
                        <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProd(<?php echo $ver['id']; ?>)">Eliminar</td>

                    </tr>
                <?php
                }
                ?>
            </thead>
        </div>
    </table>

    <br><br><br>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php foot() ?>
</body>

</html>