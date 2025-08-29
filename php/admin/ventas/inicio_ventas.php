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
    <title>VENTAS</title>
</head>

<body>
    <?php head() ?>
    <h1>VENTA DE PRODUCTOS</h1>

    <form method="post" action="elije_venta.php">
        Ingrese Movil:
        <input type="text" id="movil" name="movil" autofocus>
        <button type="submit">Sigue</button>
    </form>
    <br><br><br>
    <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php foot(); ?>
</body>

</html>