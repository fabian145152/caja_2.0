<?php
session_start();

echo $id = $_GET['q'];
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$lee = "SELECT * FROM `voucher_validado` WHERE id = " . $id;
$result = $con->query($lee);
$lee_voucher = $result->fetch_assoc();
$movil = $lee_voucher['movil'];
echo "<br>Movil: ";
echo $movil;

//exit;

$sql = "DELETE FROM `voucher_validado` WHERE id = " . $id;
$result = $con->query($sql);

if ($result) {
    echo "Voucher validado eliminado correctamente.";
} else {
    echo "Error al eliminar el voucher validado: " . $con->error;
}

echo "<script>
    window.close();
</script>";
