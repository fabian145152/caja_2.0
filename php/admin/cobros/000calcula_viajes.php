<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplicación y Resta Automática</title>

    <script>
        let multiplicador;
        let otraVariable;
        let saldoAfavor;

        function calcularYRestar() {
            const numero = document.getElementById('numero').value;
            const campoResultado = document.getElementById('resultadoResta');
            const mensaje = document.getElementById('mensajeResultado');

            if (!isNaN(numero) && numero !== "") {
                const resultadoMultiplicacion = numero * multiplicador;
                const resultadoResta = otraVariable - resultadoMultiplicacion;
                const resultadoFinal = resultadoResta + saldoAfavor;

                document.getElementById('resultadoMultiplicacion').value = resultadoMultiplicacion;
                campoResultado.value = resultadoFinal.toFixed(2);

                if (resultadoFinal < 0) {
                    campoResultado.style.backgroundColor = "red";
                    mensaje.textContent = "Debe abonar";
                    mensaje.style.color = "red";
                } else {
                    campoResultado.style.backgroundColor = "lightgreen";
                    mensaje.textContent = "Habrá que depositarle";
                    mensaje.style.color = "green";
                }

            } else {
                document.getElementById('resultadoMultiplicacion').value = "";
                campoResultado.value = "";
                campoResultado.style.backgroundColor = "yellow";
                mensaje.textContent = "";
            }
        }
    </script>
</head>

<body>
    <?php
    $multiplicador = round($paga_x_viaje);
    $otraVariable = round($dato_a_env);
    echo "<script>
            multiplicador = $multiplicador;
            otraVariable = $otraVariable;
            saldoAfavor = $saldo_a_favor;
          </script>";
    ?>

    <form>
        <label for="numero">Viajes a cobrar:</label>
        <input type="text" id="numero" name="numero" onblur="calcularYRestar()" required autofocus>


        <h6><strong>Ingrese cantidad y presione la tecla TAB</strong></h6>
        <input type="hidden" id="resultadoMultiplicacion" readonly>
        <input type="text" id="resultadoResta" name="resultadoResta" style="background-color: yellow;" readonly>

        <p id="mensajeResultado" style="font-weight: bold;"></p>
    </form>
</body>

</html>