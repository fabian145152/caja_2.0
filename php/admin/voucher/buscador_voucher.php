<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHER</title>
    <?php head(); ?>
    <script>
        function validateProduct(cod_voucher) {
            bootbox.confirm("Desea Guardar?" + cod_voucher, function(result) {
                if (result) {
                    window.location = "valida_voucher.php?q=" + cod_voucher;
                }
            });
        }

        function detalleProduct(cod_voucher) {
            window.location = "edit_voucher.php?id=" + cod_voucher;

        }

        function validarProduct(cod_voucher) {
            window.location = "validador_voucher.php?id=" + cod_voucher;
        }

        function deleteProduct(cod_voucher) {
            window.location = "delete_voucher.php?q=" + cod_voucher;

        }

        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <style>
        .titule {
            text-align: center;
        }
    </style>
    <?php


    if (isset($_GET['movil'])) {
        # Esta linea Viene de validar y trae el valor de movil
        $movil = $_GET['movil'];
    } else {
        #esta linea viene de listar y tre ael valor del movil
        $movil = $_POST['movil'];
        //$movil = "A" . $mo;
    }





    $sql = "SELECT * FROM voucher_nuevos WHERE movil = '$movil' ";
    $regis = $con->query($sql);
    $registros = $regis->num_rows;

    if ($registros == 0) {

    ?>
        <h2>"Presione VAUCHIN..."</h2>
        <a href="../vauchin/exportar_tabla.php?q=<?php echo $movil ?>" class="btn btn-danger btn-sm">VAUCHIN</a>
    <?php
    }

    ?>

    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

    <a href="inicio_voucher.php" class="btn btn-success btn-sm">Volver</a>

    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

    <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>


    <h2 class="titule"> <?php echo $registros ?> &nbsp; &nbsp; VOUCHER DE LA UNIDAD <?php echo $movil; ?> </h2>


    <?php




    ?>

    <table class="table table table-bordered table-sm table-hover" action="save_voucher.php?=<?php echo $d['id'] ?>" method="post">

        <thead class="thead-dark">

            <th>id</th>
            <th>V No.</th>
            <th>Competado</th>
            <th>Nom Pasajero</th>
            <th>Movil</th>
            <th>CC</th>
            <th>Reloj</th>
            <th>Peaje</th>
            <th>Equipaje</th>
            <th>Adicional</th>
            <th>Plus</th>
            <th>Total</th>
            <th>Detalles</th>
            <th>Validar</th>
            <th>Borrar</th>


        </thead>

        <?php



        while ($d = $regis->fetch_assoc()) {
            if ($d['cc'] > 1) {
        ?>
                <tr>
                    <td><?php echo $d['id']; ?></td>
                    <td><?php echo $d['viaje_no']; ?></td>
                    <td><?php echo $fecha = $d['completado']; ?></td>
                    <td><?php echo $d['nom_pasaj']; ?></td>
                    <td><?php echo $d['movil']; ?></td>
                    <td><?php echo $d['cc']; ?></td>
                    <td><?php echo $d['reloj']; ?></td>
                    <td><?php echo $d['peaje']; ?></td>
                    <td><?php echo $d['equipaje']; ?></td>
                    <td><?php echo $d['adicional']; ?></td>
                    <td><?php echo $d['plus']; ?></td>
                    <td><?php echo $d['total'] ?></td>
                    <td><a class="btn btn-primary btn-sm" href="#" onclick="detalleProduct(<?php echo $d['id']; ?>)">Detalles</td>
                    <td><a class="btn btn-warning btn-sm" href="#" onclick="validarProduct(<?php echo $d['id']; ?>)">Validar</td>
                    <td><a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $d['id'] ?>)">Borrar</a></td>

                <?php
            }

            for ($i = $registros; $i >= 0; $i--) {
                $i;
                $id = $d['id'];
                $movil = $d['movil'];
                $fecha = $d['completado'];
                $viaje_no = $d['viaje_no'];
                $cc = $d['cc'];
                $reloj = $d['reloj'];
                $peaje = $d['peaje'];
                $equipaje = $d['equipaje'];
                $adicional = $d['adicional'];
                $plus = $d['plus'];


                $guarda = "INSERT INTO voucher_temporales 
                                        VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($guarda);
                $stmt->bind_param("issddddddd", $id, $movil, $fecha, $viaje_no, $cc, $reloj, $peaje, $equipaje, $adicional, $plus);
                $stmt->execute();
            }
                ?>
                </tr>
            <?php
        }
            ?>
    </table>




</body>

</html>