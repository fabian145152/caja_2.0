<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

// sanitize
$movil = isset($_POST['id']) ? intval($_POST['id']) : 0;

$x_semana = 150;
$x_viaje  = 150;
$tropa    = 50;
$estado   = 1;
$activo   = "SI";

// Preparar statements
$sql_movil = "INSERT INTO completa (movil, x_semana, x_viaje, tropa, estado_admin) VALUES (?,?,?,?,?)";
$stmt_movil = $con->prepare($sql_movil);
if (!$stmt_movil) die("Prepare completa error: " . $con->error);
$stmt_movil->bind_param("iiiii", $movil, $x_semana, $x_viaje, $tropa, $estado);

$sql_semana = "INSERT INTO semanas (movil, activo) VALUES (?,?)";
$stmt_semana = $con->prepare($sql_semana);
if (!$stmt_semana) die("Prepare semanas error: " . $con->error);
$stmt_semana->bind_param("is", $movil, $activo);

// Ejecutar dentro de transacción
$msg = "";
try {
    $con->begin_transaction();

    $ok_sem = $stmt_semana->execute();    // ejecutar 1 vez
    $ok_mov = $stmt_movil->execute();     // ejecutar 1 vez

    if ($ok_sem && $ok_mov) {
        $con->commit();
        $msg = "NUEVO MOVIL CREADO CON EXITO";
    } else {
        $con->rollback();

        // Priorizar mensaje de error del insert en 'completa' (stmt_movil)
        if (!$ok_mov && $stmt_movil->errno == 1062) {
            $msg = "MOVIL DUPLICADO";
        } else {
            // mostrar error concreto (puede venir de cualquiera)
            $err = !$ok_mov ? $stmt_movil->error : $stmt_semana->error;
            $msg = "ERROR: " . $err;
        }
    }
} catch (Exception $e) {
    $con->rollback();
    $msg = "Exception: " . $e->getMessage();
}

$stmt_semana->close();
$stmt_movil->close();

// Mostrar alert y redirigir (usamos json_encode para escapar bien la cadena JS)
echo "<script>
    alert(" . json_encode($msg) . ");
    window.location = 'list_no_movil.php';
</script>";
