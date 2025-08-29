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
echo $postergar_semana = (int)$_POST['postergar_semana'];


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
echo "<br>" . $postergar_semana;
//exit;
$imp_viajes = $paga_x_viaje * $viajes_q_se_cobran;
$descuentos = $desc - $imp_viajes;
$suma_gastos_semanales = $debe_semanas + $total_ventas + $deuda_anterior + $imp_viajes;
$descuentos;
$porc_para_base = $tot_voucher - $descuentos;
$sub_tot_p_base = $porc_para_base + $imp_viajes;
$sub_saldo = $descuentos - $imp_viajes;
$para_depositar = $sub_saldo - $suma_gastos_semanales;


//OK --------- (errd 0) Error semanas = cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err 0) Error semanas = cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 1) Error deuda anterior menor a cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 1) Error deuda anterior menor a cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 2) Error saldo a favor menor que cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor < 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 2) Error saldo a favor menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 3) Error efectivo menor que cero
if ($tot_voucher == 0 && $new_dep_ft < 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 3) Error efectivo menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 4) Error Saldo a favor - deuda anterior mayores a 0
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 4) Error Saldo a favor - deuda anterior mayores a 0</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 5) Solo ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 5) Solo ventas</b>";
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
//OK --------- (cod 6) Solo saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 6) Solo saldo a favor</b>";
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 7) Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 7) Saldo a favor - Ventas</b>";
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
        echo "Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 8) Solo deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 8) Solo deuda anterior</b>";
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 9) Deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 9) Deuda anterior - ventas</b>";
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
//OK --------- (cod 10) Solo semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 10) Solo semanas</b>";
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 11) Ventas - Semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 11) Ventas - Semanas</b>";

    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 12) Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 12) Semanas - Saldo a favor</b>";
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
//OK --------- (cod 13) Semanas - Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 13) Semanas - Saldo a favor - Ventas</b>";
    echo "<b>(cod 12) Semanas - Saldo a favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $deuda = $saldo_a_favor - $debe_semanas;
    echo "<br>Saldo: " . $deuda;
    echo "<br>Ventas: " . $ventas;
    $deuda = $deuda - $ventas;
    echo "<br>Deuda: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
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
//OK --------- (cod 14) Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 14) Semanas - Deuda anterior</b>";

    echo "<script>
    alert('Debe semanas: " . $debe_semanas . "\\nDeuda anterior: " . $deuda_anterior . "');
    window.location.href = \"inicio_cobros.php\";
</script>";
    exit;
}
//OK ---------- (cod 15) Semanas - deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "(cod 15) Semanas - deuda anterior - ventas...";
    $sql_sss = "SELECT * FROM completa WHERE movil = $movil";
    $res_sss = $con->query($sql_sss);
    $row_sss = $res_sss->fetch_assoc();
    echo $row_sss['venta_1'];

    $sql_update = "UPDATE completa 
               SET venta_1 = 0, venta_2 = 0, venta_3 = 0, venta_4 = 0, venta_5 =0
                
               WHERE movil = $movil";

    if ($con->query($sql_update) === TRUE) {
        echo "Las ventas fueron actualizadas a 0 correctamente.";
    } else {
        echo "Error al actualizar las ventas: " . $con->error;
    }
    ?>
    <script>
        // Variables con los valores que querés mostrar
        let debeSemanas = <?php echo $debe_semanas; ?>;
        let deudaAnterior = <?php echo $deuda_anterior; ?>;
        let ventas = <?php echo $ventas; ?>;
        window.onload = function() {
            alert("No puede comprar, Operacion cancelada\nDebe semanas: " + debeSemanas + "\nTiene deuda anterior: $" + deudaAnterior + "\nVentas actuales: " + ventas);
            window.location.href = "inicio_cobros.php"; // Cambiá esta URL por la que quieras
        };
    </script>
