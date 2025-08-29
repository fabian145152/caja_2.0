
<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();

$con->set_charset("utf8mb4");

$id = $_GET['id'];
$sql = "SELECT * FROM voucher_temporales WHERE id = '$id' ";
$result = $con->query($sql);


$row = $result->fetch_assoc();

echo $movil = $row['movil'];
echo $fecha = $row['fecha'];
echo $viaje_no = $row['viaje_no'];
echo $cc = $row['cc'];
echo $reloj = $row['reloj'];
echo $peaje = $row['peaje'];
echo $equipaje = $row['equipaje'];
echo $adicional = $row['adicional'];
echo $plus = $row['plus'];




$guarda = "INSERT INTO voucher_validado (movil, fecha, viaje_no, cc, reloj, peaje, equipaje, adicional, plus) VALUES (?,?,?,?,?,?,?,?,?)";

$stmt = $con->prepare($guarda);

$stmt->bind_param('ssiiddddd', $movil, $fecha, $viaje_no, $cc, $reloj, $peaje, $equipaje, $adicional, $plus);


if ($stmt->Execute()) {
    echo "Exito Registro agregado";
} else {
    echo "Error";
}
echo $id;
echo "<br>";


$sql_borra = "DELETE FROM voucher_temporales WHERE viaje_no = '$viaje_no'";
$result = $con->query($sql_borra);

$sql_2 = "DELETE FROM voucher_nuevos WHERE viaje_no = $viaje_no";
$res = $con->query($sql_2);

echo "Movil:  " . $movil;
echo "<br>";

header("Location: buscador_voucher.php?movil=$movil");

?>

