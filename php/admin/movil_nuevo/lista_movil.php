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
        <title>TITULARES</title>
        <?php head(); ?>

        <script src="../../../js/jquery-3.4.1.min.js"></script>
        <script src="../../../js/bootstrap.min.js"></script>
        <script src="../../../js/bootbox.min.js"></script>
        <style>
            body {
                margin: 50px 50px;
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
        <style>

        </style>

        <h1 class="text-center" style="margin: 5px ; ">LISTAR TITULARES</h1>

        <div class="row">
            <style>
                a {
                    text-align: center;
                }
            </style>
            <div class="btn-group d-flex w-50" role="group">
                &nbsp; &nbsp; &nbsp;
                <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
                &nbsp; &nbsp; &nbsp;
            </div>


            <table class="table table-bordered table-sm table-hover">

                <thead class="thead-dark">
                    <tr>
                        <!-- <th>ID</th>  -->
                        <th>Movil</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>CP</th>
                        <th>Celular</th>
                        <th>Licencia</th>
                        <th>Estado</th>
                        <th>Tropa</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $con->set_charset("utf8mb4");
                    ?>
                    <?php
                    $sql = "SELECT * FROM completa WHERE 1 ORDER BY movil ASC";
                    $result = $con->query($sql);


                    while ($row = $result->fetch_assoc()) {


                    ?>
                        <form action="borrar_movil.php" method="get">

                            <tr>
                                <!-- <td><?php echo $row['id'] ?></td>  -->
                                <?php
                                $id = $row['id'];
                                $row['id'] ?>
                                <td><?php $numero_de_movil = $row['movil'];
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
                                <?php
                                $status = $row['estado_admin'];
                                $estado = $row['id'];

                                $sql_est = "SELECT * FROM estados_unidades WHERE id = $status ";
                                $result_est = $con->query($sql_est);
                                if ($row_estado = $result_est->fetch_assoc()) {
                                ?>

                                    <td><?php echo $row['nombre_titu'] ?></td>
                                    <td><?php echo $row['apellido_titu'] ?></td>
                                    <td><?php echo $row['dni_titu'] ?></td>
                                    <td><?php echo $row['direccion_titu'] ?></td>
                                    <td><?php echo $row['cp_titu'] ?></td>
                                    <td><?php echo $row['cel_titu'] ?></td>
                                    <td><?php echo $row['licencia_titu'] ?></td>

                                    <td><?php echo $row_estado['nombre'] ?></td>
                                    <td><?php
                                        if ($row['tropa'] != 50) {
                                            echo $row['tropa'];
                                        } else {
                                            echo " ";
                                        }
                                        ?></td>

                                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
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