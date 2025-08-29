<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['opciones'])) {
        // Obtener las opciones seleccionadas
        $opciones = $_POST['opciones'];


        // Imprimir las opciones seleccionadas
        echo "Has seleccionado las siguientes opciones:<br>";
        foreach ($opciones as $opcion) {
            $venta = substr($opcion, 0, 50);
            $movil = substr($opcion, 2, 4);
            echo htmlspecialchars($venta) . "<br>";
            echo htmlspecialchars($movil) . "<br>";


            $sql_comp = "SELECT * FROM completa WHERE movil = $movil";
            $res_comp = $con->query($sql_comp);
            $row_comp = $res_comp->fetch_assoc();




            if ($row_comp['venta_1'] == 0) {
                $sql_upd = "UPDATE completa SET venta_1 = '$venta' WHERE movil=" . $movil;
                $upd = $con->query($sql_upd);
            } else if ($row_comp['venta_2'] == 0) {
                $sql_upd = "UPDATE completa SET venta_2 = '$venta' WHERE movil=" . $movil;
                $upd = $con->query($sql_upd);
            } else if ($row_comp['venta_3'] == 0) {
                $sql_upd = "UPDATE completa SET venta_3 = '$venta' WHERE movil=" . $movil;
                $upd = $con->query($sql_upd);
            } else if ($row_comp['venta_4'] == 0) {
                $sql_upd = "UPDATE completa SET venta_4 = '$venta' WHERE movil=" . $movil;
                $upd = $con->query($sql_upd);
            } else if ($row_comp['venta_5'] == 0) {
                $sql_upd = "UPDATE completa SET venta_5 = '$venta' WHERE movil=" . $movil;
                $upd = $con->query($sql_upd);
            }
        }
    } else {
        echo "No has seleccionado ninguna opción.";
    }
} else {
    echo "Método de solicitud no válido.";
}


header("Location: inicio_ventas.php");
