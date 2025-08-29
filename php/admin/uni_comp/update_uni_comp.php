<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    echo $id = $_POST['id'];
    echo "<br>";
    echo $movil = $_POST['movil'];
    echo "<br>";
    echo $nombre_titu = $_POST['nom_titu'];
    echo "<br>";
    echo $apellido_titu = $_POST['ape_titu'];
    echo "<br>";
    echo $dni_titu = $_POST['dni_titu'];
    echo "<br>";
    echo $dir_titu = $_POST['dir_titu'];
    echo "<br>";
    echo $cp_titu = $_POST['cp_titu'];
    echo "<br>";
    echo $cel_titu = $_POST['cel_titu'];
    echo "<br>";
    echo $licencia = $_POST['licencia'];
    echo "<br>";
    echo $nombre_chof_1 = $_POST['nom_chof_1'];
    echo "<br>";
    echo $ape_chof_1 = $_POST['ape_chof_1'];
    echo "<br>";
    echo $dni_chof_1 = $_POST['dni_chof_1'];
    echo "<br>";
    echo $dir_chof_1 = $_POST['dir_chof_1'];
    echo "<br>";
    echo $cp_chof_1 = $_POST['cp_chof_1'];
    echo "<br>";
    echo $cel_chof_1 = $_POST['cel_chof_1'];
    echo "<br>";
    echo $nombre_chof_2 = $_POST['nom_chof_2'];
    echo "<br>";
    echo $ape_chof_2 = $_POST['ape_chof_2'];
    echo "<br>";
    echo $dni_chof_2 = $_POST['dni_chof_2'];
    echo "<br>";
    echo $dir_chof_2 = $_POST['dir_chof_2'];
    echo "<br>";
    echo $cp_chof_2 = $_POST['cp_chof_2'];
    echo "<br>";
    echo $cel_chof_2 = $_POST['cel_chof_2'];
    echo "<br>";
    echo $marca = $_POST['marca'];
    echo "<br>";
    echo $modelo = $_POST['modelo'];
    echo "<br>";
    echo $dominio = $_POST['dominio'];
    echo "<br>";
    echo $año = $_POST['año'];
    echo "<br>";

    echo $x_viaje = $_POST['x_viaje'];
    echo "<br>";
    echo $x_semana = $_POST['x_semana'];
    echo "<br>";

    echo $fecha_inicio = $_POST['fecha_inicio'];
    echo "<br>";
    echo $fecha_fact = $_POST['fecha_fact'];

    //exit();

    $sql = "UPDATE completa SET movil = '$movil',
                            nombre_titu = '$nombre_titu',
                            apellido_titu = '$apellido_titu',
                            dni_titu = '$dni_titu',
                            direccion_titu = '$dir_titu',
                            cp_titu = '$cp_titu',
                            cel_titu = '$cel_titu',
                            licencia_titu = '$licencia', 

                            nombre_chof_1 = '$nombre_chof_1',
                            apellido_chof_1 = '$ape_chof_1',
                            dni_chof_1 ='$dni_chof_1',
                            direccion_chof_1 = '$dir_chof_1',
                            cp_chof_1 = '$cp_chof_1', 
                            cel_chof_1 = '$cel_chof_1',

                            nombre_chof_2 = '$nombre_chof_2',
                            apellido_chof_2 = '$ape_chof_2',
                            dni_chof_2 ='$dni_chof_2',
                            direccion_chof_2 = '$dir_chof_2',
                            cp_chof_2 = '$cp_chof_2', 
                            cel_chof_2 = '$cel_chof_2',
  
                            marca = '$marca',
                            modelo = '$modelo',
                            dominio = '$dominio',
                            año = '$año',

                            x_viaje = '$x_viaje', 
                            x_semana = '$x_semana',

                            fecha_inicio = '$fecha_inicio',
                            
                            fecha_facturacion = '$fecha_fact'

                                    WHERE id =" . $id;
    //exit();

    $con->query($sql);

    if ($con->query($sql) === TRUE) {
        echo "correcto";
    } else {
        echo "Error";
        exit();
    }


    header('Location:list_uni_comp.php');

    ?>

</body>

</html>