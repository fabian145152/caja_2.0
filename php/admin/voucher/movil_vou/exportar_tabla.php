<?php
session_start();
include_once "../../../../funciones/funciones.php";
include_once "../PHPExcel/Classes/PHPExcel.php";
$con = conexion();
$con->set_charset("utf8mb4");

$retotal = 0;
$mo = $_POST['v_movil'];
$movil = "A" . $mo;

$sql = "SELECT * FROM voucher_validado WHERE movil = '$movil'";
$datos = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHIN</title>
    <link rel="stylesheet" href="../../../../css/detalles.css">
</head>

<body>
    <h3>Movil: <?php echo $movil ?></h3>
    <br>
    <a href="../inicio_voucher.php" class="boton">Volver</a>

    <div>
        <img src="../../../../imagenes/logo_porte.jpg" alt="logo_porte" width="8%">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="../../../../imagenes/logo_pampa.png" alt="logo_pampa">
        
        <p><?php echo $datos->num_rows . " "; ?>VOUCHER PROCESADOS</p>
        <br>

        <table border="1">
            <thead>

                <th>Id</th>
                <th>Movil</th>
                <th>Viaje Numero</th>
                <th>Reloj</th>
                <th>peaje</th>
                <th>Equipaje</th>
                <th>Adicional</th>
                <th>Plus</th>
                <th>Total</th>

            </thead>
            <?php while ($d = $datos->fetch_object()) : ?>
                <tr>
                    <?php
                    $cuenta = $d->cc;
                    if ($cuenta <> 0) {

                    ?>
                        <td><?php echo $d->id ?></td>
                        <td><?php echo $d->movil ?></td>
                        <td><?php echo $viaje = $d->viaje_no; ?></td>
                        <td><?php echo $reloj = $d->reloj; ?></td>
                        <td><?php echo $peaje = $d->peaje ?></td>
                        <td><?php echo $equipaje = $d->equipaje ?></td>
                        <td><?php echo $adicional = $d->adicional; ?></td>
                        <td><?php echo $plus = $d->plus; ?></td>
                        <td><?php echo $total = $reloj + $peaje + $equipaje + $adicional + $plus; ?></td>


                    <?php
                        $retotal += $total;
                    }
                    ?>

                </tr>
    </div>
<?php

                $sql_ins = "INSERT INTO vauchin (movil, viaje, total) VALUES ('$movil','$viaje', '$total')";
                //$stmt = $con->prepare($sql_ins);
                //$stmt->bind_param("ii", $viaje, $total);

                // Ejecutar la consulta
                if ($con->query($sql_ins) === TRUE) {
                    //echo "Datos insertados correctamente.";
                } else {
                    echo "Error al insertar datos: " . $con->error;
                }

            // Cerrar la conexión
            //$con->close();

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



</body>

</html>