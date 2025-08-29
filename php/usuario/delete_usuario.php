<?php


include_once("../../funciones/funciones.php");
$con = conexion();

$id_del = $_GET["qq"];




$sql = "DELETE FROM users WHERE id_users=" . $id_del;
$result = $con->query($sql);

header("Location:inicio_usuario.php");
