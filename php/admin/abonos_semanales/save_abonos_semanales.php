<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $abono = $_POST['abono'];
echo $importe = $_POST['importe'];

$sql = "INSERT INTO abono_semanal (abono, importe) VALUES (?,?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $abono, $importe);

if ($stmt->execute()) {
?>
    <script>
        alert("NUEVO IMPORTE CREADO CON EXITO")
        window.location = "inicio_abonos_semanales.php";
    </script>
<?php
} else {
?>
    <script>
        alert("NOMBRE o IMPORTe DUPLICADO")
        window.location = "nuevos_abonos_semanales.php";
    </script>
<?php
}
