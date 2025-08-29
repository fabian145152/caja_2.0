<?php
session_start();
include_once "../../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$sql_contar = "SELECT COUNT(*) AS total FROM completa WHERE estado_admin=1";
$stmt_contar = $con->query($sql_contar);

if ($stmt_contar->num_rows > 0) {
    $row = $stmt_contar->fetch_assoc();
    echo $cant_cargas = $row['total'];
} else {
    echo "0 registros encontrados...";
}

$sql_dia = "SELECT * FROM completa WHERE estado_admin=1";
$sql_al = $con->query($sql_dia);
//$row_al_dia = $sql_al->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIDADES AL DIA</title>
    <?php head() ?>
    <script>
        function deleteProduct(cod_titular) {
            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                if (result) {
                    window.location = "del_uni_comp.php?q=" + cod_uni_comp;
                }
            })
        }

        function detalleProduct(cod_uni_comp) {
            window.location = "det_uni_comp.php?q=" + cod_uni_comp;
        }

        function updateProduct(cod_uni_comp) {
            window.location = "edit_uni_comp.php?q=" + cod_uni_comp;
        }
    </script>
</head>

<body>
    <h2 class="text-center" style="margin: 5px ; ">LISTADO DE UNIDADES CON ABOGADO
        <?php echo $cant_cargas . " UNIDADES CARGADAS." ?>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
        <br>
        <table class=" table table-bordered table-sm table-hover">
            <thead class="thead-dark">
                <tr>

                    <th>Movil</th>
                    <th>Nom Titular</th>
                    <th>Ape Titu</th>
                    <th>Cel titu</th>
                    <th>DNI titu</th>
                    <th>Licencia</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <?php
            while ($row_al_dia = $sql_al->fetch_assoc()) {
            ?>
                <form action="del_uni_comp.php" method="get">
                    <tr>
                        <!-- <th><?php echo $id = $row_al_dia['id'] ?></th> -->
                        <th><?php echo $row_al_dia['movil']; ?></th>

                        <th><?php echo $row_al_dia['nombre_titu'] ?></th>
                        <th><?php echo $row_al_dia['apellido_titu'] ?></th>
                        <th><?php echo $row_al_dia['cel_titu'] ?></th>
                        <th><?php echo $row_al_dia['dni_titu'] ?></th>
                        <th><?PHP echo $row_al_dia['licencia_titu'] ?></th>


                        <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
                        <td><button type="submit" name="q" id="q" value="<?php echo $id ?>" class=" btn btn-danger btn-sm">BORRAR</button>
                    </tr>
                </form>

            <?php
            }
            ?>
            </tr>
        </table>


        <script>
            function cerrarPagina() {
                window.close();
            }
        </script>
        <?php foot() ?>
</body>

</html>