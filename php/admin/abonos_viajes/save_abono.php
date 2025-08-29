<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $nombre = $_POST['nombre'];
echo $importe = $_POST['importe'];

$sql = "INSERT INTO abono_viaje (abono, importe) VALUES (?,?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $nombre, $importe);

if ($stmt->execute()) {
?>
    <script>
        alert("NUEVO IMPORTE CREADO CON EXITO")
        window.location = "inicio_abonos.php";
    </script>
<?php
} else {
?>
    <script>
        alert("NOMBRE o IMPORTe DUPLICADO")
        window.location = "nuevo_abono.php";
    </script>
<?php
}
