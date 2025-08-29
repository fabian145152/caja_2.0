<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['movil'];

$bonificacion = $_POST['bonificacion'];
$observaciones_deuda = $_POST['observaciones_deuda'];


$sql_deu_ant = "SELECT * FROM completa WHERE movil=" . $movil;
$result_deu_ant = $con->query($sql_deu_ant);
$row_deu_ant = $result_deu_ant->fetch_assoc();
$deuda_que_tenia = $row_deu_ant['deuda_anterior'];

echo "<br>Móvil: " . $movil;
echo "<br>Deuda Anterior: " . $deuda_que_tenia;
echo "<br>Bonificación: " . $bonificacion;
echo "<br>Observaciones Deuda: " . $observaciones_deuda;
$deuda_anterior = $deuda_que_tenia - $bonificacion;
echo "<br>Deuda Anterior Actualizada: " . $deuda_anterior;


//exit;

$sql_obs = "UPDATE completa SET deuda_anterior = '$deuda_anterior', observaciones_deuda = '$observaciones_deuda' WHERE movil=" . $movil;
$con->query($sql_obs);

if ($con->query($sql_obs) === TRUE) {
    echo "Datos editados correctamente";
} else {
    echo "Error de escritura";
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}
//exit;
// ...existing code...
if ($con->query($sql_obs) === TRUE) {
    echo "Datos editados correctamente";
    // Cierra la ventana con JavaScript
    echo "<script>window.close();</script>";
} else {
    echo "Error de escritura";
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}
// ...existing code...
//header('Location:../../menu.php');
