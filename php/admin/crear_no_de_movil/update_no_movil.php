<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['movil'];
$semana_movil = $_POST['semana_movil'];

echo "Movil nuevo: " . $movil;
echo "<br>";
echo "Semana Movil: " . $semana_movil;
echo "<br>";
$id_movil = $_POST['id'];
echo "<br>";


$sql_movil = "SELECT * FROM completa WHERE movil=" . $semana_movil;
$result_movil = $con->query($sql_movil);
$row_movil = $result_movil->fetch_assoc();

echo $movil_viejo = $row_movil['movil'];
echo "<br>";

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $semana_movil;
$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();

echo  $row_semana['movil'];
echo "<br>";

$sql_caja = "SELECT * FROM caja_movil WHERE movil=" . $semana_movil;
$result_caja = $con->query($sql_caja);
$row_caja = $result_caja->fetch_assoc();

echo $row_caja['movil'];
echo "<br>";

//exit;

$sql_movil = "UPDATE completa SET movil = '$movil' WHERE movil =" . $semana_movil;
$con->query($sql_movil);


$sql_semana = "UPDATE semanas SET movil = '$movil' WHERE movil=" . $semana_movil;
$con->query($sql_semana);

$sql_caja = "UPDATE caja_movil SET movil = '$movil' WHERE movil=" . $semana_movil;
$con->query($sql_caja);

//$sql_caja = "UPDATE caja_movil SET movil = '$movil' WHERE "

//exit;

header('Location:list_no_movil.php');
