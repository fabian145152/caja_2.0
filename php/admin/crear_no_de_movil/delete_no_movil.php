<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo $id_del = $_GET['q'];
echo "<br>";

$sql_movil = "SELECT * FROM completa WHERE id=" . $id_del;
$result_movil = $con->query($sql_movil);
$row_movil = $result_movil->fetch_assoc();
$movil = $row_movil['movil'];

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $movil;
$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();
$semana = $row_semana['movil'];

$sql_caja = "SELECT * FROM caja_movil WHERE movil=" . $movil;
$result_caja = $con->query($sql_caja);
$row_caja = $result_caja->fetch_assoc();
$caja = $row_caja['movil'];


echo "movil de completa: " . $movil;
echo "<br>";
echo "Movil de semana:  " . $semana;
echo "<br>";
echo "Movil de caja: " . $caja;



$sql = "DELETE FROM completa WHERE movil=" . $movil;
$con->query($sql);

$sql_semana = "DELETE FROM semanas WHERE movil=" . $movil;
$con->query($sql_semana);

$sql_caja_movil = "DELETE FROM caja_movil WHERE movil=" . $movil;
$con->query($sql_caja_movil);



header("Location:list_no_movil.php");
