<?php
session_start();
$usuario = $_SESSION['uname'];
$hora = $_SESSION['time'];
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


$sql_1 = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$sql_ve = $con->query($sql_1);
$ver = $sql_ve->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXTRACCION</title>
    <?php head() ?>
    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <style>
        .centrado {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
            /* ajustá este valor según lo alto que lo quieras */
            text-align: center;
        }

        .centrado input {
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
            text-align: center;
            width: 200px;
        }

        .btn-group {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1 class="text-center" style="margin: 5px ;">EXTRACCION DE CAJA</h1>

    <h4 class="text-center" style="margin: 5px ;"><?php echo $usuario ?></h4>
    <?php

    $monto_actual = $ver['saldo_ft'];
    $formateado = "$" . number_format($monto_actual, 2, ',', '.');
    ?>
    <div class="centrado">
        <!-- Monto original formateado -->
        <input type="text" id="montoOriginal" value="<?php echo $formateado ?>" readonly>

        <!-- Valor a restar, también formateado -->
        <label class='mi-label'>Ingrese el dimero a extraer y presione TAB</label>
        <input type="text" id="valorARestar" placeholder="Ingresá un valor en pesos" autofocus>

        <!-- Resultado formateado -->
        <input type="text" id="resultado" placeholder="Resultado" readonly>

        <br><br><br>
        <div class="btn-group" role="group">
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
        </div>
    </div>

    <script>
        // Función para convertir "$123.456,78" a número real: 123456.78
        function convertirAPrecioReal(valorFormateado) {
            return parseFloat(
                valorFormateado.replace(/\./g, '').replace(',', '.').replace('$', '').trim()
            ) || 0;
        }

        // Función para formatear número como pesos argentinos
        function formatearComoPesos(numero) {
            return new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
                minimumFractionDigits: 2
            }).format(numero);
        }

        // Detectar TAB en el segundo input
        document.getElementById('valorARestar').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const originalFormateado = document.getElementById('montoOriginal').value;
                const restaFormateada = this.value;

                const original = convertirAPrecioReal(originalFormateado);
                const resta = convertirAPrecioReal(restaFormateada);

                const resultado = original - resta;

                document.getElementById('resultado').value = formatearComoPesos(resultado);
            }
        });
    </script>


    <?php foot() ?>
</body>

</html>