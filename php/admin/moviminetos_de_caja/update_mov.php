<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$usuario = $_SESSION['uname'];

$sacaft = 0;
$sacamp = 0;
$obs = "";


echo "Extrae FT: " . $sacaft = $_POST["saca_ft"];
echo "<br>";
echo "Extrae MP: " . $sacamp = $_POST["saca_mp"];
echo "<br>";
echo "Observaciones: " . $obs = $_POST['obs'];
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");

$sql_act = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$sql_a = $con->query($sql_act);
$ult_row = $sql_a->fetch_assoc();





    echo $ft_en_caja = $ult_row['dep_ant_ft'];   //Es la plata que habia en ft antes deñ movimiento
echo "<br>";
echo $mp_en_caja = $ult_row['dep_ant_mp'];   //Es la plata que habia en mp antes deñ movimiento
echo "<br>";


// Consulta para actualizar el último registro
$sql = "UPDATE caja_final SET ft_actual=?, mp_actual=? WHERE 
    id=(SELECT MAX(id) FROM (SELECT id FROM caja_final) AS subquery)";

// Preparar la consulta
$stmt = $con->prepare($sql);

// Vincular parámetros
$stmt->bind_param("dd", $ft_en_caja, $mp_en_caja);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro actualizado exitosamente.";
} else {
    echo "Error al actualizar el registro: " . $con->error;
    exit;
}


echo "<br>";
echo "va a quedar en FT: " . $actual_ft = $ft_en_caja - $sacaft;
echo "<br>";
echo "va a quedar en MP: " . $actual_mp = $mp_en_caja - $sacamp;
echo "<br>";

//exit;

$sql_actu_caja = "INSERT INTO caja_final (
                            dep_ant_ft, 
                            extra_ft, 

                            dep_ant_mp, 
                            extra_mp, 

                            fecha, 
                            nombre, 
                            observaciones) VALUES (?,?,?,?,?,?,?) ";

$stmt = $con->prepare($sql_actu_caja);

if (!$stmt) {
    die("Error en la preparación: " . $con->error);
}

$stmt->bind_param(
    "ddddsss",
    $actual_ft,
    $sacaft,

    $actual_mp,
    $sacamp,

    $fecha,
    $usuario,
    $obs
);

//exit;

if ($stmt->execute()) {
    echo "Registro insertado con éxito.";
} else {
    echo "Error al insertar registro: " . $stmt->error;
}

header("Location: inicio_movimientos.php");
