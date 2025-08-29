<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo "Id de completa: " . $id = $_POST['id'];
echo "<br>";
echo "movil nuevo: " . $movil = $_POST['movil'];
echo "<br>";
echo "Tropa: " . $tropa = $_POST['tropa'];
echo "<br>";
echo $nombre = $_POST['nombre_titu'];
echo "<br>";
echo $apellido = $_POST['apellido_titu'];
echo "<br>";
echo $direccion = $_POST['direccion_titu'];
echo "<br>";
echo $cp = $_POST['cp_titu'];
echo "<br>";
echo $celu = $_POST['cel_titu'];
echo "<br>";
echo $dni = $_POST['dni_titu'];
echo "<br>";
echo "<br>";



$sql_completa = "SELECT * FROM completa WHERE id=" . $id;
$res_1 = $con->query($sql_completa);
$row_completa = $res_1->fetch_assoc();

echo "<br>";
echo "Movil anterior: " . $mov_ant = $row_completa['movil'];

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $mov_ant;
$res_2 = $con->query($sql_semana);
$row_semana = $res_2->fetch_assoc();

echo "<br>";
echo $row_completa['nombre_titu'];
echo "<br>";
echo "<br>";
//echo $row_semana['x_semana'];
echo "<br>";

//exit();

$upd_comp = "UPDATE completa SET 
                    movil = '$movil', 
                    tropa = '$tropa',
                    nombre_titu = '$nombre',
                    apellido_titu = '$apellido',
                    dni_titu = '$dni',
                    direccion_titu = '$direccion',
                    cp_titu = '$cp',
                    cel_titu = '$celu'
                    WHERE id =" . $id;

$con->query($upd_comp);

$upd_sem = "UPDATE semanas SET movil = '$movil' WHERE movil =" . $mov_ant;
$con->query($upd_sem);


if ($con->query($upd_comp) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error actualizando registro: " . $con->error;
    exit();
}

if ($con->query($upd_sem) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error actualizando registro: " . $con->error;
    exit();
}
//exit();
header("Location: lista_tropas.php");
