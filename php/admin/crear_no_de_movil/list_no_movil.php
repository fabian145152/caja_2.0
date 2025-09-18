<?php session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUMERO DE MOVIL</title>
    <?php head() ?>
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>

    <script>
        function cerrarPagina() {
            window.close();
        }

        function deleteProduct(cod_titular) {

            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                /* si la funcion no tiene nombre es una funcion anonima function() o function = nombre() */
                if (result) {
                    window.location = "delete_no_movil.php?q=" + cod_titular;
                }
                /* La ?q es como si fuera el metodo $_GET */
            });
        }

        /* ahora viene la funcion update*/
        function updateProduct(cod_titular) {
            window.location = "edit_no_movil.php?q=" + cod_titular;
        }
    </script>
</head>

<body>
    <style>

    </style>

    <h1 class="text-center" style="margin: 5px ; ">LISTAR NUMEROS DE MOVIL</h1>

    <div class="row">
        <style>
            a {
                text-align: center;
            }
        </style>
        <div class="btn-group d-flex w-50" role="group">
            &nbsp; &nbsp; &nbsp;
            <a href="insert_no_movil.php" class="btn btn-primary btn-sm">NUEVO NUMERO DE MOVIL</a>
            &nbsp; &nbsp; &nbsp;
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
            &nbsp; &nbsp; &nbsp;
            <!-- <a href="ListaContacto.php" class="btn btn-primary btn-sm">LISTAR MOVILES</a>  -->
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </div>

    </div>

    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Movil</th>
                <th>Actualizar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM completa WHERE 1 ORDER BY movil ASC";
            $result = $con->query($sql);
            $variable1 = $result->num_rows;

            $sql_semana = "SELECT * FROM semanas WHERE 1";
            $res = $con->query($sql_semana);
            $variable2 = $res->num_rows;
            /*
            $sql_caja = "SELECT * FROM caja_movil WHERE 1";
            $res_caja = $con->query($sql_caja);
            $variable3 = $res_caja->num_rows;
*/
            if ($variable1 !== $variable2) {
                echo "Las variables no son iguales. Deteniendo el programa.";
                exit; // Detener el programa
            }
            while ($row_movil = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td></td>
                    <?php $id = $row_movil['id'] ?>
                    <td><?php $numero_de_movil = $row_movil['movil'];
                        if ($numero_de_movil > 0 && $numero_de_movil <= 9) {
                            echo $numero_de_movil = "000" . $numero_de_movil;
                        }
                        if ($numero_de_movil >= 10 && $numero_de_movil < 100) {
                            echo $numero_de_movil = "00" . $numero_de_movil;
                        }
                        if ($numero_de_movil >= 100 && $numero_de_movil < 1000) {
                            echo $numero_de_movil = "0" . $numero_de_movil;
                        }
                        if ($numero_de_movil >= 1000) {
                            echo $numero_de_movil;
                        }
                        ?>
                    </td>

                    <td> <a class="btn btn-primary btn-sm" href="edit_no_movil.php?q= <?php echo $id ?>">Actualizar</td>
                    <td></td>
                </tr>
                <p></p>
            <?php
            }
            ?>
        </tbody>
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