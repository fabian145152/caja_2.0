<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
session_start();


$movil = $_POST['movil'];
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$row_comp['movil'];
$saldo_a_favor = $row_comp['saldo_a_favor_ft'];
$deuda_anteror = $row_comp['deuda_anterior'];
$saldo_leido = $row_comp['saldo_a_favor_ft'];

$lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$res = $con->query($lee_ca);
$reg = $res->fetch_assoc();
$saldo_ft = $reg['saldo_ft'];
$saldo_voucher = $reg['saldo_voucher'];

$paga_de_viajes = 0;
$t_a_pagar = 0;
$dep_voucher = 0;
$deposito = 0;
$observaciones = " ";
$total_ventas = 0;
$deuda_anterior = 0;
$viajes_q_se_cobran = 0;
$c_via_semana_ant = 0;
$tot_voucher = 0;
$descuentos = 0;
$a_pagar = 0;
$dep_ft = 0;
$dep_mp = 0;
$saldo_ft = 0;
$saldo_mp = 0;
$paga_de_mas = 0;
$paga_de_menos = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;
$para_actualizar_sem = 0;
$para_pagar_deu = 0;
$para_pagar_productos = 0;
$debe_sem_ant = 0;
$vou_menos_ventas = 0;
$vou_menos_ventas_deuda = 0;
$vou_menos_ventas_deuda_semanas = 0;
$debe_semanas = 0;
$sobra_de_pago_sem = 0;
$diez = 0;
$noventa = 0;
$total = 0;

$fecha = date("Y-m-d");
$usuario = $_SESSION['uname'];
$_SESSION['time'];


