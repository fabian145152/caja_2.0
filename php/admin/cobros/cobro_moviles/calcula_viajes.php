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
        let imp_viaje;
        let imp_voucher;
        let saldoAfavor;
        let cant_viajes;



        function calcularYRestar() {
            const cant_viajes = parseFloat(document.getElementById('cant_viajes').value) || 0;
            const semanasPostergadas = parseFloat(document.getElementById('postergar_semana').value) || 0;
            const campoResultado = document.getElementById('resultadoResta');
            const mensaje = document.getElementById('mensajeResultado');


            const resultadoMultiplicacion = cant_viajes * imp_viaje;
            const adicionalPorSemana = semanasPostergadas * paga_x_semana;
            const resultadoResta = imp_voucher - resultadoMultiplicacion;
            const resultadoFinal = resultadoResta + saldoAfavor + adicionalPorSemana;

            //            console.log(resultadoMultiplicacion);

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
    $imp_viaje = round($paga_x_viaje);
    $imp_voucher = round($dato_a_env);
    echo "<script>
            imp_viaje = $imp_viaje;
            imp_voucher = $imp_voucher;
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
                <input type="text" id="postergar_semana" name="postergar_semana" onblur="calcularYRestar()" value="0" style="text-align: center;">
            </div>

          

            <input type="hidden" id="resultadoMultiplicacion" readonly>

            <div class="form-group">
                <label for="resultadoResta">Resultado:</label>
                <input type="text" id="resultadoResta" name="resultadoResta" style="background-color: yellow; text-align: center;" readonly>
            </div>

            <p id="mensajeResultado" style="font-weight: bold;"></p>
        </form>

    </div>
</body>

</html>