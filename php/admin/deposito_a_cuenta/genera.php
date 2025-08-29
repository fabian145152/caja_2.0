<?php session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$movil = $_POST['movil'];

if ($con->connect_error) {
    die("Error de conexión a la primera base de datos: " . $con->connect_error);
}

$sql = "SELECT * FROM completa WHERE movil = '$movil'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Imprimir los datos del último registro
    $row = $result->fetch_assoc();
    $ant = $row['saldo_a_favor_ft'];
}


$saldo_a_favor = $row['saldo_a_favor_ft'];
$deuda_anterior = $row['deuda_anterior'];
$saldo = $saldo_a_favor - $deuda_anterior;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPOSITO A CUENTA</title>
    <?php head() ?>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <?php

    if ($saldo > 0) {
        $saldo;
    ?>
        <h3>El saldo del movil <?php echo $row['movil'] ?> es de <?php echo "$" . $saldo_a_favor . "-" ?></h3>

    <?php
    } elseif ($saldo < 0) {
        abs($saldo); // Cambié "Número positivo" por "Número negativo"
    ?>
        <h3>Tiene una deuda anterior de <?php echo "$" . $deuda_anterior . "-" ?></h3>
    <?php
    } else {
        $saldo; // Agregué una descripción más clara para el caso de saldo cero
    ?>
        <h3><?php echo $saldo ?></h3>
    <?php
    }

    ?>




    <ul>
        <?php $row['id'] ?>
        <li><?php echo "Móvil " . $row['movil'] ?></li>
        <li><?php echo "Nombre del titular: " . $row['nombre_titu']; ?></li>
        <li><?php echo "Apellido del titular " . $row['apellido_titu'] ?></li>
    </ul>


    <form class="form" action="guarda_dep_nueva.php?=q'$movil'" method="POST" name="movil">
        <h1>Ingrese nuevo Monto</h1>
        <br><br>
        <input type="hidden" name="movil" class="gui-input" value="<?php echo $movil ?>">

        <input type="text" name="deposito" class="gui-input" autofocus>
        <input type="hidden" name="saldo_a_favor" class="gui-input" name="<?php echo $saldo_a_favor ?>">
        <input type="hidden" name="deuda_anterior" class="gui-input" value="<?php echo $deuda_anterior ?>">
        <input type="submit" value="GUARDAR" class=" btn btn-primary">
    </form>
    <br>

    <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>


    <?php foot() ?>
</body>

</html>