<?php
    exit;
}
//OK ---------- (cod 16) Deposito solo
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "(cod 16) Deposito solo plata con deudas en 0";
    //$saldo_a_favor = $new_dep_ft;
    $estado = 0;
    $resto_dep_mov = $new_dep_ft;

    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 17) Deposito - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 17) Deposito - Ventas</b>";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;

    $deuda = $new_dep_ft - $ventas;
    echo "<br>Deuda Total: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
    } elseif ($deuda == 0) {
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $new_dep_ft = abs($new_dep_ft);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 18) Deposito - saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 18) Deposito - saldo a favor</b>";
    $estado = 0;
    echo "<br>Saldoafavor: " . $saldo_a_favor;
    $resto_dep_mov = $new_dep_ft + $saldo_a_favor;
    echo "<br>Resto paramovil: " . $resto_dep_mov;
    $saldo_a_favor = 0;
    //exit;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 19) Deposito - saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 19) Deposito - saldo a favor - Ventas</b>";

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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Sobra plata... ";
        $saldo_a_favor = $resto_dep_mov;
        $deuda_anterior = 0;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 20) Deposito - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 20) Deposito - Deuda anterior</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $deuda_anterior - $new_dep_ft;
    echo "<br><br<<br>";
    //exit;
    if ($deuda > 0) {
        $estado = 0;
        $saldo_a_favor = 0;
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Nueva deuda anterior: " . $deuda_anterior = $deuda_anterior - $new_dep_ft;
        $resto_dep_mov = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        $estado = 0;
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $estado = 0;
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;

        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $resto_dep_mov = $deuda;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 21) Deposito - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 21) Deposito - Deuda anterior - Ventas</b>";
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
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $resto_dep_mov = $deuda;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $DEP_COU, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 22) Deposito - semanas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 22) Deposito - semanas</b>";
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
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $resto_dep_mov = $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>New dep ft: " . $new_dep_ft;
        echo "<br>Deposito al movil:" . $resto_dep_mov;
        $total = $x_semana;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $DEP_VOU, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 23) Deposito - Semanas - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 23) Deposito - Semanas - Ventas</b>";

    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot = $debe_semanas + $ventas;
    echo "<br>Total: " . $deuda = $new_dep_ft - $tot;
    echo "<br><br>";
    //exit;
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
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Resto dep movil:" . $resto_dep_mov = $deuda;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 24) Deposito - Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 24) Deposito - Semanas - Saldo a favor</b>";

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
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        $saldo_a_favor = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 25) Deposito - semanas - saldo a favor - ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 25) Deposito - semanas - saldo a favor - ventas</b>";


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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 26) Deposito - Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    $estado = 0;
    echo "<b>(cod 26) Deposito - Semanas - Deuda anterior</b>";
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 27) Deposito - Semanas - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 27) Deposito - Semanas - Deuda anterior - Ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda totaal: " . $tot = $debe_semanas + $ventas + $deuda_anterior;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $tot;
    $estado = 0;
    //exit;
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br><br>";
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $new_dep_ft - $debe_semanas - $deuda_anterior - $ventas;
        $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//--------------VOUCHER--------------------

$tot_viajes = $viajes_anteriores + $total_de_viajes;

$v_a_guardar = $tot_viajes - $viajes_q_se_cobran;

