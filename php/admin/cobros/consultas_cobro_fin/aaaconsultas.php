<?php
//Consulta para saber cuanto debe de semanas el movil
function debeSemanas($con, $movil)
{
    $sql_sem = $con->query("SELECT * FROM semanas WHERE movil = '$movil'");
    $row = $sql_sem->fetch_assoc();

    if ($row) {
        $imp_sem = $row['total'];
        $imp_x_sem = $row['x_semana'];
        return [
            'total' => $imp_sem,
            'x_semana' => $imp_x_sem
        ];
    } else {
        return null; // Manejo de casos sin resultados
    }
}


//Consulta para actualizar semanas pagadas por movil
function actualizaSemPagadas($con, $movil, $total)
{
    // Definimos la consulta preparada
    $sql_sem = "UPDATE semanas SET total = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_sem);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("ii", $total, $movil);

    if ($stmt->execute()) {
        echo "Semanas actualizadas correctamente.";
        return true;
    } else {
        echo "Error al actualizar semanas: " . $stmt->error;
        return false;
    }
}


//Consulta para actualizar ventas de la tabla completa
function actualizaVenta1($con, $movil, $venta_1)
{
    // Definimos la consulta preparada
    $sql_venta = "UPDATE completa SET venta_1 = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_venta);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("di", $venta_1, $movil);

    if ($stmt->execute()) {
        echo "Ventas actualizadas correctamente.";
        return true;
    } else {
        echo "Error al actualizar ventas: " . $stmt->error;
        return false;
    }
}
//Actualiza deuda anterior y sado a favor cuando paga en FT
//Entrar con los nuevos valores de deuda anterior y saldo a favor y movil
function actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor)
{
    echo "<br>";
    echo "Deuda anterior: " . $deuda_anterior;
    echo "<br>";
    echo "Saldo a favor: " . $saldo_a_favor;
    //exit;
    // Definimos la consulta preparada
    $sql_deuda = "UPDATE completa SET deuda_anterior = ?, saldo_a_favor_ft = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_deuda);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("iii", $deuda_anterior, $saldo_a_favor, $movil);

    if ($stmt->execute()) {
        echo "<br>";
        echo "Deuda anterior y saldo a favor actualizada correctamente.";
        echo "<br>";
        return true;
    } else {
        echo "Error al actualizar deuda anterior: " . $stmt->error;
        return false;
    }
}



function ultimosDep($con)
{
    // Consulta para obtener el último registro
    $query = "SELECT * FROM caja_final WHERE movil > 0 ORDER BY id DESC LIMIT 1";
    $result = $con->query($query);

    // Verificamos si se obtuvo algún registro
    if ($result && $result->num_rows > 0) {
        // Obtenemos los datos del registro
        $row = $result->fetch_assoc();
        $dep_ft = $row['dep_ft'];
        $dep_mp = $row['dep_mp'];

        // También puedes retornar los valores como array si lo prefieres
        return $row;
    } else {
        echo "No se encontraron registros.";
        return null;
    }
}

/*
    Guarda los depositos del movil en caja
*/
function guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario)
{
    // leo el ultimo registro guardado en caja_final
    $sql_lee_caja = "SELECT * FROM caja_final WHERE movil = '$movil' ORDER BY id DESC LIMIT 1";
    $result = $con->query($sql_lee_caja);
    $row = $result->fetch_assoc();
    $dep_ft = $row['dep_ft'];

    $saldo_ft = $dep_ft + $new_dep_ft;

    // Definimos la consulta preparada
    $sql_gua_ca_fi = "INSERT INTO caja_final (movil, fecha, dep_ft, saldo_ft, usuario) 
                      VALUES (?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $guarda_caja = $con->prepare($sql_gua_ca_fi);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $guarda_caja->bind_param("isiis", $movil, $fecha, $new_dep_ft, $saldo_ft, $usuario);


    // Ejecutamos la consulta
    if ($guarda_caja->execute()) {
        echo "<br>";
        echo "Datos guardados en caja_final correctamente.";
        echo "<br>";
        return true;
    } else {
        echo "Error al insertar datos en caja_final: " . $guarda_caja->error;
        return false;
    }
}




/*
    Genera movimiento de caja. cada vez que deposita un movil crea este registro actualizando el saldo
    Actualiza la semana pagada
*/

function guardaCaja($con, $fecha, $saldo_ft, $saldo_mp)
{
    // Definimos la consulta preparada
    $sql_gua_ca_fi = "INSERT INTO caja_final (fecha,                                               
                                              saldo_ft, 
                                              saldo_mp) 
                      VALUES (?, ?, ?)";

    // Preparamos la consulta
    $guarda_caja = $con->prepare($sql_gua_ca_fi);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }
    // Asignamos los valores a los marcadores de posición
    $guarda_caja->bind_param(
        "sdd",
        $fecha,
        $saldo_ft,
        $saldo_mp
    );

    // Ejecutamos la consulta
    if ($guarda_caja->execute()) {
        echo "Datos guardados en caja_final correctamente.";
        return true;
    } else {
        echo "Error al insertar datos en caja_final: " . $guarda_caja->error;
        return false;
    }
}


function deudaAnterior($con, $movil)
{
    $stmt = $con->prepare("SELECT * FROM completa WHERE movil = ?");
    $stmt->bind_param("s", $movil); // "s" indica tipo string para $movil
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $deuda_anterior = $row['deuda_anterior'];
    $saldo_a_favor = $row['saldo_a_favor_ft'];
}
