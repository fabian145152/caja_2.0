<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php head() ?>


</head>

<body>

    <?php
    $id = $_GET['id'];




    $sql = "SELECT * FROM voucher_temporales WHERE id = '$id' ";
    $result = $con->query($sql);


    $row = $result->fetch_assoc();
    $reloj = $row['reloj'];
    $peaje = $row['peaje'];
    ?>


    <div class="container-sm">
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="valida_voucher.php?=q" method="post">
                    <div class="from-group">
                        <h4 class="text-center">ACTUALIZAR VIAJE No: <?php echo $row['viaje_no'] ?> MOVIL: <?php echo $row['movil'] ?> </h4>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="movil" name="movil" value="<?php echo $row['movil']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="viaje_no" name="viaje_no" value="<?php echo $row['viaje_no']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <!-- <label class="control-label">Fecha</label>  -->

                            <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $row['fecha']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Cuenta</label>
                            <input type="text" class="form-control" id="cc" name="cc" value="<?php echo $row['cc']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Reloj</label>
                            <input type="text" class="form-control" id="reloj" name="reloj" value="<?php echo $reloj; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Peaje</label>
                            <input type="text" class="form-control" id="peaje" name="peaje" value="<?php echo $peaje; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Equipaje</label>
                            <input type="text" class="form-control" id="equipaje" name="equipaje" value="<?php echo $equipaje = $row['equipaje']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Adicional</label>
                            <input type="text" class="form-control" id="adicional" name="adicional" value="<?php echo $adicional = $row['adicional']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Plus</label>
                            <input type="text" class="form-control" id="plus" name="plus" value="<?php echo $plus = $row['plus']; ?>">
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Validar">
                        </div>
                    </div>
                </form>
            </div>
            
            <a href="inicio_voucher.php" class="btn btn-danger">VOLVER</a>
        </div>
    </div>






</body>