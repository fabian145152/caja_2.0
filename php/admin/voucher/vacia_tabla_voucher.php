<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

//exit();

// Consulta para vaciar la tabla
$sql_nuevos = "TRUNCATE voucher_nuevos";

if ($con->query($sql_nuevos)) {
    echo "La tabla VOUCHER NUEVOS ha sido vaciada correctamente";
    echo "<br>";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
}

$sql_temporales = "TRUNCATE voucher_temporales";

if ($con->query($sql_temporales)) {
    echo "La tabla VOUCHER TEMPORALES ha sido vaciada correctamente";
    echo "<br>";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
}

$sql_validados = "TRUNCATE voucher_validado";

if ($con->query($sql_validados)) {
    echo "La tabla VOUCHER VALIDADOS ha sido vaciada correctamente";
    echo "<br>";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
}


header('Location: inicio_voucher.php');
