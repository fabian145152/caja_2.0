<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo $id = $_GET['q'];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETALLES UNIDAD</title>
    <?php head(); ?>


    <style>
        #columnas {
            column-count: 5;
            column-gap: 20px;
            column-rule: 4px dotted gray;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr auto;
            grid-gap: 1px;
        }
    </style>

</head>

<body>
    <?php


    $sql = "SELECT id, 
                    movil,
                    nombre_titu,
                    apellido_titu,
                    dni_titu,
                    direccion_titu,
                    cp_titu,
                    cel_titu,
                    licencia_titu,
                    nombre_chof_1,
                    apellido_chof_1,
                    dni_chof_1,
                    direccion_chof_1,
                    cp_chof_1,
                    dni_chof_1,
                    cel_chof_1,
                    nombre_chof_2,
                    apellido_chof_2,
                    dni_chof_2,
                    direccion_chof_2,
                    cp_chof_2,
                    dni_chof_2,
                    cel_chof_2,
                    marca,
                    modelo,
                    dominio,
                    año,             
                    fecha_inicio,
                    fecha_facturacion,
                    x_semana,
                    x_viaje
                    FROM `completa` WHERE id= $id;";

    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    echo $id_semana = $row['x_semana'];

    $sql_semana = "SELECT * FROM abono_semanal WHERE id = $id_semana";
    $result_semana = $con->query($sql_semana);
    $row_semana = $result_semana->fetch_assoc();

    $importe_semana = $row_semana['importe'];
    $nombre_semana = $row_semana['abono'];

    echo $id_viaje = $row['x_viaje'];

    $sql_viaje = "SELECT * FROM abono_viaje WHERE id = $id_viaje";
    $result_viaje = $con->query($sql_viaje);
    $row_viaje = $result_viaje->fetch_assoc();

    $abono_viaje = $row_viaje['importe'];
    $nombre_viaje = $row_viaje['abono'];

    ?>
    <h1 class="text-center" style="margin: 5px ; ">DETALLES DE LA UNIDAD <?php echo $row['movil'] ?></h1>
    <form class="form-group" accept=-"charset utf8 action="../caja/inicio.php?=" <?php echo $row['movil'] ?> method="post">
        <div class="grid" name="movil">


            <div>
                <ul>

                    <li> &nbsp;&nbsp;Inicio de act.:</li>
                    <li> &nbsp;&nbsp;<?php echo $row['fecha_inicio'] ?> </li>
                    <li></li>
                    <li> &nbsp;&nbsp;Inicio de fact.:</li>
                    <li> &nbsp;&nbsp;<?php echo $row['fecha_facturacion'] ?></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h3>Descripción</h3>
                    </li>
                    <li>Movil:<?php
                                $movil = $row['movil'];
                                echo " " . $movil  ?></li>
                    <li>Licencia: <?php echo " " . $row['licencia_titu'] ?></li>
                    <?php



                    ?>
                    <li>Semana: <?php echo  $nombre_semana . " " . "$" . $importe_semana . "-" ?></li>
                    <li>Viaje: <?php echo $nombre_viaje . " " . "$" . $abono_viaje . "-" ?></li>

                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h3>Titular</h3>
                    </li>
                    <li>Nombre:<?php echo " " . $row['nombre_titu'] ?></li>
                    <li>Apellido:<?php echo " " . $row['apellido_titu'] ?></li>
                    <li>Direccion:<?php echo " " . $row['direccion_titu'] ?></li>
                    <li>Cp:<?php echo " " . $row['cp_titu'] ?></li>
                    <li>Celular: <?php echo " " . $row['cel_titu'] ?></li>
                    <li>DNI: <?php echo $row['dni_titu'] ?></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li>
                        <h3>Chofer Dia:</h3>
                    </li>
                    <li>Nombre Chofer Dia: <?php echo " " . $row['nombre_chof_1'] ?></li>
                    <li>Apellido Chofer Dia: <?php echo " " . $row['apellido_chof_1'] ?></li>
                    <li>Direccion Chofer Dia: <?php echo " " . $row['direccion_chof_1'] ?></li>
                    <li>Cp: <?php echo " " . $row['cp_chof_1'] ?></li>
                    <li>Celular: <?php echo " " . $row['cel_chof_1'] ?></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h3>Chofer Noche</h3>
                    </li>
                    <li>Nombre Chofer Dia: <?php echo " " . $row['nombre_chof_2'] ?></li>
                    <li>Apellido Chofer Dia: <?php echo " " . $row['apellido_chof_2'] ?></li>
                    <li>Direccion Chofer Dia: <?php echo " " . $row['direccion_chof_2'] ?></li>
                    <li>Cp: <?php echo " " . $row['cp_chof_2'] ?></li>
                    <li>Celular: <?php echo " " . $row['cel_chof_2'] ?></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li>
                        <h3>Vehiculo</h3>
                    </li>
                    <li>Marca: <?php echo " " . $row['marca'] ?></li>
                    <li>Modelo:<?php echo " " . $row['modelo'] ?></li>
                    <li>Dominio:<?php echo " " . $row['dominio'] ?></li>
                    <li>Año:<?php echo " " . $row['año'] ?></li>
                </ul>
            </div>

        </div>



        <h1 class="text-center" style="margin: 5px ; "><a href="list_uni_comp.php"> VOLVER</a></h1>


        <?php foot(); ?>
</body>

</html>