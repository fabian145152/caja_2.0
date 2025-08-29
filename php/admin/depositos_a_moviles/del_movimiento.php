<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $id_del = $_GET['q'];



$sql = "DELETE FROM depositos_a_moviles WHERE id=" . $id_del;
$result = $con->query($sql);

header("Location:inicio_movimientos.php");
