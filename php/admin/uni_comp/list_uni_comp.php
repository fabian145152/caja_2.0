<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$sql_contar = "SELECT COUNT(*) AS total FROM completa";
$stmt_contar = $con->query($sql_contar);

if ($stmt_contar->num_rows > 0) {
    $row_3 = $stmt_contar->fetch_assoc();
    $cant_cargas = $row_3['total'];
} else {
    echo "0 registros encontrados...";
}

$sql_activo = "SELECT * FROM semanas WHERE 1";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI COMPLETAS</title>
    <?php head(); ?>

    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <style>
        select,
        input.texto {
            width: 120px;
        }

        * {
            font-size: 12px;
        }

        a {
            margin-right: 10px;
            /* Separación entre enlaces */
            text-decoration: none;
            /* Sin subrayado */
            color: blue;
            /* Color del texto */
            font-size: 20px;
        }

        a:hover {
            text-decoration: underline;
            /* Subrayado al pasar el mouse */
        }
    </style>
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
    <h2 class="text-center" style="margin: 5px ; ">LISTADO DE UNIDADES COMPLETAS
        <?php echo $cant_cargas . " UNIDADES CARGADAS." ?>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
        &nbsp;&nbsp;<a href="../../ayuda/ayuda.html" target=" _blank">AYUDA</a>
        <div>
            <a href="estado/abogado.php" style="color: red" target="_blank">ABOGADO</a>
            <a href="estado/aldia.php" style="color: cyan" target="_blank">AL DIA</a>
            <a href="#link3" style="color: burlywood;" target="_blank">CARTA</a>
            <a href="#link4" style="color: blue;" target="_blank">DEUDA PENDIENTE</a>
            <a href="#link5" style="color:aqua" target="_blank">MURIO</a>
            <a href="#link6" style="color: gray;" target="_blank">PARA ABOGADO</a>
            <a href="#link7" style="color: greenyellow;" target="_blank">VER</a>
        </div>

    </h2>

    <table class=" table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>

                <th>Movil</th>
                <th>Nom Titular</th>
                <th>Ape Titu</th>
                <th>Cel titu</th>
                <th>DNI titu</th>
                <th>Licencia</th>
                <th>Nom ch. dia</th>
                <th>Ape ch. dia</th>
                <th>Cel ch. dia</th>
                <th>Nom ch. noche</th>
                <th>Ape ch. noche</th>
                <th>Cel noche</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Dominio</th>
                <th>año</th>
               
               
                <th>Detalles</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <?php

        $sql_comp = "SELECT * FROM `completa` WHERE 1 ORDER BY movil";
        $res_comp = $con->query($sql_comp);
        $sel_res_activo = $con->query($sql_activo);
        ?>
        <?php
        while ($row = $res_comp->fetch_assoc()) {
        ?>
            <form action="del_uni_comp.php" method="get">
                <tr>
                    <!-- <th><?php echo $id = $row['id'] ?></th> -->
                    <th><?php echo $movil = $row['movil']; ?></th>

                    <th><?php echo $row['nombre_titu'] ?></th>
                    <th><?php echo $row['apellido_titu'] ?></th>
                    <th><?php echo $row['cel_titu'] ?></th>
                    <th><?php echo $row['dni_titu'] ?></th>
                    <TH><?PHP echo $row['licencia_titu'] ?></TH>
                    <th><?php echo $row['nombre_chof_1'] ?></th>
                    <th><?php echo $row['apellido_chof_1'] ?></th>
                    <th><?php echo $row['cel_chof_1'] ?></th>
                    <th><?php echo $row['nombre_chof_2'] ?></th>
                    <th><?php echo $row['apellido_chof_2'] ?></th>
                    <th><?php echo $row['cel_chof_2'] ?></th>
                    <th><?php echo $row['marca'] ?></th>
                    <th><?php echo $row['modelo'] ?></th>
                    <th><?php echo $row['dominio'] ?></th>
                    <th><?php echo $row['año'] ?></th>
                   <!--
                    <th><?php //echo $row['deuda_anterior'] ?></th>
        -->
                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="detalleProduct(<?php echo $row['id']; ?>)">Detalles</td>
                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
                    <td><button type="submit" name="q" id="q" value="<?php echo $id ?>" class=" btn btn-danger btn-sm">BORRAR</button>
                </tr>
            </form>

        <?php
        }
        ?>
        </tr>
    </table>
    <br><br>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php foot() ?>
</body>

</html>