// Verificamos si la variable existe
if (isset($_SESSION['saldo_ft'])) {
    unset($_SESSION['saldo_ft']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
}
if (isset($_SESSION['saldo_mp'])) {
    unset($_SESSION['saldo_mp']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
}




//$postergar_semana = $_POST['postergar_semana'];
if (isset($_POST['postergar_semana'])) {
    $postergar_semana = $_POST['postergar_semana'];
} else {
    $postergar_semana = 0; // O un valor predeterminado
}



$x_semana = $_POST['paga_x_semana'];
//$debe_semanas = $_POST['debe_sem_ant'];
if (isset($_POST['debe_sem_ant'])) {
    $debe_semanas = $_POST['debe_sem_ant'];
} else {
    $debe_de_semanas = 0; // O un valor predeterminado
}
//$total_ventas = $_POST['prod'];
if (isset($_POST['prod'])) {
    $total_ventas = $_POST['prod'];
} else {
    $total_ventas = 0; // O un valor predeterminado
}
//$deuda_anterior = $_POST['deuda_ant'];
if (isset($_POST['deuda_ant'])) {
    $deuda_anterior = $_POST['deuda_ant'];
} else {
    $deuda_anterior = 0; // O un valor predeterminado
}
//$viajes_q_se_cobran = $_POST['numero'];
if (isset($_POST['numero'])) {
    $viajes_q_se_cobran = $_POST['numero'];
} else {
    $viajes_q_se_cobran = 0; // O un valor predeterminado
}
//Totala depositarle
if (isset($_POST['resultadoResta'])) {
    $total_a_depositarle = $_POST['resultadoResta'];
} else {
    $total_a_depositarle = 0; // O un valor predeterminado
}

//$paga_x_viaje = $_POST['paga_x_viaje'];
if (isset($_POST['paga_x_viaje'])) {
    $paga_x_viaje = $_POST['paga_x_viaje'];
} else {
    $paga_x_viaje = 0; // O un valor predeterminado
}
//$viajesNuevos = $_POST['viajes_nuevos'];
if (isset($_POST['viajes_nuevos'])) {
    $viajesNuevos = $_POST['viajes_nuevos'];
} else {
    $viajesNuevos = 0; // O un valor predeterminado
}
//$via_sem_ant = $_POST['viajes_sem_ant'];
if (isset($_POST['viajes_sem_ant'])) {
    $via_sem_ant = $_POST['viajes_sem_ant'];
} else {
    $via_sem_ant = 0; // O un valor predeterminado
}
if (isset($_POST['total'])) {
    $imp_semana = $resultado['total'];
} else {
    $imp_semana = 0; // O un valor predeterminado
}
//$imp_x_sem = $resultado['x_semana'];
if (isset($_POST['x_semana'])) {
    $imp_x_sem = $resultado['x_semana'];
} else {
    $imp_x_sem = 0; // O un valor predeterminado
}
//$total_ventas = $_POST['total_ventas'];
if (isset($_POST['total_ventas'])) {
    $total_ventas = $_POST['total_ventas'];
} else {
    $total_ventas = 0; // O un valor predeterminado
}
//$new_dep_ft = $_POST['dep_ft'];
if (isset($_POST['dep_ft'])) {
    $new_dep_ft = $_POST['dep_ft'];
    $new_dep_ft = abs($new_dep_ft);
} else {
    $new_dep_ft = 0; // O un valor predeterminado
}
//$venta_1 = $_POST['venta_1'];
if (isset($_POST['venta_1'])) {
    $venta_1 = $_POST['venta_1'];
} else {
    $venta_1 = 0; // O un valor predeterminado
}
//$venta_2 = $_POST['venta_2'];
if (isset($_POST['venta_2'])) {
    $venta_2 = $_POST['venta_2'];
} else {
    $venta_2 = 0; // O un valor predeterminado
}
//$venta_3 = $_POST['venta_3'];
if (isset($_POST['venta_3'])) {
    $venta_3 = $_POST['venta_3'];
} else {
    $venta_3 = 0; // O un valor predeterminado
}
//$venta_4 = $_POST['venta_4'];
if (isset($_POST['venta_4'])) {
    $venta_4 = $_POST['venta_4'];
} else {
    $venta_4 = 0; // O un valor predeterminado
}
//$venta_5 = $_POST['venta_5'];
if (isset($_POST['venta_5'])) {
    $venta_5 = $_POST['venta_5'];
} else {
    $venta_5 = 0; // O un valor predeterminado
}

if ($postergar_semana <> 0) {
    $detalle_posterga = "Semana postergada";
    //$mensaje = "<br>Detalle " . $detalle_posterga . " de" . number_format($postergar_semana, 2, ',', '.') . "  semana el día " . date("Y-m-d");
    $mensaje = "\nSe postergaron " . $postergar_semana . " semanas, el día " . date("Y-m-d");
} else {
    $mensaje = "";
}



$ventas = $venta_1 + $venta_2 + $venta_3 + $venta_4 + $venta_5;

$tot_voucher = $_POST['tot_voucher'];
$desc = $_POST['comiaaa'];

if (isset($_POST['tot_voucher'])) {
    $tot_voucher = $_POST['tot_voucher'];
} else {
    $tot_voucher = 0; // O un valor predeterminado
}
if (isset($_POST['debe_abonar'])) {
    $debe_abonar = $_POST['debe_abonar'];
} else {
    $debe_abonar = 0; // O un valor predeterminado
}
if (isset($_POST['tot_via'])) {
    $total_de_viajes = $_POST['tot_via'];
} else {
    $total_de_viajes = 0; // O un valor predeterminado
}
if (isset($_POST['viajes_anteriores'])) {
    $viajes_anteriores = $_POST['viajes_anteriores'];
} else {
    $viajes_anteriores = 0; // O un valor predeterminado
}


$imp_viajes = $paga_x_viaje * $viajes_q_se_cobran;
$descuentos = $desc - $imp_viajes;
$suma_gastos_semanales = $debe_semanas + $total_ventas + $deuda_anterior + $imp_viajes;
$descuentos;
$porc_para_base = $tot_voucher - $descuentos;
$sub_tot_p_base = $porc_para_base + $imp_viajes;
$sub_saldo = $descuentos - $imp_viajes;
$para_depositar = $sub_saldo - $suma_gastos_semanales;



//OK --------- (errd 1) Error semanas = cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas < 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err 1) Error semanas = cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 2) Error deuda anterior menor a cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 2) Error deuda anterior menor a cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 3) Error saldo a favor menor que cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor < 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 3) Error saldo a favor menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 4) Error efectivo menor que cero
if ($tot_voucher == 0 && $new_dep_ft < 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 4) Error efectivo menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 5) Error Saldo a favor - deuda anterior mayores a 0
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 5) Error Saldo a favor - deuda anterior mayores a 0</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 6) Solo ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 6) Solo ventas</b>";
    echo "<br>Total Ventas: " . $ventas;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $deuda_anterior = $ventas;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 7) Solo saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 7) Solo saldo a favor</b>";
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 8) Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 8) Saldo a favor - Ventas</b>";
    if ($saldo_a_favor > $ventas) {
        $saldo = $saldo_a_favor - $ventas;
        echo "<br>Paga y sobra..." . $saldo;
        $saldo_a_favor = $saldo;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        echo "<br>Le queda a favor descontando la venta: " . $saldo_a_favor = $saldo;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo_a_favor == $ventas) {
        echo "<br>Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo_a_favor < $ventas) {
        echo "<br>Falta plata...";
        $saldo = $saldo_a_favor - $ventas;
        echo "<br>Saldo: " .  $deuda_anterior = abs($saldo);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 9) Solo deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 9) Solo deuda anterior</b>";
    echo "<br>Solo tiene deuda anterior...<br>";
    echo "<a href='inicio_cobros.php'>VOLVER</a>";

    exit;
}
//OK --------- (cod 10) Deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 10) Deuda anterior - ventas</b>";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda Anterior: " . $deuda_anterior;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $deuda_anterior = $deuda_anterior + $ventas;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 11) Solo semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 11) Solo semanas</b>";
    echo "<br>Solo debe semanas...<br>";
    echo "<a href='inicio_cobros.php'>VOLVER</a>";
    exit;
}
//OK --------- (cod 12) Ventas - Semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 12) Ventas - Semanas</b>";
    echo $ventas;
    $deuda_anterior = $ventas;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 13) Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 13) Semanas - Saldo a favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $deuda = $saldo_a_favor - $debe_semanas + $ventas;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
