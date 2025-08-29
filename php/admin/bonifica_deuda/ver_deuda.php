<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if (isset($_POST['movil'])) {
    $movil = $_POST['movil'];
} elseif (isset($_GET['movil'])) {
    $movil = $_GET['movil'];
} else {
    $movil = null;
}
$sql_obs = "SELECT * FROM completa WHERE movil=" . $movil;

$result_obs = $con->query($sql_obs);
$row_obs = $result_obs->fetch_assoc();
$observaciones_deuda = $row_obs['observaciones_deuda'];
$deuda_anterior = $row_obs['deuda_anterior'];
$nombre_titu = $row_obs['nombre_titu'];
$apellido_titu = $row_obs['apellido_titu'];

if ($con->connect_error) {
    die("Error de conexión a la base de datos: " . $con->connect_error);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Deuda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 80%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button,
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0078D7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #005fa3;
        }
    </style>
    <?php head() ?>
</head>

<body>

    <div class="container">
        <h2>ESTÁS EDITANDO LA DEUDA ANTERIOR DE LA UNIDAD <?php echo $movil ?></h2>
        <button onclick="cerrarPagina()" class="btn btn-danger btn-sm">CANCELAR</button>


        <form action="guarda_deuda.php" method="POST">
            <label for="movil">Unidad:</label>
            <input type="text" id="movil" name="movil" value="<?php echo $movil ?>" readonly>

            <label for="titular">Titular:</label>
            <input type="text" id="titular" name="titular" value="<?php echo $nombre_titu . ' ' . $apellido_titu ?>" readonly>

            <label for="comentarios">Comentario:</label>
            <!-- <textarea id="comentarios" name="observaciones_deuda" id="observaciones_deuda" cols="30" rows="5" value="<?php echo $observaciones_deuda ?>"></textarea> -->
            <textarea name="observaciones_deuda"><?php echo htmlspecialchars($observaciones_deuda); ?></textarea>


            <label for="deuda_anterior">Deuda Anterior:</label>
            <input type="number" id="deuda_anterior" name="deuda_anterior" value="<?php echo $deuda_anterior ?>" readonly>

            <label for="bonificacion">Bonificación:</label>
            <input type="number" id="bonificacion" name="bonificacion" placeholder="Ingrese bonificación" required autofocus>

            <br>
            <button class="btn btn-danger btn-sm">ENVIAR</button>
        </form>
        <br>

    </div>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <?php foot() ?>
</body>

</html>