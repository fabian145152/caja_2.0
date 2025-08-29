<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$sql = "SELECT * FROM abono_semanal";
$result = $con->query($sql);
//$row_sem = $result->fetch_assoc();

?>
<label for="seleccion">Importe semanal:</label>
<select name="abono_semana" id="abono_semana" class="form-control">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['abono'] . "</option>";
        }
    } else {
        echo "<option>No hay resultados</option>";
    }
    ?>
</select>