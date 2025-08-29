<?php session_start();

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id = $_POST['id'];

$nombre = $_POST['nombre'];
echo "<br>";
$desc = $_POST['descripcion'];
echo "<br>";
$precio = $_POST['precio'];
echo "<br>";
$stock = $_POST['stock'];
echo "<br>";

echo $id;
echo "<br>";
echo $nombre;
echo "<br>";
echo $desc;
echo "<br>";
echo $precio;
echo "<br>";
echo $stock;
echo "<br>";

$sql = "UPDATE productos SET nombre = '$nombre', 
                             descripcion = '$desc', 
                             precio = '$precio', 
                             stock = '$stock' 
                            WHERE id =" . $id;
$con->query($sql);
header('Location:venta_prod.php');
