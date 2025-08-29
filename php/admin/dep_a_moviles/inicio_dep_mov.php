<?php
session_start();
if ($_SESSION['logueado']) {
    include_once "../../../funciones/funciones.php";
    $con = conexion();
    $con->set_charset("utf8mb4");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DEPOSITOS A MOVILES</title>
        <?php head(); ?>

        <script src="../../../js/jquery-3.4.1.min.js"></script>
        <script src="../../../js/bootstrap.min.js"></script>
        <script src="../../../js/bootbox.min.js"></script>
        <style>
            body {
                margin: 0px 50px;
            }
        </style>
        <script>
            function deleteProduct(cod_titular) {

                bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                    /*  si la funcion no tiene nombre es una funcion anonima function() o function = nombre()  */
                    if (result) {
                        window.location = "borrar_movil.php?q=" + cod_titular;
                    }
                    /*  La ?q es como si fuera el metodo $_GET */
                });
            }

            /* ahora viene la funcion update*/
            function updateProduct(cod_titular) {
                window.location = "edita_movil.php?q=" + cod_titular;
            }
        </script>
    </head>

    <body>
        <h1 class="text-center" style="margin: 5px ; ">LISTADO DE DEPOSITOS</h1>
        <div class="btn-group d-flex w-50" role="group">
            &nbsp; &nbsp; &nbsp;
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm ">CERRAR PAGINA</button>
            &nbsp; &nbsp; &nbsp;
        </div>
        <div class="row">
            <style>
                a {
                    text-align: center;
                }
            </style>



            <table class="table table-bordered table-sm table-hover">

                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Movil</th>
                        <th>Importe</th>
                        <th>Estado</th>
                        <th>Depositar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $con->set_charset("utf8mb4");
                    ?>
                    <?php
                    $sql = "SELECT * FROM depositos_a_moviles WHERE 1 ORDER BY id DESC";
                    $result = $con->query($sql);


                    while ($row = $result->fetch_assoc()) {


                    ?>
                        <form action="borrar_movil.php" method="get">

                            <tr>
                                <?php

                                $sql_est = "SELECT * FROM depositos_a_moviles WHERE 1";
                                $result_est = $con->query($sql_est);
                                if ($row_estado = $result_est->fetch_assoc()) {
                                ?>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['fecha'] ?></td>
                                    <td><?php echo $row['movil'] ?></td>
                                    <td><?php echo $row['importe'] ?></td>
                                    <td><?php echo $row['est'] ?></td>
                                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Depositar</td>
                                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="deleteProduct(<?php echo $row['id']; ?>)">Eliminar</td>

                                <?php
                                } else {
                                    echo "Error en la consulta " . $con->error;
                                }
                                ?>

                                </td>

                            </tr>
                        </form>

                        <p></p>
                        <script>
                            function cerrarPagina() {
                                window.close();
                            }
                        </script>
                    <?php
                    }
                    foot();
                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>
<?php
}
?>