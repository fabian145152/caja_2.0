<?php
session_start();



include_once "../../../../funciones/funciones.php";
//include_once "../caja_2.0/funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");




$mov = $_POST['movil'];

$movil = "A" . $mov;

## Cosulta por si no existe el movil

$sql_existe = "SELECT * FROM completa WHERE movil = " . $mov;
$stmt = $con->prepare($sql_existe);
$stmt->execute();
$resu = $stmt->get_result();

if ($resu->num_rows > 0) {
} else {
    echo "El registro no existe.";
    header("Location: inicio_cobros.php");
}


$sql = "SELECT COUNT(*) AS total FROM voucher_validado WHERE movil = " . $mov;
$result = $con->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Obtener la fila de resultados
    $hay_voucher = $result->fetch_assoc();
    $hay_voucher["total"];
} else {
    echo "0 Voucher";
}

//exit;

$sql_tiene_ventas = "SELECT * FROM completa WHERE movil = " . $mov;
$resu = $con->query($sql_tiene_ventas);
$linea = $resu->fetch_assoc();
$hay_ventas = $linea['venta_1'];
$deuda_ant = $linea['deuda_anterior'];


$sql_sem = "SELECT * FROM semanas WHERE movil = " . $mov;
$sql_res = $con->query($sql_sem);
$tiene_semanas = $sql_res->fetch_assoc();
$debe_semanas = $tiene_semanas['total'];


$_SESSION['variable'] = $movil;
include_once "cobro_siguiente.php";
