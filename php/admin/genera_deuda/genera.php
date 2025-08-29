<?php session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUARDAR DEUDA ANTERIOR</title>
    <?php head() ?>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>

    <?php

    $movil = $_POST['movil'];


    if ($con->connect_error) {
        die("Error de conexión a la primera base de datos: " . $con->connect_error);
    }

    $lee_deuda = "SELECT * FROM completa WHERE movil = '$movil'";
    $lee_deuda_res = $con->query($lee_deuda);
    $row = $lee_deuda_res->fetch_assoc();
    $saldo_a_favor = $row['saldo_a_favor_ft'];

    if ($saldo_a_favor > 0) {
        echo "<h1>El movil tiene un saldo a favor de $saldo_a_favor</h1>";
        echo "<br>No se puede guardar...";
        echo "<a href='genera_deuda.php'>Volver</a>";
    }




    $sql = "SELECT * FROM completa WHERE movil = '$movil'";
    $result = $con->query($sql);

    ?>

    <br>
    <?php
    if ($result->num_rows > 0) {
        // Imprimir los datos del último registro
        $row = $result->fetch_assoc();

        $ant = $row['deuda_anterior'];

        if ($ant > 0) {
            echo "<h1>Ojo tiene una deuda anterior de $ant-";
        }

    ?>
        <h3>La deuda anterior del movil <?php echo $row['movil'] ?> en de $ <?php echo $row['deuda_anterior'] ?>...</h3>

        <ul>

            <?php $row['id'] ?>
            <li><?php echo "Móvil " . $row['movil'] ?></li>
            <li><?php echo "Nombre del titular: " . $row['nombre_titu']; ?></li>
            <li><?php echo "Apellido del titular " . $row['apellido_titu'] ?></li>
            <li><?php echo $deu_ant = $row['deuda_anterior'] ?></li>
        </ul>


    <?php

    } else {
        echo "No se encontraron registros.";
    }



    ?>

    <form class="form" action="guarda_deuda_nueva.php?=q'$movil'" method="POST" name="movil">
        <h1>Ingrese nuevo Monto</h1>
        <br><br>
        <input type="hidden" name="movil" class="gui-input" value="<?php echo $movil ?>">

        <input type="text" name="deuda_anterior" class="gui-input" autofocus>

        <input type="hidden" name="actualiza_deuda" class="gui-input" value="<?php echo $deu_ant ?>">
        <input type="submit" value="GUARDAR" class=" btn btn-primary">
    </form>
    <br>

    <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>


    <?php foot() ?>
</body>

</html>