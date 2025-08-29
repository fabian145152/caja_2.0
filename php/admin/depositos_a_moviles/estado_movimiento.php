<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id = $_GET['q'];


$sql = "SELECT * FROM depositos_a_moviles WHERE id='$id'";
$sql_l = $con->query($sql);
$sql_lee = $sql_l->fetch_assoc();

echo "<br>Movil: " . $sql_lee['movil'];
$estado = $sql_lee['est'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTADO DEL DEPOSITO</title>
    <?php head() ?>
</head>

<body>

    <?php
    // Simulación del valor actual desde la base de datos (puedes cambiarlo según tu lógica)

    $est = isset($_POST['estado']) ? $_POST['estado'] : "Depositado";
    ?>

    <form method="post" action="">
        <select name="estado">
            <option value="Depositado" <?php echo ($est == "Depositado") ? "selected" : ""; ?>>Depositado</option>
            <option value="No depositado" <?php echo ($est == "No depositado") ? "selected" : ""; ?>>No depositado</option>

        </select>
        <button type="submit">Enviar</button>
    </form>

    <?php
    // Mostrar el estado seleccionado después de enviar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($est == "Depositado") {
            $est = 1;
            echo $est;
        } else {
            if ($est == "No depositado")
                $est = 0;
            echo $est;
        }




        $sql = "UPDATE depositos_a_moviles SET est = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $est, $id);

        if ($stmt->execute()) {
            echo "Registro actualizado correctamente.";
            header("Location: inicio_movimientos.php");
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
    }
    ?>
</body>

</html>


<?php



/*
// Sentencia SQL para actualizar el registro
$sql = "UPDATE depositos_a_moviles SET est = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $estado, $id);

if ($stmt->execute()) {
    echo "Registro actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}
*/