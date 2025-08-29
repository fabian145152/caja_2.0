<?php
include_once "funciones/funciones.php";
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <?php head(); ?>

    <style>
        * {
            background-color: burlywood;
        }

        a {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="wrapper" style="background-color: burlywood;">
        <form action="php/login.php" method="POST" accept-charset="UTF-8" class="form-signin" style="background-color: burlywood;">
            <h2 class="text-center form-signin-heading">INGRESO A CAJA</h2>
            <input type="text" class="form-control" name="username" placeholder="Usuario ó E-mail" required>
            <br>
            <input type="password" class="form-control" name="password" placeholder="contraseña" required>
            <br>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
            <!-- No borrar la linea siguiente es para salir a menu principal desde el serv de porte -->
            <br>
            <a href="http://google.com" class="btn btn-lg btn-info btn-block">SALIR</a>
        </form>
<!--
        <ul>
            <li>Roberto<strong>Administrador</strong></li>
            <li>Ricardo <strong> Acceso total</strong></li>
            <li>Carlos <strong> Edita Unidades</strong></li>
            <li>Jorge <strong> Solo Cobra</strong></li>
            <li>Marcelo <strong> Actualiza Cobros</strong></li>
        </ul>
    -->
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>