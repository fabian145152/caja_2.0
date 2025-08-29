<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$semana_actual = date("W");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITA DEUDA</title>
    <?php head() ?>
    <style>
        #Power-Contenedor {
            text-align: center;
        }
    </style>
</head>

<body>

    <h4 style="text-align: center; ">EDITAR DEUDA</h4>
    <h4 style="text-align: center; ">INGRESE MOVIL</h4>
    <br>
    <form style=" text-align:center;" method="post" action="ver_deuda.php">

        <input type="text" id="movil" name="movil" autofocus required>
        <button type="submit" class="btn btn-danger btn-sm">Continuar</button>
    </form>
    <br><br><br>



    <br><br><br>

    <div id="Power-Contenedor">
        <button onclick="cerrarPagina()" class="btn btn-danger btn-sm">CERRAR PAGINA</button>

    </div>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>

    <?php foot(); ?>
</body>

</html>