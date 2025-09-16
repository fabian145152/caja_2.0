<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . " Administrador..." . '</h4>';

    $_SESSION['time'] . '<br>';

    $nombre = $_SESSION['uname'];

    $fecha = date('Y-m-d');
    $abre = $_SESSION['time'];

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $usuario_logeado = "INSERT INTO `users_logeado`(nombre, fecha, abre) VALUES ('$nombre', '$fecha', '$abre')";

    if ($con->query($usuario_logeado) === TRUE) {
        //echo "Usuario Guardado exitosamente.";
    } else {
        echo "Error: " . $usuario_logeado . "<br>" . $con->error;
    }
    $semana_actual = date('W');

?>
    <!DOCTYPE html>
    <html lang="es">

    <hea>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MENU PINCIPAL</title>
        <?php head(); ?>
    </hea>

    <body>
        <h4>SEMANA: <?php echo $semana_actual ?></h4>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>USUARIOS</h3>
                        <li><a href="usuario/inicio_usuario.php" class="btn btn-primary btn-block btn-sm">CREAR USUARIOS</a></li>
                        <br>
                        <li><a href="ayuda/help.php" target="_blank" class="btn btn-primary btn-block btn-sm">AYUDA</a></li>
                        <!--                        <h3>BACKUP</h3>
                        <li><a href="../Backup_DDBB/back.php" class=" btn btn-primary btn-block btn-sm">BACKUP</a></li>
                    </ul>
-->
                        <ul class="list-group">
                            <h3>UNIDADES</h3>

                            <li><a href="ayuda/crear_para_cobrar.php" target="_blank" class="btn btn-info btn-block btn-sm">COMO ARMAR UNA UNIDAD</a></li>
                            <br>
                            <li><a href="admin/crear_no_de_movil/list_no_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR NUMERO DE MOVIL</a></li>
                            <br>
                            <li><a href="admin/tropas/lista_tropas.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR / EDITAR TROPA</a></li>
                            <br>
                            <li><a href="admin/movil_nuevo/lista_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR EDITAR TITULAR / TROPA</a></li>
                            <br>
                            <li><a href="admin/uni_comp/list_uni_comp.php" class="btn btn-primary btn-block btn-sm" target="_blank">EDICION DE UNIDAD COMPLETA</a></li>
                            <br>
                            <li><a href="admin/observaciones/inicio_obs.php" target="_blank" class="btn btn-primary btn-block btn-sm">OBSERVACIONES X MOVIL.</a></li>

                        </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-group">

                        <h3>VOUCHER</h3>
                        <li><a href="ayuda/ayuda_voucher.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE CARGA DE VOUCHER</a></li>
                        <br>
                        <li><a href="http://taxicorp.rtportenio.com/Web/Account/Login" target="_blank" class="btn btn-secondary btn-block btn-sm">APP SATELITAL</a></li>
                        <br>
                        <li> <a href="admin/voucher/inicio_voucher.php" target="_blank" class="btn btn-primary btn-block btn-sm">VOUCHER DE CAJA</a></li>
                        <h3>VENTAS</h3>
                        <li><a href="admin/venta/venta_prod.php" class=" btn btn-primary btn-block btn-sm" target="__blank">STOCK DE PRODUCTOS</a></li>
                        <br>
                        <li><a href="admin/ventas/inicio_ventas.php" class=" btn btn-primary btn-block btn-sm" target="__blank">VENTA</a></li>

                    </ul>
                </div>


                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>TARIFAS</h3>
                        <li> <a href="admin/arma_unidad/inicio_arma.php" class="btn btn-primary btn-block btn-sm" target="__blank">CONFIGURA UNIDAD PARA COBRAR</a></li>
                        <br>
                        <li> <a href="admin/abonos_viajes/inicio_abonos.php" class="btn btn-primary btn-block btn-sm" target="__blank">IMPORTE DE LOS VIAJES</a></li>
                        <br>
                        <li> <a href="admin/abonos_semanales/inicio_abonos_semanales.php" class="btn btn-primary btn-block btn-sm" target="__blank">ABONOS SEMANALES</a></li>



                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>MENU CAJA</h3>
                        <!--
                        <li><a href="ayuda/help.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE COBROS</a></li>
                        <br>-->
                        <li><a href="admin/cobros/cobro_moviles/inicio_cobros.php" target="_blank" class=" btn btn-primary btn-block btn-sm">COBRAR MOVILES / TROPAS</a></li>
                        <br>
                        <li> <a href="admin/bonifica_deuda/inicio_deuda.php" class="btn btn-danger btn-block btn-sm" target="__blank">BONIFICA DEUDA</a></li>
                        <br>
                        <li> <a href="admin/genera_deuda/genera_deuda.php" class="btn btn-success btn-block btn-sm" target="__blank">GENERA DEUDA</a></li>
                        <br>
                        <li> <a href="admin/deposito_a_cuenta/genera_dep.php" class="btn btn-secondary btn-block btn-sm" target="__blank">DEPOSITO A CUENTA DE LOS MOVILES</a></li>
                        <br>
                        <!--      <li><a href="admin/depositos_a_moviles/inicio_movimientos.php" target="_blank" class=" btn btn-primary btn-block btn-sm">DEPOSITOS A LOS MOVILES</a></li>
                        <br>
