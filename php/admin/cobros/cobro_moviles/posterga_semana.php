<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
echo "<br>Movil: " . $movil = $_POST['movil'];
echo "<br>Cantidad de semanas: " . $postergar_semana = $_POST['postergar_semana'];

$sql = "SELECT * FROM semanas WHERE movil = '$movil'";
$result = $con->query($sql);
$semanas = $result->fetch_assoc();

echo "<br>debe semanas: " . $debe_semanas = $semanas['total'];
echo "<br>Paga x semana: " . $x_semana = $semanas['x_semana'];

echo "<br>Actualizar semanas a: " . $sub_total = $postergar_semana * $x_semana;

echo "<br>Nuevo valor de semanas: " . $total = $debe_semanas + $sub_total;

actualizaSemPagadas($con, $movil, $total);
