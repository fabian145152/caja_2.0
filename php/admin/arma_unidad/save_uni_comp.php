<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utl8mb4");


echo "ID: " . $id = $_POST['id'];
echo "<br>";
echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";
echo "Nombre: " . $nombre = $_POST['nombre'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "Abono semana: " . $abono_semana = $_POST['abono_semana'];   //UPDatarlo en completa
echo "<br>";
echo "Abono viaje: " . $abono_viaje = $_POST['abono_viaje'];      //UPDatarlo en completa
echo "<br>";
echo "Paga semanas: " . $paga_semanas = $_POST['paga_semanas'];
echo "<br>";
echo $fecha_fact = $_POST['inicio_fact'];

//exit();

$sql_sem = "SELECT * FROM abono_semanal WHERE id =" . $id;
$sql_result = $con->query($sql_sem);
$row_sem = $sql_result->fetch_assoc();
echo "<br>";

$sql_paga_x_semana = "SELECT * FROM semanas WHERE movil=" . $movil;
$sql_seman = $con->query($sql_paga_x_semana);
$abono_semanal = $sql_seman->fetch_assoc();
echo "<br>";
echo "Debe en total: " . $abono_semanal['total'];
echo "<br>";
echo "Paga x semana: " . $x_semana = $abono_semanal['x_semana'];
echo "<br>";

//exit();

if ($movil == NULL || $abono_semana == NULL || $abono_viaje == NULL || $fecha_fact == NULL) {

?>
    <script>
        function redirectWithConfirmation() {
            // Variable to send
            var variableValue = '$id'; // Reemplaza con el valor de tu variable

            // Mostrar cuadro de confirmación
            var userConfirmed = window.confirm("FALTA SEMANAS o VIAJES o FECHAS",

            );


            // Si el usuario confirma, redirigir con la variable
            if (userConfirmed) {
                window.location.href = "edit_uni_comp.php?movil=" + encodeURIComponent(variableValue);
            }
        }

        // Llamar a la función al cargar la página
        window.onload = redirectWithConfirmation;
    </script>
<?php
    exit();
}


//exit();
$sql = "UPDATE completa SET fecha_facturacion = ?, x_semana = ?, x_viaje = ? WHERE id =" . $id;

$stmt_comp = $con->prepare($sql);

$stmt_comp->bind_param('sii', $fecha_fact, $abono_semana, $abono_viaje);
$stmt_comp->execute();


echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$sql_imp_semana = "SELECT * FROM abono_semanal WHERE id= " . $abono_semana;
$imp_semana = $con->query($sql_imp_semana);

if ($imp_semana->num_rows > 0) {
    $row_cuanto = $imp_semana->fetch_assoc();
    echo "ABONO nombre: " . $abono_semanal_nombre = $row_cuanto['abono']; // Asumiendo que 'x_semana' es la columna que deseas imprimir
    echo "<br>";
    echo "ABONO importe: " . $abono_semanal_importe = $row_cuanto['importe']; // Asumiendo que 'x_semana' es la columna que deseas imprimir
    echo "<br>";
} else {
    echo "No se encontraron registros.";
}

echo "NUEVO ABONO = " . $abono_semanal_nombre;
## antes de esto leer abono semanal para tener el importe nuevo
echo "<br>Paga semnas: " . $paga_semanas;

$actua_semana = "UPDATE semanas SET x_semana = ?, activo = ?  WHERE movil= ?";
$stmt_sem = $con->prepare($actua_semana);
$stmt_sem->bind_param('isi', $abono_semanal_importe, $paga_semanas, $movil);
$stmt_sem->execute();



if ($stmt_sem->execute() === false) {
    die("Error al ejecutar la consulta: " . $stmt_sem->error);
    exit;
} else {
    echo "<br>";
    echo "Registro actualizado correctamente.";
    echo "<br>";
}

header("Location: inicio_arma.php");
