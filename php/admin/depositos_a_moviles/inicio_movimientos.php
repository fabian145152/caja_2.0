<?php
$cantidad = 100;
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = intval($_POST["cantidad"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPOSITOS</title>
    <?php head() ?>
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <script>
        function deleteProd(cod_titular) {
            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                if (result) {
                    window.location = "del_movimiento.php?q=" + cod_titular;
                }
            });
        }

        function extraeProd(cod_titular) {
            window.location = "estado_movimiento.php?q=" + cod_titular;
        }

        function guardaProd(cod_titular) {
            bootbox.confirm("Va a guardar en saldo a cuenta" + cod_titular, function(result) {
                if (result) {
                    window.location = "guarda_movimiento.php?q=" + cod_titular;
                }
            });
        }
    </script>
</head>

<body>

    <h1 class="text-center" style="margin: 5px ; ">DEPOSITOS A MOVILES</h1>
    <div class="row">
        <style>
            a {
                text-align: center;
            }
        </style>
        <form method="post" action="">
            &nbsp; &nbsp;
            <label for="cantidad">Cantidad de registros a mostrar:</label>
            <input type="number" id="cantidad" name="cantidad" value="10" min="1" required>
            <input type="submit" class="btn btn-secondary btn-sm" value="Ver registros">
            <style>
                thead #aaa {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                tr #aaa {
                    text-align: center;
                    padding: 10px;
                }
            </style>
        </form>




        <div class="btn-group d-flex w-50" role="group" style="width: 50%; margin: 0 auto;">




            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm w-auto">CERRAR PAGINA</button>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </div>
    </div>
    <br>
    <table border="1" style="width: 30%; margin: 0 auto; text-align: center;">
        <thead>
            <tr>
                <th>Depositados</th>
                <th>No depositados</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" checked disabled>
                </td>
                <td><input type="checkbox" readonly disabled></td>
            </tr>
        </tbody>
    </table>



    <table class="table table-bordered table-sm table-hover" style="width: 70%; margin: 0 auto;">
        <div>
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>

                    <th>Movil</th>
                    <th>Fecha</th>
                    <th>Deposito</th>
                    <th>voucher</th>
                    <th>Estados</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

            </thead>
            <br>
            <?php
            $sql_listado = "SELECT * FROM depositos_a_moviles ORDER BY id DESC LIMIT $cantidad";
            $sql_lis = $con->query($sql_listado);
            while ($sql_lista = $sql_lis->fetch_assoc()) {


            ?>
                <form action="">
                    <tr>

                        <th><?php echo $sql_lista['id'] ?></th>


                        <th><?php echo $sql_lista['movil'] ?></th>
                        <th><?php echo $sql_lista['fecha'] ?></th>
                        <th><?php echo $sql_lista['efectivo'] ?></th>
                        <th><?php echo $sql_lista['voucher'] ?></th>



                        <td><input type="checkbox" name="opciones[]" value="<?php echo $sql_lista['id']; ?>" <?php echo ($sql_lista['est'] == 1) ? 'checked' : ''; ?> disabled></td>
                        <td> <a class="btn btn-primary btn-sm" href="#" onclick="extraeProd(<?php echo $sql_lista['id']; ?>)">Depositar</td>
                        <td> <a class="btn btn-secondary btn-sm" href="#" onclick="guardaProd(<?php echo $sql_lista['id']; ?>)">Guarda a cuenta</td>



                        <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProd(<?php echo $sql_lista['id']; ?>)">Eliminar</td>



                    </tr>
                </form>
            <?php
            }
            ?>
            <script>
                function cerrarPagina() {
                    window.close();
                }
            </script>
            <?php foot()    ?>
        </div>
    </table>
    <br><br>
</body>

</html>