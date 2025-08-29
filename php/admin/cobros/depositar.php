<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $movil = $_GET['movil'];

if (isset($_POST['tot_voucher'])) {
    $tot_voucher = $_POST['tot_voucher'];
} else {
    $tot_voucher = 0; // O un valor predeterminado
}

echo $tot_voucher;

exit;

$sql_comp = "SELECT * FROM completa WHERE movil='$movil'";

$result = $con->query($sql_comp);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
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

$deuda_anterior = 0;
$saldo_a_favor = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;
$total = $x_semana;
borraVoucher($con, $movil);
actualizaSemPagadas($con, $movil, $total);
actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
header("Location: cobro_empieza.php?movil=" . urlencode($movil));
