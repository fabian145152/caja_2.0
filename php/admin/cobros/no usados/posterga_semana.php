<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo "<br>Movil :" . $movil = $_GET['movil'];
echo "<br>";
echo "<br>Semanas postergadas: " . $postergar_semanas = $_POST['postergar_semana'];


if ($postergar_semana <> 0) {
    $detalle_posterga = "Semana postergada";
    //$mensaje = "<br>Detalle " . $detalle_posterga . " de" . number_format($postergar_semana, 2, ',', '.') . "  semana el día " . date("Y-m-d");
    $mensaje = "\nSe postergaron " . $postergar_semana . " semanas, el día " . date("Y-m-d");
} else {
    $mensaje = "";
}




//exit;
$sql_comp = "SELECT * FROM completa WHERE movil='$movil'";
$result = $con->query($sql_comp);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<br>ID: " . $row["id"] . "<br>";
        echo "Movil: " . $row["movil"] . "<br>";
        echo "Deuda anterior: " . $row["deuda_anterior"] . "<br>";
        echo "Saldo a favor: " . $row["saldo_a_favor_ft"] . "<br>";
        echo "venta_1 " . $row["venta_1"] . "<br>";
        echo "venta_2 " . $row["venta_2"] . "<br>";
        echo "venta_3 " . $row["venta_3"] . "<br>";
        echo "venta_4 " . $row["venta_4"] . "<br>";
        echo "venta_5 " . $row["venta_5"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No se encontraron resultados.";
}

$sql_sem = "SELECT * FROM semanas WHERE movil='$movil'";
$resulta = $con->query($sql_sem);

if ($resulta->num_rows > 0) {
    while ($row = $resulta->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Movil: " . $row["movil"] . "<br>";
        echo "x_semana: " . $x_semana = $row["x_semana"] . "<br>";
        echo "Total: " . $debe_semanas = $row["total"] . "<br>";
        $debe_semanas = abs($debe_semanas);
        $x_semana = abs($x_semana);
        echo "Cant: " . $cant = $debe_semanas / $x_semana;
        echo "<br>Semanas postergadas: " . $postergar_semanas;
        echo "<br>total de semanas: " . $tot_sem = $cant - $postergar_semanas;

        echo "<hr>";
    }
} else {
    echo "No se encontraron resultados.";
}


$sql_sem = "SELECT * FROM voucher_validado WHERE movil='$movil'";

$resulta = $con->query($sql_sem);

if ($resulta->num_rows > 0) {
    while ($row = $resulta->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Movil: " . $row["movil"] . "<br>";
        echo "Reloj: " . $row["reloj"] . "<br>";
        echo "Peaje: " . $row["peaje"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No se encontraron resultados.";
}

if ($postergar_semana <> 0) {
    $detalle_posterga = "Semana postergada";
    //$mensaje = "<br>Detalle " . $detalle_posterga . " de" . number_format($postergar_semana, 2, ',', '.') . "  semana el día " . date("Y-m-d");
    $mensaje = "\nSe postergaron " . $postergar_semana . " semanas, el día " . date("Y-m-d");
} else {
    $mensaje = "";
}



//exit;
$postergar_semana = 0;
$deuda_anterior = 0;
$saldo_a_favor = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;
$total = $x_semana;
$mensaje = 1;

obsDeuda($con, $movil, $postergar_semana, $mensaje);



//guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);







##-------------------------------------------------------------------------------
echo "<br>Movil: " . $movil = $_POST['movil'];
echo "<br>Cantidad de semanas: " . $postergar_semana = $_POST['postergar_semana'];

$sql = "SELECT * FROM semanas WHERE movil = '$movil'";
$result = $con->query($sql);
$postergar_semanas = $result->fetch_assoc();

echo "<br>debe semanas: " . $debe_semanas = $postergar_semanas['total'];
echo "<br>Paga x semana: " . $x_semana = $postergar_semanas['x_semana'];

echo "<br>Actualizar semanas a: " . $sub_total = $postergar_semana * $x_semana;

echo "<br>Nuevo valor de semanas: " . $total = $debe_semanas + $sub_total + $x_semana . "<br>";

//actualizaSemPagadas($con, $movil, $total);


//header("Location: inicio_cobros.php");
