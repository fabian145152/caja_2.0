<?php
session_start();
if ($_SESSION['logueado']) {

    echo "BIENVENIDO ,"  . $_SESSION['uname'] . '<br>';

    echo "Hora de conexión :" . $_SESSION['time'] . '<br>';

    echo $nombre = $_SESSION['uname'];
    echo "<br>";
    echo $fecha = date('Y-m-d');
    echo "<br>";
    //echo $hora = $_SESSION['time'];
    echo $hora = date('H,m,s');
    echo "<br>";

    include_once "../funciones/funciones.php";
    $con = conexion();
    $con->set_charset("utf8mb4");


    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    // Consulta SQL para seleccionar todos los registros de la tabla
    $sql = "SELECT * FROM users_logeado WHERE nombre = '$nombre' ORDER BY id DESC LIMIT 1 ";
    $result = $con->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Mostrar los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $id = $row['id'] . " - Nombre: " . $row["nombre"] . " - Fecha: " . $row["fecha"] . " - Abre: " . $row['abre'] . " - Cierra: " . $row['cierra'] . "<br>";
            // Puedes agregar más campos según sea necesario
        }
    } else {
        echo "No se encontraron resultados.";
    }

    $sql = "UPDATE users_logeado SET cierra = '$hora' WHERE id= '$id' ";

    if ($con->query($sql) === TRUE) {

        $con->close();
        session_destroy();
        header("Location: ../index.php");
    } else {
        echo "Error al actualizar el registro: " . $con->error;
    }
}
