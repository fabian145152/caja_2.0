<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $id_del = $_GET['q'];


$sql_semana = "SELECT * FROM completa WHERE id=" . $id_del;

$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();

echo "<br>";
echo $semana_movil = $row_semana['movil'];
echo $dni_titu = $row_semana['dni_titu'];
echo "<br>";

if (!$dni_titu <> 0) {
?>


<?php
    echo "queres borrar un registro ya cargado...";
    exit();
} else {
    echo "se borra esta vacio";

    $sql_del_semana = "DELETE FROM semanas WHERE movil=" . $semana_movil;
    $result_semanas = $con->query($sql_del_semana);

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $sql = "DELETE FROM completa WHERE id=" . $id_del;
    $result = $con->query($sql);

        header("Location:lista_movil.php");
    exit();
}