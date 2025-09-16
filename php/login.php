<?php

include_once("../funciones/funciones.php");

$con = conexion();
$con->set_charset("utf8mb4");

$usr = $_POST['username'];
$pass = md5($_POST['password']);




$con->set_charset("utf-8");
$sql = "SELECT * FROM users WHERE (username='$usr' or email='$usr') and (password='$pass')";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$permiso = $row['permiso'];


if ($permiso === 'super') {

    echo "Superusuario...";
    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu.php");
    }
} else if ($permiso === 'cobro') {
    echo "Solo cobra a las unidades...";

    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu_cobra.php");
    }
} else if ($permiso === 'edita') {
    echo "Solo edita unidades";


    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu_edita.php");
    }
} else if ($permiso === 'actualiza') {

    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu_actualiza.php");
    }
} else if ($permiso === 'total') {

    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu_total.php");
    }
} else if ($permiso === 'admin') {

    if ($row == 0) {
        echo "<h1> Ingreso invalido </h1>";
        echo "<br>";
        echo "<a href='../index.php'>VOLVER</a>";
    } else {
        session_start();
        $_SESSION['uname'] = $usr;
        $_SESSION['logueado'] = true;
        $_SESSION['time'] = date('H i s');
        header("location:menu_admin.php");
    }
}

echo "<h1> Ingreso invalido </h1>";
echo "<br>";
echo "<a href='../index.php'>VOLVER</a>";
exit;