$estado = 0;
//OK ---------- (cod 30) Voucher solo
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 30) Voucher solo</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    $dep_vou = $resto_dep_mov;
    $resto_dep_mov = 0;
    $dep_voucher = $dep_vou;
    echo "<br>Movil: " . $movil;
    echo "<br>Dep vou: " . $dep_vou;

    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    borraVoucher($con, $movil);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 31) Voucher - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 31) Voucher - Ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    $resto_dep_mov = $resto_dep_mov - $ventas;
    echo "<br>Resto para depositarle al movil: " . $resto_dep_mov;

    if ($resto_dep_mov > 0) {
        echo "<br>Ventas: " . $ventas;

        echo "<br>Se le deposita: " . $resto_dep_mov;
        echo "<br>Deposito en voucher: " . $dep_voucher = $resto_dep_mov;
        //echo "<br>Resto dep movil: " . $resto_dep_mov = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        echo "<br>Resto dep movil: " . $dep_vou = $resto_dep_mov;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov <= 0) {

        $deuda_anterior = abs($resto_dep_mov);
        echo "<br>Deposito en voucher:: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $resto_dep_mov = 0;
        $saldo_a_favor = 0;
        echo "<br><br>Va para deuda anterior: " . $deuda_anterior;

        $dep_voucher = $tot_voucher;
        echo "<br>Deposito en voucher: " . $dep_voucher;
        $resto_dep_mov = 0;
        $dep_vou = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        exit;
    }

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 32) Voucher - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 32) Voucher - saldo a favor</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Para_movil: " . $para_movil;
    echo "<br><br><br>";
    $resto_dep_mov = $saldo_leido;
    echo "<br>Deposito para elmovil saldo a favor + voucheractual: " . $resto_dep_mov;
    echo "<br>Saldo leido: " . $saldo_leido;
    echo "<br>Deposito en  voucher: " . $para_movil;
    echo "<br>Dep voucher: " . $dep_voucher = $para_movil;
    echo "<br>Para movil: " . $dep_vou = $para_movil + $saldo_leido;


    //exit;
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 33) Voucher - Saldo a favor - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<br><b>(cod 33) Voucher - Saldo a favor - Ventas</b>";

    include_once "../../../includes/cant_viajes.php";

    $estado = 0;
    echo "<br><br><br>";
    $saldo_leido;
    $ventas;
    $para_movil;
    $total_p_movil = $saldo_leido + $para_movil - $ventas;

    $total_p_movil;  //Sin decimales
    $para_movil = $total_p_movil;
    echo "<br>Total paramovil: " . $total_p_movil;

    if ($total_p_movil > 0) {
        echo "<br>Sobraplata...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        echo "<br>Para Movil: " . $dep_voucher;
        $dep_vou = $dep_voucher;
        echo "<br>Dep vou: " . $dep_vou = $para_movil;
        echo "<br>Total en voucher: " . $dep_voucher = $tot_voucher;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata: ";
        $total_p_movil = abs($total_p_movil);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        echo "<br>Deuda del movil: " . $total_p_movil;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        //exit;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($total_p_movil == 0) {
        echo "<br>Falta plata: ";
        $total_p_movil = abs($total_p_movil);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        echo "<br>Deuda del movil: " . $total_p_movil;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        //exit;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 34) voucher - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 34) voucher - Deuda anterior</b>";

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $saldo = $para_movil - $deuda_anterior - $tot_via;

    $saldo = round($saldo);

    if ($saldo > 0) {
        echo "<br>Sobra dinero, depositarle...";
        $saldo = abs($saldo);

        $saldo_a_favor = 0;
        $deuda_anterior = 0;

        $resto_dep_mov = $saldo;
        echo "<br>Sobran: " . $resto_dep_mov;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        $dep_vou = $resto_dep_mov;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($saldo < 0) {
        echo "<br>No alcanza para cubrir la deuda...";
        $saldo = abs($saldo);
        echo "<br>Deuda: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = $saldo;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo == 0) {
        echo "<br>Sobra dinero, depositarle...";
        $saldo = abs($saldo);

        $saldo_a_favor = 0;
        $deuda_anterior = 0;

        $resto_dep_mov = $saldo;
        echo "<br>Sobran: " . $resto_dep_mov;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        $dep_vou = $resto_dep_mov;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 35) voucher - Deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 35) voucher - Deuda anterior - ventas</b>";

    include_once "../../../includes/cant_viajes.php";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $saldo = $para_movil - $deuda_anterior - $tot_via - $ventas;
    echo "<br>Saldo: " . $saldo = round($saldo);
    //exit;
    if ($saldo > 0) {
        echo "<br>Sobra dinero, depositarle...";
        $saldo = abs($saldo);
        echo "<br>Ventas: " . $ventas;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;

        $resto_dep_mov = $saldo;
        echo "<br>Sobran: " . $resto_dep_mov;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        $dep_vou = $resto_dep_mov;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($saldo < 0) {
        echo "<br>No alcanza para cubrir la deuda...";
        $saldo = abs($saldo);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = $saldo;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        $deuda_anterior = $deuda_anterior + $ventas;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo == 0) {
        echo "<br>Dinero Justo...";
        $saldo = abs($saldo);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = $saldo;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        $deuda_anterior = $deuda_anterior + $ventas;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $deuda_anterior = 0;
        echo "<br>Voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep voucher: " . $dep_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (err cod 36) voucher - Deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 36) voucher - Deuda anterior - saldo a favor</b>";
    exit;
}
//OK ---------- (err cod 37) voucher - Deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 37) voucher - Deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK ---------- (cod 38) voucher semanas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 38) voucher semanas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    echo $mensaje;
    echo "<br>";






    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
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

        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 38 a) Voucher - Semanas - postergar semana
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana > 0) {

    echo "<b>(cod 38 a) voucher - Semanas - Postergar semana</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Mensaje: " . $mensaje;
    echo "<br>Debe cant de semanas: " . $cant_semanas = $debe_semanas / $x_semana;
    echo "<br>paga_semanas: " . $postergar_semana;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Para el movil: " . $en_voucher = $tot_voucher * .9;
    echo "<br>Descuentos: " . $para_mo = $en_voucher - $debe_semanas;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>No pagara de semanas: " . $semanas_que_paga = $postergar_semana * $x_semana;
    echo "<br>Para movil: " . $dep_vou = $para_mo - $tot_via + $semanas_que_paga;
    echo "<br>resto de semanas a pagar: " . $total = $debe_semanas - $semanas_que_paga;
    echo "<br>Quedan semanas a cuenta: " . $total = $total + $x_semana;
    //echo "<br>Semanas que paga: " . $total = $semanas_que_paga;
    $dep_voucher = $tot_voucher;
    $deuda_anterior = 0;
    $saldo_a_favor = 0;
    //exit;
    actualizaSemPagadas($con, $movil, $total);
    obsDeuda($con, $movil, $postergar_semana, $mensaje);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 39) voucher - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 39) voucher - semanas - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Para base: " . $para_base;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $deuda = $ventas + $debe_semanas;
    echo "<br>Deuda: " . $deuda;
    $total_p_movil = $para_movil - $deuda;
    echo "<br>Total para movil: " . $total_p_movil;


    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {
        echo "<br><br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        echo "<br>Ventas: " . $ventas;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $resto_dep_mov = $total_p_movil;
        echo "<br>Resto dep moviles: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Dep de voucher: " . $dep_voucher;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Ventas: " . $ventas;
        $total_p_movil = abs($total_p_movil);
        echo "<br>A deuda anterior: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pago justo: : " . $total_p_movil;
        echo "<br>Ventas: " . $ventas;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $resto_dep_mov = $total_p_movil;
        //
        echo "<br>Total de voucher: " . $tot_voucher;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 39 a) voucher - semanas - ventas - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana > 0) {

    echo "<b>(cod 38 a) voucher - Semanas - Postergar semana</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Mensaje: " . $mensaje;
    echo "<br>Debe cant de semanas: " . $cant_semanas = $debe_semanas / $x_semana;
    echo "<br>paga_semanas: " . $postergar_semana;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Para el movil: " . $en_voucher = $tot_voucher * .9;
    echo "<br>Descuentos: " . $para_mo = $en_voucher - $debe_semanas;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>No pagara de semanas: " . $semanas_que_paga = $postergar_semana * $x_semana;
    echo "<br>Para movil: " . $dep_vou = $para_mo - $tot_via + $semanas_que_paga - $ventas;
    echo "<br>resto de semanas a pagar: " . $total = $debe_semanas - $semanas_que_paga;
    echo "<br>Quedan semanas a cuenta: " . $total = $total + $x_semana;
    echo "<br>Ventas: " . $ventas;
    $dep_voucher = $tot_voucher;
    $deuda_anterior = 0;
    $saldo_a_favor = 0;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    //exit;
    actualizaSemPagadas($con, $movil, $total);
    obsDeuda($con, $movil, $postergar_semana, $mensaje);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);

    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 40) voucher - semanas - saldo_a_favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 40) voucher - semanas - saldo_a_favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base + $saldo_leido;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total paramovil: " . $total_p_movil;
    //exit;
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
        $dep_vou = $total_p_movil;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
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
        $dep_vou = $total_p_movil;
        echo "<br>Saldo ft: " . $new_dep_ft;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 41) voucher - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 41) voucher - semanas - saldo a favor - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base + $saldo_leido - $ventas;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total paramovil: " . $total_p_movil;
    //exit;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {

        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Total paramovil: " . $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Total paramovil: " . $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 42) voucher - semanas - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 42) voucher - semanas - Deuda anterior</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    //exit;


    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base - $deuda_anterior;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;

        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        echo "<br>Vieja deuda anterior: " . $deuda_anterior;
        echo "<br>Deuda nueva: " . $deuda_nueva = $deuda_anterior;
        $deuda_anterior = $deuda_nueva;
        //$observaciones = $mensaje;
        //exit;
        //obsDeuda($con, $movil, $postergar_semana, $mensaje);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        echo "<br>Vieja deuda anterior: " . $deuda_anterior;
        echo "<br>Deuda nueva: " . $deuda_nueva = $deuda_anterior;
        $deuda_anterior = $deuda_nueva;
        //exit;
        //obsDeuda($con, $movil, $postergar_semana, $mensaje);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
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
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 42 a) voucher - semanas - Deuda anterior - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana > 0) {

    echo "<b>(cod 42 a) voucher - semanas - Deuda anterior - postergar pago</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Mensaje: " . $mensaje;
    echo "<br>Debe cant de semanas: " . $cant_semanas = $debe_semanas / $x_semana;
    echo "<br>paga_semanas: " . $postergar_semana;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Para el movil: " . $en_voucher = $tot_voucher * .9;
    echo "<br>Descuentos: " . $para_mo = $en_voucher - $debe_semanas;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>No pagara de semanas: " . $semanas_que_paga = $postergar_semana * $x_semana;
    echo "<br>Para movil: " . $dep_vou = $para_mo - $tot_via + $semanas_que_paga - $ventas - $deuda_anterior;
    echo "<br>resto de semanas a pagar: " . $total = $debe_semanas - $semanas_que_paga;
    echo "<br>Quedan semanas a cuenta: " . $total = $total + $x_semana;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda anterior: " . $deuda_anterior;

    $dep_voucher = $tot_voucher;
    $deuda_anterior = 0;
    $saldo_a_favor = 0;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    //exit;
    actualizaSemPagadas($con, $movil, $total);
    obsDeuda($con, $movil, $postergar_semana, $mensaje);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);

    header("Location: inicio_cobros.php");
    exit;
}