?>
        <script>
            if (confirm('¿El minimo que debes depositar es <?php echo $x_semana ?> ')) {
                window.location.href = 'inicio_cobros.php';
            } else {
                alert('Operación cancelada.');
            }
        </script>
    <?php
        exit;
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, se puede pagar";
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>" . $total = $x_semana;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>" . $saldo_a_favor = $deuda;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 14) Semanas - Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 14) Semanas - Saldo a favor - Ventas</b>";

    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $deuda = $saldo_a_favor - $debe_semanas;
    echo "<br>Saldo: " . $deuda;
    echo "<br>Ventas: " . $ventas;
    $deuda = $deuda - $ventas;
    echo "<br>Deuda: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        $pagar = $x_semana;
        //exit;
    ?>
        <script>
            if (confirm('¿El minimo que debes depositar es <?php echo $pagar ?> ')) {
                window.location.href = 'inicio_cobros.php';
            } else {
                alert('Operación cancelada.');
            }
        </script>
<?php
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, se puede pagar";
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Total: " . $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>" . $total = $x_semana;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $deuda;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 15) Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 15) Semanas - Deuda anterior</b>";

    echo "<script>
    alert('Debe semanas: " . $debe_semanas . "\\nDeuda anterior: " . $deuda_anterior . "');
    window.location.href = \"inicio_cobros.php\";
</script>";
    exit;
}
//OK ---------- (cod 16) Semanas - deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "(cod 16) Semanas - deuda anterior - ventas...";

    echo "<script>
    alert('Debe semanas: " . $debe_semanas . "\\nDeuda anterior: " . $deuda_anterior . " . \\nVentas: " . $ventas . "');
    window.location.href = \"inicio_cobros.php\";
</script>";

    exit;
}
//OK ---------- (cod 17) Deposito solo
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "(cod 17) Deposito solo plata con deudas en 0";

    $resto_dep_mov = $new_dep_ft;
    $saldo_a_favor = $resto_dep_mov;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 18) Deposito - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 18) Deposito - Ventas</b>";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;

    $deuda = $new_dep_ft - $ventas;
    echo "<br>Deuda Total: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<script>
    alert('\\nDebe depositar minimo: " . $ventas . "');
    window.location.href = \"inicio_cobros.php\";
