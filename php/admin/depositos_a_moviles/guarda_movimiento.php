<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo "Guarda semana a cuenta...";

echo $id = $_GET['q'];

$sql_l = "SELECT * FROM depositos_a_moviles WHERE id = " . $id;
$sql_le = $con->query($sql_l);
$sql_lee = $sql_le->fetch_assoc();
$movil = $sql_lee['movil'];
$fecha = $sql_lee['fecha'];
$voucher = $sql_lee['voucher'];

echo "<br>Movil: " . $movil;
echo "<br>Fecha: " . $fecha;
echo "<br>Voucher: " . $voucher;

//exit;

// Consulta corregida
$lee_sal = "SELECT * FROM completa WHERE movil = '$movil'"; // Si movil es un string, usa comillas

$lee_sald = $con->query($lee_sal);

if ($lee_sald) {
    $sal = $lee_sald->fetch_assoc();
    $saldo_a_favor = $sal['saldo_a_favor_ft'];
    echo "<br>Saldo a favor: " . $saldo_a_favor;
} else {
    echo "Error en la consulta: " . $con->error;
}

echo "<br>Saldo sumado: " . $saldo_sumado = $saldo_a_favor + $voucher;


$sql = "UPDATE completa SET saldo_a_favor_ft = ? WHERE movil = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("di", $saldo_sumado, $movil);  // "di" = double (decimal) y integer (ID)

if ($stmt->execute()) {
    echo "<br>Registro actualizado correctamente.";
} else {
    echo "<br>Error al actualizar: " . $con->error;
}

// Consulta segura con `prepare()`
$sql = "DELETE FROM depositos_a_moviles WHERE id = ?";
$stmt = $con->prepare($sql);

// Vincular parámetro y ejecutar
$stmt->bind_param("i", $id); // "i" indica que `id` es un entero

$stmt->execute();

// Verificar si se eliminó correctamente
if ($stmt->affected_rows > 0) {
    echo "Registro eliminado correctamente.";
} else {
    echo "No se encontró el registro.";
}

header("Location: inicio_movimientos.php");
