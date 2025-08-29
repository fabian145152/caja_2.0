<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$retotal = 0;
$mo = $_GET['q'];
$movil = $mo;


$sql = "SELECT * FROM voucher_validado WHERE movil = $movil";
$datos = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHIN</title>
    <link rel="stylesheet" href="../../../css/detalles.css">


    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <h3>Movil: <?php echo $movil ?></h3>
    <br>

    <a href="../voucher/buscador_voucher.php?movil=<?php $movil ?>"></a>

    <div>


        <img src="../../../imagenes/logo_pampa.png" alt="logo_pampa">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="../../../imagenes/logo_porte.jpg" width="8%" alt="logo_porte">
        <?php
        echo "<br>";
        //echo "Semana: " . $semana = date("W");
        echo "<br>";
        echo $datos->num_rows . " " . "VOUCHER PROCESADOS";
        echo "<br>";
        echo "Fecha: " . date("d-m-Y");
        echo "<br>";

        ?>


        <br>

        <table border="1">
            <thead>

                <th>Id</th>
                <th>Movil</th>
                <th>Fecha</th>
                <th>Viaje Numero</th>
                <th>Total</th>

            </thead>
            <?php while ($d = $datos->fetch_object()) : ?>
                <tr>
                    <?php
                    $cuenta = $d->cc;
                    if ($cuenta <> 0) {

                    ?>
                        <td><?php echo $d->id ?></td>
                        <td><?php echo $movil = $d->movil ?></td>
                        <td><?php echo $viaje = $d->fecha; ?></td>
                        <td><?php echo $viaje = $d->viaje_no; ?></td>
                        <?php
                        $reloj = $d->reloj;
                        $peaje = $d->peaje;
                        $equipaje = $d->equipaje;
                        $adicional = $d->adicional;
                        $plus = $d->plus; ?>
                        <td><?php echo $total = $reloj + $peaje + $equipaje + $adicional + $plus; ?></td>


                    <?php
                        $retotal += $total;
                    }
                    ?>

                </tr>
    </div>
<?php

            endwhile;

?>
<table border="1">

    <tr>

        <th>Total</th>
        <th><?php echo "$" . $retotal . "-"; ?></th>

    </tr>
</table>
<table border="1">

    <tr>


        <th>Desc:.</th>
        <th><?php echo "$" . $retotal * .9 . "-"; ?></th>

    </tr>
</table>
<br><br>
<button onclick="cerrarPagina()" style="background-color: blue; color: white;">CERRAR PAGINA</button>


</body>

</html>