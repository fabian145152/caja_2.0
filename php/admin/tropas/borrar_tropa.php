<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $id_del = $_GET['q'];


$sql_semana = "SELECT * FROM completa WHERE id=" . $id_del;

$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();

echo "<br>" . $semana_movil = $row_semana['movil'];

//exit();

$sql_del_semana = "DELETE FROM semanas WHERE movil=" . $semana_movil;
$result_semanas = $con->query($sql_del_semana);



echo "<br>";
echo "<br>";
echo "<br>";


$sql = "DELETE FROM completa WHERE movil=" . $semana_movil;
$result = $con->query($sql);



//exit();
header("Location:lista_tropas.php");
exit();