</script>";
    } elseif ($deuda == 0) {
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $new_dep_ft = abs($new_dep_ft);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $resto = $new_dep_ft - $ventas;
        $saldo_a_favor = $resto;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 19) Deposito - saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 19) Deposito - saldo a favor</b>";
    $estado = 0;
    echo "<br>Saldoafavor: " . $saldo_a_favor;
    $resto_dep_mov = $new_dep_ft + $saldo_a_favor;
    echo "<br>Resto paramovil: " . $resto_dep_mov;
    $saldo_a_favor = $resto_dep_mov;
    //exit;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 20) Deposito - saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 20) Deposito - saldo a favor - Ventas</b>";

    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $resto_dep_mov = $new_dep_ft + $saldo_a_favor - $ventas;
    echo "<br>Resto dep movil: " . $resto_dep_mov;
    echo "<br><br><br>";


    if ($resto_dep_mov < 0) {
        echo "<br>No alcanza la plata...";
        echo "<br>Falta pagar: " . $new_dep_ft;
        $deuda_anterior = $new_dep_ft;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Saldo cero...";
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Sobra plata... ";
        $saldo_a_favor = $resto_dep_mov;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 21) Deposito - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 21) Deposito - Deuda anterior</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $deuda_anterior - $new_dep_ft;
    echo "<br><br<<br>";
    //exit;
    if ($deuda > 0) {
        $saldo_a_favor = 0;
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Nueva deuda anterior: " . $deuda_anterior = $deuda_anterior - $new_dep_ft;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {

        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda < 0) {

        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $saldo_a_favor = $deuda;
        echo "<br>Saldo a favor: " . $deuda_anterior = 0;
        $resto_dep_mov = $deuda;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 22) Deposito - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 22) Deposito - Deuda anterior - Ventas</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $deuda = $deuda_anterior + $ventas - $new_dep_ft;

    if ($deuda > 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $deuda_anterior = $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda < 0) {
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $deuda;
        $resto_dep_mov = $deuda;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 23) Deposito - semanas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 23) Deposito - semanas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas;
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        $deuda = abs($deuda);
        $new_dep_ft = abs($new_dep_ft);
        $total = $x_semana;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $resto_dep_mov = $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $resto_dep_mov;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>New dep ft: " . $new_dep_ft;
        echo "<br>Deposito al movil:" . $resto_dep_mov;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 24) Deposito - Semanas - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 24) Deposito - Semanas - Ventas</b>";

    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot = $debe_semanas + $ventas;
    echo "<br>Total: " . $deuda = $new_dep_ft - $tot;
    echo "<br><br>";

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $deuda;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Resto dep movil:" . $resto_dep_mov = $deuda;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 25) Deposito - Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 25) Deposito - Semanas - Saldo a favor</b>";

    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot = $saldo_a_favor - $debe_semanas;
    echo "<br>Total: " . $deuda = $new_dep_ft + $tot;
    echo "<br><br>";
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        $deuda = abs($deuda);
        echo "<br>Tiene que quedar en deuda anterior: " . $deuda;
        echo "<br>Deposito en FT: " . $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Debe semanas: " . $debe_semanas;
        $deuda_anterior = $debe_semanas - $saldo_a_favor - $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $total = $x_semana;
        $deuda_anterior = $deuda;
        $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deposito en FT: " . $new_dep_ft = abs($new_dep_ft);
        echo "<br>Debe semanas:" . $debe_semanas;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $resto_dep_mov = $saldo_a_favor - $debe_semanas + $new_dep_ft;
        echo "<br>Para depositarle al movil: " . $resto_dep_mov;
        $total = $x_semana;
        $deuda_anterior = 0;
        $saldo_a_favor = $deuda;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 26) Deposito - semanas - saldo a favor - ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 26) Deposito - semanas - saldo a favor - ventas</b>";


    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $tot = $saldo_a_favor - $debe_semanas - $ventas;
    echo "<br>Total: " . $deuda = $new_dep_ft + $tot;
    echo "<br><br>";
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = $deuda;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Saldo a favor:  " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        $saldo_a_favor;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $saldo_a_favor - $debe_semanas - $ventas + $new_dep_ft;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $estado = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 27) Deposito - Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    $estado = 0;
    echo "<b>(cod 27) Deposito - Semanas - Deuda anterior</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas - $deuda_anterior;
    //exit;
    echo "<br><br>";
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        $pago = abs($deuda);
        echo "<br>Saldo a favor: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $resto_dep_mov = $new_dep_ft - $deuda_anterior - $debe_semanas;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 28) Deposito - Semanas - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 28) Deposito - Semanas - Deuda anterior - Ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas - $deuda_anterior - $ventas;
    //exit;
    echo "<br><br>";
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        $pago = abs($deuda);
        echo "<br>Saldo a favor: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $resto_dep_mov = $new_dep_ft - $deuda_anterior - $debe_semanas - $ventas;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $saldo_a_favor = $resto_dep_mov;
        $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//--------------VOUCHER--------------------

