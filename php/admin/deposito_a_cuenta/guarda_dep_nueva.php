<?php session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$resto = 0;
$usuario = $_SESSION['uname'];

$movil = $_POST['movil'];

$deposito = $_POST['deposito'];
$deuda_anterior = $_POST['deuda_anterior'];
echo $usuario;

$lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$res = $con->query($lee_ca);
$reg = $res->fetch_assoc();
$saldo_ft = $reg['saldo_ft'];


$saldo_voucher = 0;
$dep_voucher = 0;


$sql = "SELECT * FROM completa WHERE movil = '$movil'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Imprimir los datos del último registro
    $row = $result->fetch_assoc();
    $saldo_a_favor = $ant = $row['saldo_a_favor_ft'];

    $deuda_anterior = $ant = $row['deuda_anterior'];
}
$salda_deuda = $deuda_anterior - $deposito;
$paga_parte = $deuda_anterior - $deposito;
$de_mas = $deposito + $saldo_a_favor;
$paga_parte = $de_mas;
$observaciones = "";
echo "Movil: " . $movil;
echo "<br>";
echo "Deuda anterior: " . $deuda_anterior;
echo "<br>";
echo "Saldo a favor: " . $saldo_a_favor;
echo "<br>";
echo "Deposito: " . $deposito;
echo "<br>";
echo "Guarda mas cuando tiene: " . $de_mas;
echo "<br>";
echo "Salda deuda: " . $salda_deuda;
echo "<br>";
echo "Paga parte de la deuda:  " . $paga_parte;
echo "<br>";

//-------------------------------------------------------
//prueba con una sola variable

if ($deuda_anterior > $saldo_a_favor) {
    echo "Deuda";
    echo "<br>";
    echo $deuda_anterior;
    echo "<br>";
    echo $saldo_a_favor;
    echo "<br>";
    echo $deposito;
    echo "<br>";
    $para_guardar = $deuda_anterior - $deposito;
    echo $para_guardar . " Instancia 1";

    $sql = "UPDATE completa SET deuda_anterior = ? WHERE movil = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("di", $para_guardar, $movil); // "d" para double (saldo) y "i" para int (movil)
        if ($stmt->execute()) {
            echo "Actualización exitosa.";
            echo "<br>";
        } else {
            echo "Error al actualizar: " . $stmt->error;
            exit;
        }
    }
}
if ($deuda_anterior == $saldo_a_favor && $deuda_anterior != 0 && $saldo_a_favor != 0) {
    echo "no a mano, Pone en cero..";
    echo "Instancia 2";
    $todo_cero = 0;
    $todo = 0;
    $sql = "UPDATE completa SET deuda_anterior = ?, saldo_a_favor_ft = ? WHERE movil = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ddi", $todo_cero, $todo, $movil); // "d" para double (saldo) y "i" para int (movil)
        if ($stmt->execute()) {
            echo "Actualización exitosa.";
            echo "<br>";
        } else {
            echo "Error al actualizar: " . $stmt->error;
            exit;
        }
    }
}
$para_guardar_a_favor = $saldo_a_favor - $deuda_anterior + $deposito;
if ($para_guardar_a_favor > 0) {
    echo "Saldo a favor";
    echo "<br>";
    echo $deuda_anterior;
    echo "<br>";
    echo $saldo_a_favor;
    echo "<br>";
    echo $deposito;
    echo "<br>";
    $para_guardar_a_favor = $saldo_a_favor - $deuda_anterior + $deposito;
    echo $para_guardar_a_favor . " Instancia 3";


    $sql = "UPDATE completa SET saldo_a_favor_ft = ? WHERE movil = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("di", $para_guardar_a_favor, $movil); // "d" para double (saldo) y "i" para int (movil)
        if ($stmt->execute()) {
            echo "Actualización exitosa.";
            echo "<br>";
        } else {
            echo "Error al actualizar: " . $stmt->error;
            exit;
        }
    }
    $observaciones = "Deposito a cuenta del movil. " . $movil;
    $fecha = date("Y-m-d H:i:s");
    $new_dep_ft = $deposito;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
}

echo "<script>window.close();</script>";
