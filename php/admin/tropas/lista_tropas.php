<?php
include "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TROPAS</title>
    <?php head(); ?>

    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <script>
        function cerrarPagina() {
            window.close();
        }

        function deleteProduct(cod_titular) {

            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                /*  si la funcion no tiene nombre es una funcion anonima function() o function = nombre()  */
                if (result) {
                    window.location = "borrar_tropa.php?q=" + cod_titular;
                }
                /*  La ?q es como si fuera el metodo $_GET */
            });
        }

        /* ahora viene la funcion update*/
        function updateProduct(cod_titular) {
            window.location = "edita_tropa.php?q=" + cod_titular;
        }
    </script>
</head>

<body>

    <h1 class="text-center" style="margin: 5px ; ">LISTAR TROPAS</h1>
    <h4 class="text-center" style="margin: 5px ; ">SI QUEDA UNA SOLA UNIDAD EN LA TROPA CAMBIARLE EL NUMERO DE TROPA A <STRONG>50</STRONG></h4>

    <div class="row">
        <style>
            body {
                margin: 50px 50px;
            }

            a {
                text-align: center;
            }

            body {
                margin: 10px;
            }
        </style>
        <div class="btn-group d-flex w-50" role="group">
            &nbsp; &nbsp; &nbsp;
            <a href="insert_tropa.php" class="btn btn-primary btn-sm">NUEVA TROPA</a>
            &nbsp; &nbsp; &nbsp;
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
        </div>
    </div>
    <br>
    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">

            <tr>
                <th>Tropa Numero</th>
                <th>Movil</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <?php
                $sql = "SELECT * FROM completa WHERE 1 ORDER BY tropa ASC";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {

                    if ($row['tropa'] != 50) {
                        echo "<td>";
                        echo $row['tropa'] . "</td>";
                        echo "<td>";
                        echo $row['movil'] . "</td>";
                        echo "<td>";
                        echo $row['apellido_titu'] . "</td>";
                        echo "<td>";
                        echo $row['nombre_titu'] . "</td>";
                        echo "<td>";
                        $row['movil'] . "</td>";
                ?>

                        <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>

                        <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $row['id']; ?>)">Eliminar</td>

                    <?php

                    }
                    ?>


            </tr>
            </form>
        </tbody>

    <?php } ?>

    <?php foot(); ?>
</body>

</html>