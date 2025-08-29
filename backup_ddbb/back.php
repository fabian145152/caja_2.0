<?php
session_start();
include_once "../funciones/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACKUP DIARIO</title>
    <?php head() ?>
</head>

<body>
    <h3>Esta pagina hace solo backup de la tabla acaja,</h3>
    <h3>falta agregar las otras tablas y</h3>
    <h3>automatizarlo para que lo haga solo todos los dias.</h3>

    <div class="form-group">
        <a href="backup_caja.php" class="btn btn-primary btn-sm">CAJA</a>
        <br>
        <br>
        <br>
        <a href="../php/menu.php" class="btn btn-primary btn-sm">SALIR</a>
    </div>
</body>

</html>