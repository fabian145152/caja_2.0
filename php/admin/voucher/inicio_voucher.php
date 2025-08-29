<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();

$con->set_charset("utf8mb4");

set_time_limit(0);

$sql_borra = "DELETE FROM `voucher_nuevos` WHERE movil >= 'A3000';";
$datos = $con->query($sql_borra);


$sql_cuenta = "SELECT * FROM `voucher_nuevos` WHERE movil >= 'A3000'";
$cuenta = $con->query($sql_cuenta);
$reg_remi = $cuenta->num_rows;
if ($reg_remi > 0) {
    echo "Faltan borrar";
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHER</title>
    <?php head(); ?>

    <script>
        function deleteProduct(cod_voucher) {
            window.location = "borrar_voucher.php?q=" + cod_voucher;
        }

        // Selecciona el enlace por su ID
        var enlace = document.getElementById('miEnlace');

        // Añade un evento de clic al enlace
        enlace.addEventListener('click', function(event) {
            // Evita el comportamiento predeterminado del enlace (navegación)
            event.preventDefault();

            // Muestra un mensaje de alerta
            alert('¡Va a borrar todos los vouher!.....');
        });

        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <style>
        form {
            padding: 5px 1px 1px;
            border: black 1px solid;
        }
    </style>


    <?php
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('Y-m-d');

    $semana = date('W');
    ?>
    <h1 class="text-center" style="margin: 5px ; ">CARGA DE VOUCHER</h1>


    <h5 style="text-align: center;"><?php echo $fechaActual . " " . "Semana: " . $semana ?></h5>
    <div class="row">


        <form method="post" id="addproduct" action="import_voucher.php" enctype="multipart/form-data" role="form">
            &nbsp; &nbsp;
            <input type="file" name="name" id="name" placeholder="Archivo (.xlsx)">
            &nbsp; &nbsp;
            <button type="submit">IMPORTAR</button>
            &nbsp;
        </form>
        &nbsp; &nbsp;

        <form method="post" id="busca" action="buscador_voucher.php" enctype="multipart/form-data" role="form">
            <h6>Buscar x<input type="text" style="width : 100px " id="movil" name="movil" placeholder="MOVIL" autofocus>
                <button>Buscar</button>
                <input type="reset" value="Reset buscador" class="btn btn-success btn-sm">
            </h6>
        </form>
        &nbsp; &nbsp;
        <!--
        <form method="post" action="movil_vou/exportar_tabla.php" enctype="multipart/form-data" role="form">
            <h6>VAUCHIN<input type="text" style="width : 100px " id="v_movil" name="v_movil" placeholder="MOVIL">
                <button>Buscar</button>
                <input type="reset" value="Reset buscador" class="btn btn-success btn-sm">
            </h6>
        </form>
    -->

        &nbsp; &nbsp;&nbsp; &nbsp;
        <form>
            <a href="vacia_tabla_voucher.php" class="btn btn-success btn-sm">Limpiar tabla</a>
            &nbsp; &nbsp;
        </form>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
    </div>

    <?php


    $sql = "SELECT * FROM voucher_nuevos WHERE 1 ORDER BY movil";
    $datos = $con->query($sql);



    ?>
    <h5 style="text-align: center;"><?php echo $datos->num_rows; ?> Voucher importados</h5>


    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">

            <th>id</th>
            <th>V No.</th>
            <th>Competado</th>
            <th>Nom Pasajero</th>
            <th>Movil</th>
            <th>CC</th>
            <th>Fecha</th>
            <th>Reloj</th>
            <th>Peaje</th>
            <th>Equipaje</th>
            <th>Adicional</th>
            <th>Plus</th>
            <th>Total</th>
            <th>Borrar</th>


        </thead>

        <?php

        while ($d = $datos->fetch_assoc()) {
            if ($d['cc'] > 1) {

        ?>
                <tr>
                    <td><?php echo $d['id']; ?></td>
                    <td><?php echo $d['viaje_no']; ?></td>
                    <td><?php echo $d['completado']; ?></td>
                    <td><?php echo $d['nom_pasaj']; ?></td>
                    <td><?php echo $d['movil']; ?></td>
                    <td><?php echo $d['cc']; ?></td>
                    <td><?php echo $d['completado']; ?></td>
                    <td><?php echo $d['reloj']; ?></td>
                    <td><?php echo $d['peaje']; ?></td>
                    <td><?php echo $d['equipaje']; ?></td>
                    <td><?php echo $d['adicional']; ?></td>
                    <td><?php echo $d['plus']; ?></td>
                    <td><?php echo $d['total'] ?></td>

                    <td><a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $d['id'] ?>)">Borrar</a></td>
                </tr>
        <?php
            }
        }
        $sql_borra = "TRUNCATE TABLE vauchin";
        $result = $con->query($sql_borra);
        ?>

    </table>

    <br><br>

    <?php foot(); ?>
</body>

</html>