//OK --------- (cod 43) voucher - Semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 43) voucher - Semanas - deuda anterior - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base - $deuda_anterior - $ventas;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        echo "<br>Queda debiendo: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        $total_p_movil = abs($total_p_movil);
        echo "<br>Paga justo: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Total de voucher: " . $dep_voucher;
        $dep_vou = $dep_voucher;
        $saldo_a_favor = 0;
        $dep_vou = $total_p_movil;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 43 a) voucher - semanas - Deuda anterior - ventas - postergar pago
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana > 0) {

    echo "<b>(cod 43 a) voucher - semanas - Deuda anterior - ventas - postergar pago</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Mensaje: " . $mensaje;
    echo "<br>Debe cant de semanas: " . $cant_semanas = $debe_semanas / $x_semana;
    echo "<br>paga_semanas: " . $postergar_semana;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Para el movil: " . $en_voucher = $tot_voucher * .9;
    echo "<br>Descuentos: " . $para_mo = $en_voucher - $debe_semanas;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>No pagara de semanas: " . $semanas_que_paga = $postergar_semana * $x_semana;
    echo "<br>Para movil: " . $dep_vou = $para_mo - $tot_via + $semanas_que_paga - $ventas - $deuda_anterior;
    echo "<br>resto de semanas a pagar: " . $total = $debe_semanas - $semanas_que_paga;
    echo "<br>Quedan semanas a cuenta: " . $total = $total + $x_semana;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda anterior: " . $deuda_anterior;

    $dep_voucher = $tot_voucher;
    $deuda_anterior = 0;
    $saldo_a_favor = 0;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    //exit;
    actualizaSemPagadas($con, $movil, $total);
    obsDeuda($con, $movil, $postergar_semana, $mensaje);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);

    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 44) voucher - Semanas - deuda anterior - Saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 44) voucher - Semanas - deuda anterior - Saldo a favor</b>";
    exit;
}
//OK --------- (err cod 45) voucher - semanas - deuda anterior - Saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 45) voucher - semanas - deuda anterior - Saldo a favor - ventas</b>";
    exit;
}
//OK  --------- (cod 46) voucher - Deposito
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 46) voucher - Deposito</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deposito: " . $new_dep_ft;
    $resto_dep_mov = $new_dep_ft + $para_movil;
    echo "<br>Deposito al movil: " . $resto_dep_mov;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    echo "<br>Para el movil: " . $para_movil;
    echo "<br>Deposito en ft: " . $new_dep_ft;
    echo "<br>Dep vou: " . $dep_vou = $new_dep_ft + $para_movil;
    $dep_voucher = $tot_voucher;
    //exit;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    borraVoucher($con, $movil);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 47) voucher - Deposito - Ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 47) voucher - Deposito - Ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Dep voucher: " . $tot_voucher;
    echo "<br>Para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito en ft: " . $new_dep_ft;
    $saldo = $resto_dep_mov + $new_dep_ft;
    echo "<br>Saldo: " . $resto_dep_mov = $saldo - $ventas;

    if ($resto_dep_mov > 0) {
        $estado = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Sobra plata...";
        echo "<br>Sobra: " . $resto_dep_mov;
        echo "<br>";
        echo "<br>Ventas: " . $ventas;
        echo "<br>Dep vou: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Cuenta: " . $cuenta = $ventas - $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>";
        echo "<br>Sobra: " . $resto = $new_dep_ft - $cuenta;
        $dep_voucher = $tot_voucher;
        echo "<br>Guarda caja final: " . $dep_voucher;
        $dep_vou = $resto;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Falta plata... ";
        $estado = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Falta: " . $resto_dep_mov;

        echo "<br>";
        echo "<br>Ventas: " . $ventas;
        echo "<br>Dep vou: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Cuenta: " . $cuenta = $ventas - $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>";
        $resto = $new_dep_ft - $cuenta;
        $resto = abs($resto);
        echo "<br>Falta: " . $resto;
        $dep_voucher = $tot_voucher;
        echo "<br>Guarda caja final: " . $dep_voucher;
        $dep_vou = $resto;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Pago justo...";
        $estado = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Sobra: " . $resto_dep_mov;
        echo "<br>";
        echo "<br>Ventas: " . $ventas;
        echo "<br>Dep vou: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Cuenta: " . $cuenta = $ventas - $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>";
        $resto = $new_dep_ft - $cuenta;
        $resto = abs($resto);
        echo "<br>Pago justo: " . $resto;
        $dep_voucher = $tot_voucher;
        echo "<br>Guarda caja final: " . $dep_voucher;
        $dep_vou = $resto;
        echo "<br>Dep vou: " . $dep_vou;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 48) voucher - deposito - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 48) voucher - deposito - saldo a favor</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo $saldo_a_favor = saldoAfavor($con, $movil);
    echo "<br>Deposito: " . $new_dep_ft;
    $resto_dep_mov = $new_dep_ft + $para_movil + $saldo_a_favor;
    $saldo_a_favor = 0;
    $deuda_anterior = 0;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    echo "<br>Dep Voucher: " . $dep_voucher = $tot_voucher;
    echo "<br>Saldo a favor: " . $saldo_leido;
    $dep_vou = $new_dep_ft + $para_movil + $saldo_leido;
    echo "<br>Dep vou: " . $dep_vou;
    //exit;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
    borraVoucher($con, $movil);

    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 49) voucher - deposito - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 49) voucher - deposito - saldo a favor - ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total en Voucher: " . $tot_voucher;
    echo "<br>";
    echo "<br>Voucher para movil: " . $para_movil;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Saldo leido: " . $saldo_leido;
    $sub_total = $new_dep_ft + $para_movil + $saldo_leido - $ventas;
    echo "<br>Total: " . $sub_total;
    if ($sub_total > 0) {
        echo "<br>Sobra plata...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        echo "<br>Total: " . $sub_total;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Sub total: " . $dep_vou = $sub_total;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($sub_total < 0) {
        echo "<br>Falta plata...";
        $sub_total = abs($sub_total);
        echo "<br>Total: " . $sub_total;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        echo "<br>Sobra plata...";
        echo "<br>Total: " . $sub_total;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Sub total: " . $dep_vou = $sub_total;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>ADeuda anterior: " . $deuda_anterior = $sub_total;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($sub_total == 0) {
        echo "<br>Pago justo...";
        echo "<br>Total: " . $sub_total;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        echo "<br>Sobra plata...";
        echo "<br>Total: " . $sub_total;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Sub total: " . $dep_vou = $sub_total;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>ADeuda anterior: " . $deuda_anterior = $sub_total;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 50) voucher - deposito - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 50) voucher - deposito - deuda anterior</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total voucher: " . $tot_voucher;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior;
    echo "<br><br><br><br>";
    if ($resto_dep_mov > 0) {
        echo "<br>Sobra plata..";
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        echo "<br>Dep vou: " . $dep_vou = $resto_dep_mov;
        //exit;
       depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($resto_dep_mov < 0) {
        $estado = 0;
        echo "<br>Falta plata...";
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br> para el movil: " . $resto_dep_mov;
        $resto_dep_mov = abs($resto_dep_mov);
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br> para el movil: " . $resto_dep_mov;
        $resto_dep_mov = abs($resto_dep_mov);
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 51) voucher - deposito - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 51) voucher - deposito - deuda anterior - ventas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Resto dep movil: " . $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior - $ventas;

    if ($resto_dep_mov > 0) {
        echo "<br>Sobra plata...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;

        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Deuda sumada: " . $deuda = $deuda_anterior + $ventas;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $new_dep_ft + $para_movil - $deuda;
        echo "<br>Dep vou: " . $dep_vou = $resto_dep_mov;
        $dep_voucher = $tot_voucher;
        $deuda_anterior = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;

        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Deuda sumada: " . $deuda = $deuda_anterior + $ventas;
        $resto = $new_dep_ft + $para_movil;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $deuda - $resto;
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;

        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Deuda sumada: " . $deuda = $deuda_anterior + $ventas;
        $resto = $new_dep_ft + $para_movil;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $deuda - $resto;
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Dep voucher: " . $dep_voucher = $tot_voucher;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 52) voucher - deposito - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 52) voucher - deposito - deuda anterior - saldo a favor</b>";
    exit;
}
//OK --------- (err cod 53) voucher - deposito - deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 53) voucher - deposito - deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK --------- (cod 54) voucher - deposito - semanas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 54) voucher - deposito - semanas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    $resto_dep_mov = $resto_dep_mov + $new_dep_ft - $debe_semanas;
    echo "<br>Deposito al movil: " . $resto_dep_mov;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>debe semana: " . $debe_semanas;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>";
    echo "<br>" . $postergar_semana;
    echo "<br>" . $mensaje;

    if ($resto_dep_mov > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Deposito: " . $new_dep_ft;
        echo "<br>debe semana: " . $debe_semanas;
        echo "<br>Para movil: " . $para_movil;
        $dep_voucher = $tot_voucher;
        $cuenta = $para_movil + $new_dep_ft;
        $tot = $cuenta - $debe_semanas;
        echo "<br>Cuenta: " . $tot;
        $dep_vou = $tot;
        $total = $x_semana;
        $estado = 0;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Falta plata...";
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Deposito: " . $new_dep_ft;
        echo "<br>debe semana: " . $debe_semanas;
        echo "<br>Para movil: " . $para_movil;
        $dep_voucher = $tot_voucher;
        $cuenta = $para_movil + $new_dep_ft;
        $tot = $cuenta - $debe_semanas;
        $tot = abs($tot);
        echo "<br>Cuenta: " . $tot;
        $deuda_anterior = $tot;
        $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Pago justo...";
        echo "<br>Total de voucher: " . $tot_voucher;
        echo "<br>Deposito: " . $new_dep_ft;
        echo "<br>debe semana: " . $debe_semanas;
        echo "<br>Para movil: " . $para_movil;
        $dep_voucher = $tot_voucher;
        $cuenta = $para_movil + $new_dep_ft;
        $tot = $cuenta - $debe_semanas;
        $tot = abs($tot);
        echo "<br>Cuenta: " . $tot;
        $deuda_anterior = $tot;
        $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 55) voucher - deposito - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 55) voucher - deposito - semanas - ventas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deudas: " . $deuda = $ventas + $debe_semanas;
    echo "<br>Deposito en Voucher: " . $resto_dep_mov;
    echo "<br>A favor: " . $a_favor = $resto_dep_mov + $new_dep_ft;
    echo "<br>Total deuda: " . $resto = $a_favor - $deuda;
    //exit;
    echo "<br><br>";
    if ($resto > 0) {
        echo "Sobra plata";
        echo "<br>Deposito en Voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        $sobra = $ventas + $debe_semanas;
        $paga = $para_movil + $new_dep_ft;
        echo "<br>Pago: " . $paga;
        echo "<br>Total: " . $resto = $paga - $sobra;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_voucher = $tot_voucher;
        $dep_voucher = $tot_voucher;
        $dep_vou = $resto;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($resto < 0) {
        echo "Falta plata";
        echo "<br>Deposito en Voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        $sobra = $ventas + $debe_semanas;
        $paga = $para_movil + $new_dep_ft;
        echo "<br>Pago: " . $paga;
        $resto = $paga - $sobra;
        $resto = abs($resto);
        echo "<br>Debe: " . $resto;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_voucher = $tot_voucher;
        $dep_voucher = $tot_voucher;
        $saldo_a_favor = 0;
        $deuda_anterior = $resto;
        $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($resto == 0) {
        echo "Pago justo";
        echo "<br>Deposito en Voucher: " . $tot_voucher;
        echo "<br>Para movil: " . $para_movil;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        $sobra = $ventas + $debe_semanas;
        $paga = $para_movil + $new_dep_ft;
        echo "<br>Pago: " . $paga;
        $resto = $paga - $sobra;
        $resto = abs($resto);
        echo "<br>Debe: " . $resto;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_voucher = $tot_voucher;
        $dep_voucher = $tot_voucher;
        $saldo_a_favor = 0;
        $deuda_anterior = $resto;
        $total = $x_semana;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
    }

    header("Location: inicio_cobros.php");

    exit;
}
//OK --------- (cod 56) voucher - deposito - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 56) voucher - deposito - semanas - saldo a favor - ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "total de voucher: " . $tot_voucher;
    echo "<br><br>";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Debe semanas: " . $debe_semanas;
    $debe = $ventas + $debe_semanas;
    echo "<br>Debe: " . $debe;
    echo "<br>Saldo a favor: " . $saldo_leido;
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Para movil: " . $para_movil;
    $cuenta = $para_movil + $new_dep_ft + $saldo_leido - $debe;
    echo "<br>A favor: " . $cuenta;
    echo "<br><br>";
    if ($cuenta > 0) {
        echo "<br>Sobra plata...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $total = $x_semana;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Cuenta: " . $cuenta;
        $dep_vou = $cuenta;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($cuenta < 0) {
        echo "<br>Falta plata...";
        $cuenta = abs($cuenta);
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $total = $x_semana;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Cuenta: " . $cuenta;
        $deuda_anterior = $cuenta;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($cuenta == 0) {
        echo "<br>Pago justo...";
        $cuenta = abs($cuenta);
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $total = $x_semana;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $dep_voucher = $tot_voucher;
        echo "<br>Cuenta: " . $cuenta;
        $deuda_anterior = $cuenta;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK---------- (cod 57) voucher - deposito - semanas - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 57) voucher - deposito - semanas - deuda anterior</b>";

    include_once "../../../includes/cant_viajes.php";
    $estado = 0;

    $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior - $debe_semanas;
    $resto_dep_mov = round($resto_dep_mov);
    //$resto_dep_mov = abs($resto_dep_mov);
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    if ($resto_dep_mov > 0) {
        echo "<br>Paga y sobra...";
        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $total = $x_semana;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $estado = 0;
        $dep_voucher = $tot_voucher;
        $dep_vou = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $resto_dep_mov = abs($resto_dep_mov);
        $total = $x_semana;
        $saldo_a_favor = 0;
        $estado = 0;
        $dep_voucher = $tot_voucher;
        $deuda_anterior = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        echo "<br>Deposito voucher: " . $tot_voucher;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $resto_dep_mov = abs($resto_dep_mov);
        $total = $x_semana;
        $saldo_a_favor = 0;
        $estado = 0;
        $dep_voucher = $tot_voucher;
        $deuda_anterior = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 58) voucher - deposito - semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(cod 58) voucher - deposito - semanas - deuda anterior - ventas</b>";
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Ventas: " . $ventas;
    $debe = $deuda_anterior + $debe_semanas + $ventas;
    $a_cuenta = $para_movil + $new_dep_ft;
    echo "<br>Debe: " . $debe;
    echo "<br>A cuenta: " . $a_cuenta;
    echo "<br>Resto dep mov: " . $resto_dep_mov = $a_cuenta - $debe;

    if ($resto_dep_mov > 0) {
        echo "<br>Pago de mas...";
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        $dep_vou = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $dep_vou, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Paga justo...";
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = abs($resto_dep_mov);
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        $dep_vou = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = abs($resto_dep_mov);
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $dep_voucher = $tot_voucher;
        $dep_vou = $resto_dep_mov;
        //exit;
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 59) voucher - deposito - semanas - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(err cod 59) voucher - deposito - semanas - deuda anterior - saldo a favor</b>";
    exit;
}
//OK --------- (err cod 60) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0 && $postergar_semana == 0) {
    echo "<b>(err cod 60) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK -------- (cod 61) No Nada
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0 && $postergar_semana == 0) {
    echo "<b>(cod 61) No Nada</b>";
    exit;
}
