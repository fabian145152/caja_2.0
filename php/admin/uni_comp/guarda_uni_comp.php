<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo $movil = $_POST['movil'];
echo "<br>";
echo "ID: " . $id = $_POST['id'];
echo "<br>";
//echo "Abono semana: " . $options_1 = $_POST['abono_semana'];
echo "<br>";
//echo "Abono viaje: " . $options_2 = $_POST['abono_viaje'];
echo "<br>";
echo "Fecha inicio: " . $options_3 = $_POST['fecha_inicio'];
echo "<br>";
echo "Fecha facturacion: " . $options_4 = $_POST['fecha_fact'];
echo "<br>";

/*
$sql_abono_semanal = "SELECT * FROM abono_semanal WHERE id = $options_1 ";
$sql_abono_semanal = $con->query($sql_abono_semanal);
$sql_abono_semanal = $sql_abono_semanal->fetch_assoc();

echo "Abono: " . $sql_abono_semanal['abono'];
echo "<br>";
echo "Importe: " . $abono_semana = $sql_abono_semanal['importe'];

//exit();

$sql_debe_semanas = "SELECT * FROM semanas WHERE movil = $movil";
$sql_debe_semanas = $con->query($sql_debe_semanas);
$row_debe_semanas = $sql_debe_semanas->fetch_assoc();

echo $row_debe_semanas['x_semana'];

$upd = "UPDATE semanas SET x_semana = $abono_semana WHERE movil = $movil ";

//$con->query($upd);



if ($options_1 == NULL || $options_2 == NULL || $options_3 == NULL || $options_4 == NULL) {
    
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
            window.location.href = "edit_uni_comp.php?q=" + encodeURIComponent(variableValue);
        }
    }
    
    // Llamar a la función al cargar la página
    window.onload = redirectWithConfirmation;
    </script>
    
<?php
exit();
}

*/


$movil = $_POST['movil'];
$nom_titu = $_POST['nom_titu'];
$ape_titu = $_POST['ape_titu'];
$dni_titu = $_POST['dni_titu'];
$dir_titu = $_POST['dir_titu'];
$cp_titu = $_POST['cp_titu'];
$cel_titu = $_POST['cel_titu'];
$licencia = $_POST['licencia'];
$nom_chof_1 = $_POST['nom_chof_1'];
$ape_chof_1 = $_POST['ape_chof_1'];
$dni_chof_1 = $_POST['dni_chof_1'];
$dir_chof_1 = $_POST['dir_chof_1'];
$cp_chof_1 = $_POST['cp_chof_1'];
$cel_chof_1 = $_POST['cel_chof_1'];
$nom_chof_2 = $_POST['nom_chof_2'];
$ape_chof_2 = $_POST['ape_chof_2'];
$dni_chof_2 = $_POST['dni_chof_2'];
$dir_chof_2 = $_POST['dir_chof_2'];
$cp_chof_2 = $_POST['cp_chof_2'];
$cel_chof_2 = $_POST['cel_chof_2'];
$licencia = $_POST['licencia'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$dominio = $_POST['dominio'];
$año = $_POST['año'];
//$abono_x_semana = $_POST['abono_semana'];
//$paga_x_viaje = $_POST['abono_viaje'];
$fecha_ing = $_POST['fecha_inicio'];
$fecha_fact = $_POST['fecha_fact'];



$sql = "UPDATE completa SET nombre_titu = '$nom_titu',
                            apellido_titu = '$ape_titu',
                            dni_titu = '$dni_titu',
                            direccion_titu = '$dir_titu',
                            cp_titu = '$cp_titu',
                            cel_titu = '$cel_titu',
                            licencia_titu = '$licencia',
                            nombre_chof_1 = '$nom_chof_1',
                            apellido_chof_1 = '$ape_chof_1',
                            dni_chof_1 = '$dni_chof_1',
                            direccion_chof_1 = '$dir_chof_1',
                            cp_chof_1 = '$cp_chof_1',
                            cel_chof_1 = '$cel_chof_1',
                            nombre_chof_2 = '$nom_chof_2',
                            apellido_chof_2 = '$ape_chof_2',
                            dni_chof_2 = '$dni_chof_2',
                            direccion_chof_2 = '$dir_chof_2',
                            cp_chof_2 = '$cp_chof_2',
                            cel_chof_2 = '$cel_chof_2',
                            licencia_titu = '$licencia',
                            marca = '$marca',
                            modelo = '$modelo',
                            dominio = '$dominio',
                            año = '$año',
                     /*       x_semana = '$abono_x_semana', 
                            x_viaje = '$paga_x_viaje',
                    */
                            fecha_inicio = '$fecha_ing',
                            fecha_facturacion = '$fecha_fact'
                            WHERE id =" . $id;

$con->query($sql);



header("Location: list_uni_comp.php");