-->
                        <li><a href="admin/cobros/cobro_moviles/estado_de_caja.php" target="_blank" class=" btn btn-primary btn-block btn-sm">RESUMEN DE CAJA</a></li>
                        <br>
                        <li><a href="admin/salida_caja/inicio_salida.php" target="_blank" class=" btn btn-primary btn-block btn-sm">EXTRACIONES</a></li>
                        <br>
                        <li><a href="admin/cobros/codigos_y_errores.php" class=" btn btn-info btn-block btn-sm" target="_blank">LISTADO DE CODIGOS Y ERRORES</a></li>


                        <!--
                         <li><a href="admin/historial/inicio_resumen.php" target="_blank" class=" btn btn-primary btn-block btn-sm">HISTORIAL DE PAGOS DEL MOVIL</a></li>
                        <br> 
                        <li><a href="admin/cobros/recibos" target="_blank" class=" btn btn-primary btn-block btn-sm">RECIBOS</a></li>
                        <br> 
                        <li><a href="admin/moviminetos_de_caja/inicio_movimientos.php" target="_blank" class=" btn btn-primary btn-block btn-sm">EXTRACCIONES</a></li>
                        <br>
                        -->


                    </ul>
                </div>


                <!--
                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>SIN TERMINAR</h3>
                        <h3>ESTADOS </h3>
                        <li><a href="" target="_blank" class=" btn btn-danger btn-block btn-sm">ABOGADO</a></li>
                        <br>
                        <li><a href="admin/uni_comp/estado/al_dia.php" target="_blank" class=" btn btn-success btn-block btn-sm">AL DIA</a></li>
                        <br>
                        <li><a href="" target="_blank" class=" btn btn-secondary btn-block btn-sm">CARTA</a></li>
                        <br>
                        <li><a href="" target="_blank" class=" btn btn-primary btn-block btn-sm">DEUDA PENDIENTE</a></li>
                        <br>
                        <li><a href="" target="_blank" class=" btn btn-ligth btn-block btn-sm">QRT</a></li>
                        <br>
                        <li><a href="admin/uni_comp/estado/abogado.php" target="_blank" class=" btn btn-dark btn-block btn-sm">PARA ABOGADO</a></li>
                        <br>
                        <li><a href="" target="_blank" class=" btn btn-warning btn-block btn-sm">VER</a></li>
                        <br>
                    </ul>
                </div>
-->
            </div>
        </div>
        <br>
        <div id="Power-Contenedor">
            <a href="salir.php" class="btn btn-danger btn-lg ">Salir</a>
        </div>
        <br><br><br>
    <?php
    foot();
} else {
    header("location:../index.php");
}
    ?>
    </body>

    </html>