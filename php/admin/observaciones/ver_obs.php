<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if (isset($_POST['movil'])) {
    $movil = $_POST['movil'];
} elseif (isset($_GET['movil'])) {
    $movil = $_GET['movil'];
} else {
    $movil = null;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR OBSERVACIONES</title>
    <?php head() ?>
</head>

<body>

    <?php
    $sql_obs = "SELECT * FROM completa WHERE movil=" . $movil;

    $result_obs = $con->query($sql_obs);
    $row_obs = $result_obs->fetch_assoc();
    $observaciones = $row_obs['obs'];
    $nombre_titu = $row_obs['nombre_titu'];
    $apellido_titu = $row_obs['apellido_titu'];
    $movil = $row_obs['movil'];
    ?>


    <head>


        <h2>EDITOR DE OBSERVACIONES DE LA UNIDAD, SE VE EN LA PAGINA COBRAR A MOVILES</h2>
        <br>
        <button onclick="cerrarPagina()">CERRAR PAGINA</button>
        <br><br>

        <form action="guarda_obs.php" method="POST">
            <!-- Campo de texto -->
            <div style="text-align: center;">
                <label for="nombre">Unidad: </label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $movil ?>" readonly><br><br>
                <label for="nombre">Titular: </label>

                <input type="text" id="" name="" value="<?php echo $nombre_titu . " " . $apellido_titu ?>" readonly style="width:300px;"><br><br>
                <label for="comentarios">Observaciones</label>
                <br>

                <textarea id="comentarios" name="comentarios" rows="10" cols="70"><?php echo $observaciones ?></textarea><br><br>
                <input type="submit" value="Enviar">
            </div>

        </form>


        <script>
            // When the user scrolls the page, execute myFunction 
            window.onscroll = function() {
                myFunction()
            };

            function myFunction() {
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrolled = (winScroll / height) * 100;
                document.getElementById(" myBar").style.width = scrolled + "%";
            }
        </script>








        <script>
            function cerrarPagina() {
                window.close();
            }
        </script>
        <?php foot(); ?>
</body>

</html>