$tot_viajes = $viajes_anteriores + $total_de_viajes;

$v_a_guardar = $tot_viajes - $viajes_q_se_cobran;

$estado = 0;
//OK ---------- (cod 29) Voucher solo
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 29) Voucher solo</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Saldo a favor: " . $saldo_a_favor = $noventa - $paga_de_viajes;
    //exit;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 30) Voucher - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 30) Voucher - Ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $ventas;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        echo "<br>deuda_anterior: " . $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 31) Voucher - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 31) Voucher - saldo a favor</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes;
    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Noventa: " . $noventa;
    echo "<br>Diez: " . $diez;
    echo "<br>Paga de viajes: " . $paga_de_viajes;
    echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil + $saldo_leido;
    $deuda_anterior = 0;
    //exit;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 32) Voucher - Saldo a favor - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 32) Voucher - Saldo a favor - Ventas</b>";

    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes;
    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Noventa: " . $noventa;
    echo "<br>Diez: " . $diez;
    echo "<br>Paga de viajes: " . $paga_de_viajes;
    echo "<br>Saldo leido: " . $saldo_leido;
    echo "<br>Total p movil: " . $total_p_movil = $saldo_leido + $noventa - $ventas - $paga_de_viajes;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Total para movil: " . $total_p_movil;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Total para movil: " . $total_p_movil;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        echo "<br>Total para movil: " . $total_p_movil;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 33) voucher - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 33) voucher - Deuda anterior</b>";
    include_once "../../../includes/cant_viajes.php";
    $deuda_anterior;
    $tot_voucher;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;

    if ($total_p_movil > 0) {
        echo "<br>Paga de mas...";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata... ";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;
        $total_p_movil = abs($total_p_movil);
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $total_p_movil;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        //exit;
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;
        $total_p_movil = abs($total_p_movil);

        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 34) voucher - Deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 34) voucher - Deuda anterior - ventas</b>";
    include_once "../../../includes/cant_viajes.php";

    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;

    if ($total_p_movil > 0) {
        echo "<br>Paga de mas...";
        echo "<br>Ventas: " . $ventas;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior - $ventas;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata... ";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;
        $total_p_movil = abs($total_p_movil);
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Diez: " . $diez = $tot_voucher * .1;
        echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
        echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
        echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
        echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $deuda_anterior;
        $total_p_movil = abs($total_p_movil);
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (err cod 35) voucher - Deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 35) voucher - Deuda anterior - saldo a favor</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK ---------- (err cod 36) voucher - Deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 36) voucher - Deuda anterior - saldo a favor - ventas</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK ---------- (cod 37) voucher semanas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 37) voucher semanas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Total voucher: " . $tot_voucher;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa - $paga_de_viajes - $debe_semanas;
    echo "<br>Total para movil: " . $total_p_movil;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 38) Voucher - Semanas - postergar semana
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana > 0) {
    echo "<b>(cod 38) voucher - Semanas - Postergar semana</b>";
    echo "<br>Tiene que depositar, no cobrar...";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 39) voucher - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 39) voucher - semanas - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Ventas: " . $ventas;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes + $ventas;
    $para_movil = $noventa - $paga_de_viajes - $ventas;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa - $paga_de_viajes - $debe_semanas - $ventas;
    echo "<br>Total para movil: " . $total_p_movil;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 40) voucher - semanas - ventas - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana > 0) {

    echo "<b>(cod 40) voucher - Semanas - Postergar semana</b>";
    echo "<br>Tiene que depositar, no cobrar...";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 41) voucher - semanas - saldo_a_favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 41) voucher - semanas - saldo_a_favor</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    $paga_de_viajes = $tot_via;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base + $saldo_leido;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total paramovil: " . $total_p_movil;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_voucher = $total_p_movil;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_voucher = $total_p_movil;
        echo "<br>Saldo ft: " . $new_dep_ft;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_voucher = $total_p_movil;
        echo "<br>Saldo ft: " . $new_dep_ft;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 42) voucher - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 42) voucher - semanas - saldo a favor - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo leido a favor: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Paga de viajes: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
    echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
    echo "<br>Total para movil: " . $total_p_movil = $saldo_leido + $noventa - $debe_semanas - $ventas - $paga_de_viajes;

    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Total para movil: " . $total_p_movil;
        $total = $x_semana;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_voucher = $total_p_movil;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $total = $x_semana;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_voucher = $total_p_movil;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $total = $x_semana;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_voucher = $total_p_movil;
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 43) voucher - semanas - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 43) voucher - semanas - Deuda anterior</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
    echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
    echo "<br>paga total de viajes: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Deuda: " . $deuda = $debe_semanas + $deuda_anterior + $paga_de_viajes;
    echo "<br>Total para movil: " . $total_p_movil = $noventa - $deuda;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        echo "<br>PAga x semana: " .  $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $deuda_anterior = abs($deuda_anterior);
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $saldo_a_favor = 0;
        echo "<br>Paga x semana: " .  $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;

        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
