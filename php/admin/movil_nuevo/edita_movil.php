<?php

session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id_upd = $_GET['q'];


$sql_movil = "SELECT * FROM completa WHERE id=" . $id_upd;
$result_movil = $con->query($sql_movil);
$row = $result_movil->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTUALIZAR TITULAR</title>
    <?php head(); ?>

</head>

<body>

    <?php



    $movil = $row['movil'];

    $sql_semana = "SELECT * FROM semanas WHERE movil=" . $movil;
    $result_semana = $con->query($sql_semana);
    $row_semana = $result_semana->fetch_assoc();
    $row_semana['total'];

    $lee_reg = "SELECT * FROM completa WHERE movil=" . $movil;
    $lee_leido = $con->query($lee_reg);
    $lee_row = $lee_leido->fetch_assoc();
    $lee_row['estado_admin'];

    ?>

    <div class="container">
        <h3 class="text-center">ACTUALIZAR DATOS DEL TITULAR</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_movil.php" method="post">
                    <div class="from-group">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                    <div class="form-group">

                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Movil</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $row['movil']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_titu" name="nombre_titu" value="<?php echo $row['nombre_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido_titu" name="apellido_titu" value="<?php echo $row['apellido_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">DNI</label>
                        <input type="text" class="form-control" id="dni_titu" name="dni_titu" value="<?php echo $row['dni_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion_titu" name="direccion_titu" value="<?php echo $row['direccion_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">CP</label>
                        <input type="text" class="form-control" id="cp_titu" name="cp_titu" value="<?php echo $row['cp_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input type="text" class="form-control" id="cel_titu" name="cel_titu" value="<?php echo $row['cel_titu']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Licencia</label>
                        <input type="text" class="form-control" id="licencia_titu" name="licencia_titu" value="<?php echo $row['licencia_titu']; ?>">
                    </div>

                    <?php
                    //  include_once "select_edita_movil.php";

                    $row_semana['total'];
                    echo "<br>";
                    $estado_admin = $lee_row['estado_admin'];
                    echo "<br>";
                    //echo $lee_estado['nombre'];
                    echo "<br>";

                    $lee_es = "SELECT * FROM estados_unidades WHERE id=" . $estado_admin;
                    $lee_esta = $con->query($lee_es);
                    $lee_estado = $lee_esta->fetch_assoc();
                    $estado_administrativo = $lee_estado['nombre'];
                    ?>
                    <div class="form-group">
                        <label class="control-label">ESTADO ADMINISTRATIVO</label>
                        <select id="estado" name="estado">

                            <option value="<?php echo $lee_estado['id'] ?>"><?php echo $lee_estado['nombre'] ?>&nbsp;&nbsp;&nbsp;<?php $lee_estado['color'] ?></option>
                            <?php
                            $sql_estado = "SELECT * FROM estados_unidades";
                            $result_estado = $con->query($sql_estado);
                            while ($row_estado = $result_estado->fetch_assoc()) {
                                echo "<option value='" . $row_estado['id'] . "'>" . $row_estado['nombre'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="semana_movil" name="semana_movil" value="<?php echo $row_semana['movil']; ?>">
                    </div>

                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR MOVIL">
                        <br>
                        <br><br>
                        <a href="lista_movil.php" class="btn btn-primary">SALIR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php foot(); ?>


</html>