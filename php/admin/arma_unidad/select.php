<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utfomb4");
?>
<?php

$sql = "SELECT * FROM abonos";
$abono_semana = $con->query($sql);

$sql_completa = "SELECT * FROM completa";
$abono_completa = $con->query($sql_completa);

// Arreglo para almacenar las opciones
$opciones = [];

if ($abono_semana->num_rows > 0) {
    while ($row = $abono_semana->fetch_assoc()) {
        $opciones[] = $row;
    }
} else {
    echo "0 resultados";
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones desde la BBDD</title>
</head>

<body>
    <form action="guarda_select.php" method="POST">
        <label for="opciones">Elige una opción:</label>
        <select id="opciones" name="opciones">
            <option value="<?php //echo 
                            ?>">leo la otra tabla</option>
            <?php
            foreach ($opciones as $opcion) {
                echo "<option value=\"" . $opcion['id'] . "\" >" . $opcion['abono']   . "</option>";
            }
            ?>
        </select>
        <button type="submit">GUARDAR</button>
    </form>
</body>

</html>