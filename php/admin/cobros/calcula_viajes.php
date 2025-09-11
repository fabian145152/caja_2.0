<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplicación y Resta Automática</title>
    <style>
        .form-group {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 180px;
            font-weight: bold;
        }

        .form-group input {
            flex: 1;
            padding: 5px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }

        #resultadoResta {
            font-weight: bold;
        }
    </style>
    <script>
        let multiplicador;
        let otraVariable;
        let saldoAfavor;

        function calcularYRestar() {
            const cant_viajes = parseFloat(document.getElementById('cant_viajes').value) || 0;
            const semanasPostergadas = parseFloat(document.getElementById('postergar_semana').value) || 0;
            const campoResultado = document.getElementById('resultadoResta');
            const mensaje = document.getElementById('mensajeResultado');

            const resultadoMultiplicacion = cant_viajes * multiplicador;
            const adicionalPorSemana = semanasPostergadas * paga_x_semana;
            const resultadoResta = otraVariable - resultadoMultiplicacion;
            const resultadoFinal = resultadoResta + saldoAfavor + adicionalPorSemana;

            document.getElementById('resultadoMultiplicacion').value = resultadoMultiplicacion.toFixed(2);
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
        }
    </script>
</head>

<body>
    <?php
    $paga_x_semana = round($paga_x_semana); // Asegurate de que esté definido
    $multiplicador = round($paga_x_viaje);
    $otraVariable = round($dato_a_env);
    echo "<script>
            multiplicador = $multiplicador;
            otraVariable = $otraVariable;
            saldoAfavor = $saldo_a_favor;
            paga_x_semana = $paga_x_semana;
          </script>";
    ?>


    <div class="form-container">
        <form>
            <div class="form-group">
                <label for="cant_viajes">Viajes a cobrar:</label>
                <input type="text" id="cant_viajes" name="cant_viajes" onblur="calcularYRestar()" required autofocus style="text-align: center;">
            </div>

            <div class="form-group">
                <label for="postergar_semana">Semanas postergadas:</label>
                <input type="text" id="postergar_semana" name="postergar_semana" onblur="calcularYRestar()" value="0">
            </div>

            <h6>Ingrese cantidad y presione la tecla <strong>TAB</strong></h6>

            <input type="hidden" id="resultadoMultiplicacion" readonly>

            <div class="form-group">
                <label for="resultadoResta">Resultado final:</label>
                <input type="text" id="resultadoResta" name="resultadoResta" style="background-color: yellow;" readonly>
            </div>

            <p id="mensajeResultado" style="font-weight: bold;"></p>
        </form>
    </div>
</body>

</html>