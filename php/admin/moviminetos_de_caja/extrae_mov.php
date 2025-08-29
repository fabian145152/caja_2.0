<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");





$sql = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$result = $con->query($sql);
$sql_list = $result->fetch_assoc();




// Verificar si se encontró un registro
if ($result->num_rows > 0) {
    // Obtener los datos del último registro
    $ultimoRegistro = $result->fetch_assoc();
    //echo "Último registro: " . print_r($ultimoRegistro, true);
} else {
    echo "No se encontraron registros.";
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR PRODUCTOS</title>
    <?php head() ?>

<body>


    <style>
        obs {
            height: 4000px;
        }
    </style>
    <div class="container">
        <h3 class="text-center">EXTRAER DINERO DE CAJA</h3>
        <div class="row">

            <div class="col-md-4">
            <form class="form-group" accept=-"charset utf8" action="update_mov.php" method="POST">
                    <div class="form-group">
                        <label class="control-label">Efectivo en caja</label>
                        <input type="text" class="form-control" value="<?php echo $sql_list['dep_ant_ft']; ?>" readonly >
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mercado Pago en caja</label>
                        <input type="text" class="form-control" value="<?php echo  $sql_list['dep_ant_mp']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Extraccion de FT</label>
                        <input type="text" id="saca_ft" name="saca_ft" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Extraccion de MP</label>
                        <input type="text" id="saca_mp" name="saca_mp" class="form-control">
                    </div>
                    <div class=" form-group">
                        <label class="control-label">Destino</label>
                        <textarea id="obs" name="obs" rows="4" cols="70" class="form-control"></textarea>
                    </div>
                    <div class=" text-center">
                        <br>
                        <input type="submit" class="btn btn-danger" value="GRABAR MOVIMIENTO">
                        <br>
                        <br><br>
                    </div>
                </form>

            </div>
        </div>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
    </div>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php echo foot(); ?>
</body>

</html>