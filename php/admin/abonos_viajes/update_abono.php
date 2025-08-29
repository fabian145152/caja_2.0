<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $id = $_POST['id'];
echo "<br>";
echo $nombre = $_POST['nombre'];
echo "<br>";
echo $importe = $_POST['importe'];
echo "<br>";

$sql = "UPDATE `abono_viaje` SET `abono` = '$nombre', `importe` = '$importe'
WHERE id=" . $id;

$con->query($sql);

header('Location:inicio_abonos.php');
