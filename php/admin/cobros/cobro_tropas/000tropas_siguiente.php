<?php
//session_start();
include_once "../../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$deuda_ant = 0;
// Obtener la variable desde la sesión

$movul = $_SESSION['variable'];

echo $movil = substr($movul, 1);








?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COBRAR TROPAS</title>
    <?php head() ?>
    <link rel="stylesheet" href="../../../css/vista_con_voucher.css">

    <link rel="stylesheet" href="vista_cobro.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function deleteProduct(cod_voucher) {
            //window.location = "borra_voucher.php?q=" + cod_voucher;
            const nuevaVentana = window.open("borra_voucher.php?q=" + cod_voucher, "_blank");
        }

        // Selecciona el enlace por su ID
        var enlace = document.getElementById('miEnlace');

        // Añade un evento de clic al enlace
        enlace.addEventListener('click', function(event) {
            // Evita el comportamiento predeterminado del enlace (navegación)
            event.preventDefault();

            // Muestra un mensaje de alerta
            alert('¡Va a borrar todos los vouher!.....');
        });

        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <div class="zoom-vertical">
        <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
            <div id="contaaaenedor">
                <h4>Estado de cuenta del <strong>MOVIL: </strong> <?php echo $movil . "." ?></h4>
                <h5>Fecha: <?php echo date("l d/m/Y"); ?> Se le esta cobrando la semana <?php echo $semana = date('W') - 1 ?>
                </h5>


                <div class="containeraa">
                    <div class="column left-column">
                        <?php
                        if ($apellido_titu === $apellido_chof_1) {
                            echo "<strong>TITULAR: </strong>" . $nombre_titu . " " . $apellido_titu;
                        } else {
                        ?>
                            <h6> <?php echo "<strong>TITULAR: </strong>" . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br>
                                <?php echo "<strong>CHOFER: </strong>" . $nombre_chof . " " . $apellido_chof_1 ?></h6>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="column left-column">
                        <?php
                        $observ = $row_comp['obs'];

                        echo '';
                        echo "<strong>COMENTARIOS: </strong>" . $observ;

                        ?>
                        <a href="../../observaciones/ver_obs.php?movil=<?php echo $movil ?>" class="btn btn-success" target="_blank">EDITAR</a>
                    </div>
                </div>
                <?php
                if ($can_viajes > 0) {
                ?>
                    <!-- <table class="table table-bordered table-sm table-hover flex" style="zoom:80%"> -->
                    <table class="table table-bordered table-sm table-hover" style="width:50%; margin: 0 auto; zoom:80%; ">

                        <thead>
                            <tr>
                                <!--<th class="col-sm-2">ID</th>-->
                                <th class="col-sm-2">CC</th>
                                <th class="col-sm-2">Fecha</th>
                                <th class="col-sm-2">Numero</th>
                                <th class="col-sm-2">Importe</th>

                            </tr>
                        </thead>
                        <?php
                    }
                    $viajes_de_esta_semana = 0;
                    while ($row_voucher = $sql_voucher->fetch_assoc()) {
                        $id = $row_voucher['id'];
                        if ($row_voucher['cc'] >= 0) {
                        ?>

            </div>
        </ul>

        <tbody>
            <tr>
                <!-- <th class="col-sm-2"><?php echo $id ?></th> -->
                <th class="col-sm-2"><?php echo $cc = $row_voucher['cc'] ?></th>
                <?php
                            $fecha_original = $row_voucher['fecha'];
                            // Crear un objeto DateTime desde la fecha original
                            $date = DateTime::createFromFormat('j/n/Y', $fecha_original);
                            // Formatear la fecha en "dd-mm-yyyy"
                            $fecha_voucher = $date->format('d-m-Y');
                            // Convertir la fecha a timestamp
                            $timestamp = strtotime($fecha_voucher);
                            // Obtener el número de semana
                            $numeroSemana = date("W", $timestamp);
                            //echo "El número de semana es: " . $numeroSemana;
                ?>
                <th class="col-sm-2"><?php echo $fecha_voucher ?></th>
                <?php
                            $se_ac = date('W');   //numero de semana actual

                            if ($numeroSemana != $se_ac) {
                                $numeroSemana;
                            } else {
                ?>
                    <!--   <th class="col-sm-2">Viaje de la semana que viene</th>  -->
                <?php
                                $viajes_de_esta_semana++;
                            }
                ?>
                <th class="col-sm-2"><?php echo $viaje_no = $row_voucher['viaje_no'] ?></th>
                <?php $reloj = $row_voucher['reloj'] ?>
                <?php $peaje = $row_voucher['peaje'] ?>
                <?php $plus = $row_voucher['plus'] ?>
                <?php $adicional = $row_voucher['adicional'] ?>
                <?php $equipaje = $row_voucher['equipaje'];

                            $tot_voucher = $reloj + $peaje + $plus + $adicional + $equipaje;
                            $total += $tot_voucher;

                ?>
                <th class="col-sm-12"><?php echo $tot_voucher ?></th>
                <th><a class="btn btn-danger btn-sm" style="width: 150px;" href="#" onclick="deleteProduct(<?php echo $row_voucher['id'] ?>)">BORRAR</a></th>

            </tr>
    <?php
                        }
                    }
    ?>
    </div>
</body>

</html>