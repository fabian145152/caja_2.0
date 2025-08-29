<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo $movil = $_POST['movil'];
echo "<br>";
echo $fecha = date("Y-m-d");
echo "<br>";
echo $nombre = $_POST['nombre_titu'];
echo "<br>";
echo $apellido = $_POST['apellido_titu'];
echo "<br>";
echo $dni = $_POST['dni_titu'];
echo "<br>";
echo $direccion = $_POST['direccion_titu'];
echo "<br>";
echo $cp_titu = $_POST['cp_titu'];
echo "<br>";
echo $celular = $_POST['cel_titu'];
echo "<br>";
echo $licencia = $_POST['licencia_titu'];
echo "<br>";
echo "<br>";
$tropa = 50;
//exit();


$sql_movil = "INSERT INTO completa (movil, 
                                    fecha_inicio,
                                    nombre_titu,
                                    apellido_titu,
                                    dni_titu,
                                    direccion_titu,
                                    cp_titu,
                                    cel_titu,
                                    licencia_titu,
                                    tropa
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?)";
$stmt_movil = $con->prepare($sql_movil);
$stmt_movil->bind_param(
    "isssisiiii",
    $movil,
    $fecha,
    $nombre,
    $apellido,
    $dni,
    $direccion,
    $cp_titu,
    $celular,
    $licencia,
    $tropa
);


$sql_semana = "INSERT INTO semanas (movil) VALUES (?)";
$stmt_semana = $con->prepare($sql_semana);
$stmt_semana->bind_param("i", $movil);


echo $movil;


//exit();
$stmt_movil->execute();
if ($stmt_semana->execute()) {
    //if ($stmt_semana->execute()) {

?>

    <script>
        alert("NUEVO MOVIL CREADO CON EXITO")
        window.location = "lista_movil.php";
    </script>
<?php

} else {
?>
    <script>
        alert("MOVIL DUPLICADO")
        window.location = "lista_movil.php";
    </script>
<?php
}

?>