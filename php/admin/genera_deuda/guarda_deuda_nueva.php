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
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <?php


    $movil = $_POST['movil'];
    $deuda_anterior = $_POST['deuda_anterior'];
    $actualiza_deuda = $_POST['actualiza_deuda'];

    echo $movil;
    echo "<br>";
    echo $deuda_anterior;
    echo "<br>";
    echo $actualiza_deuda;
    echo "<br>";
    echo $deuda_total = $deuda_anterior + $actualiza_deuda;
    echo "<br>";





    if ($con->connect_error) {
        die("Error de conexión a la primera base de datos: " . $con->connect_error);
    }



    $sql = "UPDATE completa SET deuda_anterior = $deuda_total WHERE movil = $movil";
    $result = $con->query($sql);

    //header("Location: ../../menu_admin.php");
    ?>
    <script>
        window.close(); // No hace nada en la mayoría de los navegadores si la pestaña fue abierta por el usuario
    </script>
    <?php

    ?>
</body>

</html>