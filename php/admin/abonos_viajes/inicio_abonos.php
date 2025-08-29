<?php session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABONOS</title>
    <?php head(); ?>
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <script>
        function deleteProduct(cod_titular) {

            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                /*  si la funcion no tiene nombre es una funcion anonima function() o function = nombre()  */
                if (result) {
                    window.location = "delete_abono.php?q=" + cod_titular;
                }
                /*  La ?q es como si fuera el metodo $_GET */
            });
        }


        function updateProduct(cod_titular) {
            window.location = "edit_abono.php?q=" + cod_titular;
        }
    </script>
    <style>
        #Power-Contenedor {
            text-align: center;
        }

        #btn-en-el-medio {
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    $sql_abonos = "SELECT * FROM abono_viaje";
    $result = $con->query($sql_abonos);

    ?>
    <h1 class="text-center">IMPORTES DE VIAJES</h1>

    <div class="btn-group d-flex w-50">

        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="nuevo_abono.php" class="btn btn-primary btn-sm">NUEVO</a>
    </div>
    <br>
    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Importe</th>
                <th></th>
                <th></th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['abono'] ?></td>
                    <td><?php echo $row['importe'] ?></td>
                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
                    <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $row['id']; ?>)">Eliminar producto</td>
                </tr>
            <?php } ?>
        </thead>
    </table>


    <br><br>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php foot(); ?>
</body>

</html>