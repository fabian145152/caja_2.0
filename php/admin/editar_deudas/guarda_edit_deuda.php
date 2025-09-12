<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['nombre'];

$observaciones_deuda = $_POST['comentarios'];

$sql_obs = "UPDATE completa SET observaciones_deuda = '$observaciones_deuda' WHERE movil=" . $movil;
$con->query($sql_obs);

if ($con->query($sql_obs) === TRUE) {
    echo "Datos editados correctamente";
} else {
    echo "Error de escritura";
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}

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
//header('Location:../cobros/inicio_cobros.php');
include_once "../../../includes/cierra_pestaña.php";