##---------------------------FALTA----------------------------------
//OK --------- (cod 44) voucher - semanas - Deuda anterior - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana > 0) {

    echo "<b>(cod 44) voucher - semanas - Deuda anterior - postergar pago</b>";
    echo "<br>Tiene que depositar, no cobrar...";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    //header("Location: inicio_cobros.php");
    exit;
}
##------------------------------------------------------------------

//OK --------- (cod 45) voucher - Semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 45) voucher - Semanas - deuda anterior - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Venats: " . $ventas;
    echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
    echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
    echo "<br>paga total de viajes: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Deuda: " . $deuda = $debe_semanas + $deuda_anterior + $paga_de_viajes + $ventas;
    echo "<br>Total para movil: " . $total_p_movil = $noventa - $deuda;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        echo "<br>PAga x semana: " .  $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $deuda_anterior = abs($deuda_anterior);
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $saldo_a_favor = 0;
        echo "<br>Paga x semana: " .  $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
##---------------------------FALTA----------------------------------
//OK --------- (cod 46) voucher - semanas - Deuda anterior - ventas - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana > 0) {

    echo "<b>(cod 46) voucher - semanas - Deuda anterior - ventas - postergar pago</b>";
    echo "<br>Tiene que depositar, no cobrar...";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";

    //header("Location: inicio_cobros.php");
    exit;
}
##------------------------------------------------------------------

