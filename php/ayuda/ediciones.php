<?php
session_start();
include_once "../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR IMPORTES</title>
    <?php head() ?>
</head>

<body>
    <button onclick="cerrarPagina()">CERRAR PAGINA</button>
    <h1>PROCESO DE ARMADO DE UNA UNIDAD PARA COMENZAR A COBRARLE</h1>
    <?php foot() ?>
</body>