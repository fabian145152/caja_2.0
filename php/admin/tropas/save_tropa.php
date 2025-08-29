<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $tropa = $_POST['tropa'];
echo "<br>";
echo $mov = $_POST['moviles'];
echo "<br>";
echo $nombre = $_POST['nombre'];
echo "<br>";
echo $apellido = $_POST['apellido'];
echo "<br>";
echo $dni = $_POST['dni'];
echo "<br>";
echo $direccion = $_POST['direccion'];
echo "<br>";
echo $cp = $_POST['cp'];
echo "<br>";
echo $celular = $_POST['cel'];


$moviles = explode(",", $mov);
$cant = count($moviles);



for ($i = 0; $i <= $cant - 1; $i++) {
    echo "<br>";
    //echo $i;
    echo "<br>";
    echo $moviles[$i];
    echo "<br>";
    echo $tropa;
    echo "<br>";
    echo $nombre;
    echo "<br>";
    echo $apellido;
    echo "<br>";
    echo $dni;
    echo "<br>";
    echo $direccion;
    echo "<br>";
    echo $cp;
    echo "<br>";
    echo $celular;
    echo "<br>";

    //exit();

    $sql_titu = "INSERT INTO completa (movil, 
                                    tropa, 
                                    nombre_titu, 
                                    apellido_titu, 
                                    dni_titu, 
                                    direccion_titu, 
                                    cp_titu, 
                                    cel_titu) 
                                    VALUES (?,?,?,?,?,?,?,?)";
    $stmt_titu = $con->prepare($sql_titu);
    $stmt_titu->bind_param("iissisii", $moviles[$i], $tropa, $nombre, $apellido, $dni, $direccion, $cp, $celular);
    $stmt_titu->execute();



    $sql_semana = "INSERT INTO semanas (movil) VALUES (?)";
    $stmt_semana = $con->prepare($sql_semana);
    $stmt_semana->bind_param("i", $moviles[$i]);
    $stmt_semana->execute();
}

?>
<script>
    alert("NUEVA TROPA CREADA CON EXITO");
    window.location = "../../menu.php";
</script>

<?php
