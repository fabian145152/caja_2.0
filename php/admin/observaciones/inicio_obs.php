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
    <title>EDIT OBS</title>
    <?php head() ?>
    <style>
        #Power-Contenedor {
            text-align: center;
        }
    </style>
</head>

<body>

    <h4 style="text-align: center; ">EDITAR OBSERVACIONES</h4>
    <h4 style="text-align: center; ">TEXTO RECORDATODIO DEL MOVIL, APARECE EN LA PAGINA COBRAR EL MOVIL</h4>
    <br>
    <form style=" text-align:center;" method="post" action="ver_obs.php">
        Ingrese Movil:
        <input type="text" id="movil" name="movil" autofocus>
        <button type="submit">Continuar</button>
    </form>
    <br><br><br>



    <br><br><br>

    <div id="Power-Contenedor">
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>

    </div>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>

    <?php foot(); ?>
</body>

</html>