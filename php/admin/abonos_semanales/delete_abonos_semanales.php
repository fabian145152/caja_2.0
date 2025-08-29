<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id = $_GET['q'];

$sql = "DELETE FROM abono_semanal WHERE id=" . $id;


$result_semanas = $con->query($sql);

header("Location: inicio_abonos_semanales.php");
