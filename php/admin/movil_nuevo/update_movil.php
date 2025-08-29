<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$semana_movil = $_POST['semana_movil'];

echo $id_movil = $_POST['id'];
echo "<br>";
echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";
echo "Semana Movil: " . $semana_movil;
echo "<br>";
echo "Nombre: " . $nombre = $_POST['nombre_titu'];
echo "<br>";
echo "Apellido: " . $apellido = $_POST['apellido_titu'];
echo "<br>";
echo "DNI: " . $dni = $_POST['dni_titu'];
echo "<br>";
echo "Direccion: " . $direccion = $_POST['direccion_titu'];
echo "<br>";
echo "CP: " . $cp = $_POST['cp_titu'];
echo "<br>";
echo "Celular: " . $celular = $_POST['cel_titu'];
echo "<br>";
echo "Licencia: " . $licencia = $_POST['licencia_titu'];
echo "<br>";
echo "Estado: " . $estado_admin = $_POST['estado'];




//exit();


#estas 2 lineas editan el movil y ya estan bien
//$sql_movil = "UPDATE completa SET movil = '$movil' WHERE id =" . $id_movil;

$sql_movil = "UPDATE completa SET movil = '$movil',
                                    estado_admin = '$estado_admin',
                                    nombre_titu = '$nombre',
                                    apellido_titu = '$apellido',
                                    dni_titu = '$dni',
                                    direccion_titu = '$direccion',
                                    cp_titu = '$cp',
                                    cel_titu = '$celular',
                                    licencia_titu = '$licencia'
                                    WHERE id=" . $id_movil;

$con->query($sql_movil);


$sql_semana = "SELECT * FROM semanas WHERE movil=" . $semana_movil;

$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();

echo "ID del movil viejo: " . $id_movil_viejo = $row_semana['id'];
echo "<br>";
echo  $row_semana['movil'];

//exit();

$sql_semana = "UPDATE semanas SET movil = '$movil' WHERE id =" . $id_movil_viejo;
$con->query($sql_semana);



header('Location:lista_movil.php');
