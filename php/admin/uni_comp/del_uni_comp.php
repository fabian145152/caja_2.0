<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id_del = $_GET['q'];

$sql_comp = "SELECT * FROM completa WHERE id=" . $id_del;
$comp = $con->query($sql_comp);
$row_comp = $comp->fetch_assoc();

echo $movil = $row_comp['movil'];

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $movil;
$result = $con->query($sql_semana);
$row_sem = $result->fetch_assoc();

$movil_semana = $row_sem['movil'];

//exit();

$sql_1 = "DELETE FROM completa WHERE id=" . $id_del;
$con->query($sql_1);

if ($con->query($sql_1) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error actualizando registro: " . $con->error;
    exit();
}

$sql_2 = "DELETE FROM semanas WHERE movil=" . $movil_semana;
$con->query($sql_2);


if ($con->query($sql_2) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error actualizando registro: " . $con->error;
    exit();
}


header("Location:list_uni_comp.php");
