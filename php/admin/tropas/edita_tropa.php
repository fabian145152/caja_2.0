<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$movil = $_GET['q'];



$sql_movil = "SELECT * FROM completa WHERE id=" . $movil;
$result_semana = $con->query($sql_movil);
$row_semana = $result_semana->fetch_assoc();

$row_semana['movil'];

?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR TROPA</title>
    <?php head() ?>
</head>

<body>
    <div class="container">
        <h3 class="text-center">ACTUALIZAR NUMEROS DE MOVIL</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_tropa.php" method="POST">
                    <div class="from-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $row_semana['id']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row_semana['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">TROPA</label>
                        <input type="text" class="form-control" id="tropa" name="tropa" value="<?php echo $row_semana['tropa']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">MOVIL</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $row_semana['movil']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">NOMBRE</label>
                        <input type="text" class="form-control" id="nombre_titu" name="nombre_titu" value="<?php echo $row_semana['nombre_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">APELLIDO</label>
                        <input type="text" class="form-control" id="apellido_titu" name="apellido_titu" value="<?php echo $row_semana['apellido_titu']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">DNI</label>
                        <input type="text" class="form-control" id="dni_titu" name="dni_titu" value="<?php echo $row_semana['dni_titu']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">DIRECCION</label>
                        <input type="text" class="form-control" id="direccion_titu" name="direccion_titu" value="<?php echo $row_semana['direccion_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">CP</label>
                        <input type="text" class="form-control" id="cp_titu" name="cp_titu" value="<?php echo $row_semana['cp_titu']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">CELULAR</label>
                        <input type="text" class="form-control" id="cel_titu" name="cel_titu" value="<?php echo $row_semana['cel_titu']; ?>">
                    </div>




                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR MOVIL">
                        <br>
                        <br><br>
                        <a href="lista_tropas.php" class="btn btn-primary">SALIR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>