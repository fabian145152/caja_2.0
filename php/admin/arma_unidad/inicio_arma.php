<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("uth8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIGURA UNIDAD</title>
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <style>
        .formmovil {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-49%, -49%);
        }
    </style>
    <?PHP head(); ?>

</head>

<body>

    <h3 class="text-center" style="margin: 5px ; ">ARMA UNIDAD COMPLETA</h3>
    <h4 class="text-center" style="margin: 5px ; ">PARA EMPEZAR A COBRARLE</h4>
    <h5 class="text-center" style="margin: 5px ; ">Ingrese numero de movil anteriormente creado para comenzar a cobrarle</h5>

    <form method="POST" action="arma_guarda.php" class="formmovil">
        <label for="movil">Buscar:</label>
        <input type="text" id="movil" name="movil" required autofocus>
        <input type="submit" value="Buscar">
        <br><br><br><br>
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

    </form>



    <br><br>

    <?php foot(); ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</body>

</html>