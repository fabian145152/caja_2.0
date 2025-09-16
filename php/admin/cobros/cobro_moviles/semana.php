<?php

//session_start();
include_once "../../../../funciones/funciones.php";



$con = conexion();
$con->set_charset("utf8mb4");

$archivo = "semana.txt";

$semana_actual = date('W');

$fecha = date("Y-m-d");


if (file_exists($archivo)) {
    // Si el archivo existe, leer el contenido para obtener la última semana registrada
    echo "Semana leida del archivo: " . $semana_anterior = file_get_contents($archivo);
    echo "<br>";


    if ($semana_actual != $semana_anterior) {
        $variable = 1;
        file_put_contents($archivo, $semana_actual);

        echo "¡La semana se ha incrementado!... " . $variable;
        $sql_3 = "SELECT * FROM semanas WHERE 1";
        $listarla = $con->query($sql_3);

        while ($verla = $listarla->fetch_assoc()) {
            $movil = $verla['movil'];
            $x_semana = $verla['x_semana'];
            $total = $verla['total'];
            $paga_semanas = $verla['activo']; // Este valor viene desde la base

            if ($paga_semanas === "SI") {
                $suma = $x_semana + $total;
                $fecha = date("Y-m-d");

                $inc_semana = "UPDATE semanas SET total = '$suma', fecha = '$fecha' WHERE movil = '$movil'";
                $con->query($inc_semana);
            } else {
                $variable = file_get_contents("semana.txt");
            }
        }
    }
}