//OK --------- (err cod 47) voucher - Semanas - deuda anterior - Saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 47) voucher - Semanas - deuda anterior - Saldo a favor</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err cod 48) voucher - semanas - deuda anterior - Saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 48) voucher - semanas - deuda anterior - Saldo a favor - ventas</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK  --------- (cod 49) voucher - Deposito
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 49) voucher - Deposito</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $ventas;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        echo "<br>deuda_anterior: " . $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 50) voucher - deposito - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 50) Voucher - deposito - Ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>New dep FT: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $ventas + $new_dep_ft;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        echo "<br>deuda_anterior: " . $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 51) voucher - deposito - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 51) voucher - deposito - saldo a favor</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>New dep ft: " . $new_dep_ft;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Paga de viajes: " . $paga_de_viajes;
    echo "<br>Para movil: " . $total_p_movil = $noventa + $saldo_a_favor + $new_dep_ft - $paga_de_viajes;
    echo "<br>Total p amovil: " . $total_p_movil;
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 52) voucher - deposito - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 52) voucher - deposito - saldo a favor - ventas</b>";
    echo "<br>New dep FT: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Diez: " . $diez = $tot_voucher * .1;
    echo "<br>Noventa: " . $noventa = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base = $diez + $paga_de_viajes;
    echo "<br>Para movil: " . $para_movil = $noventa - $paga_de_viajes;
    echo "<br>Viajes que se cobran: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total p amovil: " . $total_p_movil = $noventa - $paga_de_viajes - $ventas + $new_dep_ft + $saldo_a_favor;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        echo "<br>deuda_anterior: " . $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $total_p_movil = abs($total_p_movil);
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 53) voucher - deposito - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 53) voucher - deposito - deuda anterior</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
    echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
    echo "<br>paga total de viajes: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Deuda: " . $deuda = $deuda_anterior + $paga_de_viajes;
    echo "<br>Total para movil: " . $total_p_movil = $new_dep_ft + $noventa - $deuda;
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $deuda_anterior = abs($deuda_anterior);
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $saldo_a_favor = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 54) voucher - deposito - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 54) voucher - deposito - deuda anterior - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
    echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
    echo "<br>paga total de viajes: " . $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Deuda: " . $deuda = $deuda_anterior + $paga_de_viajes;
    echo "<br>Total para movil: " . $total_p_movil = $new_dep_ft + $noventa - $deuda - $ventas;;
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $saldo_a_favor = $total_p_movil;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = $total_p_movil;
        $deuda_anterior = abs($deuda_anterior);
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Sobra plata";
        echo "<br>Comision para base: " . $diez = $tot_voucher * .1;
        echo "<br>Para el movil: " . $noventa = $tot_voucher * .9;
        echo "<br>Paga de viajes: " . $paga_de_viajes;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 55) voucher - deposito - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 55) voucher - deposito - deuda anterior - saldo a favor</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err cod 56) voucher - deposito - deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 56) voucher - deposito - deuda anterior - saldo a favor - ventas</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 57) voucher - deposito - semanas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 57) voucher - deposito - semanas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Deosito FT: " . $new_dep_ft;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa + $new_dep_ft - $paga_de_viajes - $debe_semanas;
    echo "<br>Total para movil: " . $total_p_movil;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 58) voucher - deposito - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 58) voucher - deposito - semanas - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Deosito FT: " . $new_dep_ft;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa + $new_dep_ft - $paga_de_viajes - $ventas;
    echo "<br>Total para movil: " . $total_p_movil;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 59) voucher - deposito - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 59) voucher - deposito - semanas - saldo a favor - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Deosito FT: " . $new_dep_ft;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Saldo a favor: " . $saldo_leido;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    $total_p_movil = $noventa + $saldo_leido + $new_dep_ft - $paga_de_viajes - $ventas - $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor = $saldo_leido;
    echo "<br>Total para movil: " . $total_p_movil;
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK---------- (cod 60) voucher - deposito - semanas - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 60) voucher - deposito - semanas - deuda anterior</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Deposito FT: " . $new_dep_ft;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes + $deuda_anterior  + $debe_semanas;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total para movil: " . $total_p_movil = $noventa + $new_dep_ft - $paga_de_viajes - $debe_semanas - $deuda_anterior;
    //exit;
    echo "<br>Saldo a favor: " . $saldo_a_favor = $saldo_leido;
    echo "<br>Total para movil: " . $total_p_movil;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        $total = $x_semana;
        $deuda_anterior = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        $total = $x_semana;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $total = $x_semana;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 61) voucher - deposito - semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 61) voucher - deposito - semanas - deuda anterior - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Deposito FT: " . $new_dep_ft;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Ventas: " . $ventas;
    $diez = $tot_voucher * .1;
    $noventa = $tot_voucher * .9;
    $para_base = $diez + $paga_de_viajes + $deuda_anterior  + $debe_semanas;
    $para_movil = $noventa - $paga_de_viajes;
    $paga_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total para movil: " . $total_p_movil = $noventa + $new_dep_ft - $paga_de_viajes - $debe_semanas - $deuda_anterior - $ventas;
    echo "<br>Saldo a favor: " . $saldo_a_favor = $saldo_leido;
    echo "<br>Total para movil: " . $total_p_movil;
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Total para movil: " . $total_p_movil;
        $saldo_a_favor = $total_p_movil;
        $total = $x_semana;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Pago justo...";
        echo "<br>Noventa: " . $noventa;
        echo "<br>Diez: " . $diez;
        echo "<br>Debe semanas: " . $debe_semanas;
        $total = $x_semana;
        $total_p_movil = abs($total_p_movil);
        echo "<br>Total para movil: " . $total_p_movil;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones, $diez, $noventa, $paga_de_viajes);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3,       $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 62) voucher - deposito - semanas - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 62) voucher - deposito - semanas - deuda anterior - saldo a favor</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err cod 63) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 63) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK -------- (cod 64) No Nada
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 64) No Nada</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
