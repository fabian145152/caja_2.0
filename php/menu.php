<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";


//include_once("../php/semana/semana.php");


$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . " Superusuario..." . '</h4>';

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
        <script>
            function confirmarAccion() {
                // Muestra el cuadro de confirmación
                const confirmado = confirm("OJO PONE TODOS LOS IMPORTES EN 0 NO BORRA NINGUNA UNIDAD PERO NINGUNA DEBE NADA Y SE BORRAN LAS LISTAS DE CAJA Y EXTRACIONES");

                // Verifica la respuesta del usuario
                if (confirmado) {

                    window.location.href = "inicializa_deudas.php";
                } else {
                    alert("Acción cancelada.");
                }
            }
        </script>
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

                        <h3>BACKUP</h3>

                        <li><a href="../Backup_DDBB/back.php" class=" btn btn-primary btn-block btn-sm">BACKUP desaparecio..
                                <p>Este boton se ejecuta automatico en los otros menues tarea programada en el sercidor</p>
                                <p>Verificar que se haga de lunes a viernes a las 00:15</p>
                            </a></li>
                        <br>
                        <li><a href="#" class=" btn btn-primary btn-block btn-sm">BACKUP
                                <p>Se ejecuta automaticamente en el disco donde esta Apache D:respaldos_caja</p>
                                <p>Verificar que se haga diariamente a las 08:10 AM</p>
                            </a></li>
                    </ul>

                    <ul class="list-group">
                        <h3>UNIDADES</h3>
                        <li><a href="ayuda/crear_para_cobrar.php" target="_blank" class="btn btn-info btn-block btn-sm">COMO ARMAR UNA UNIDAD</a></li>
                        <br>
                        <li><a href="admin/crear_no_de_movil/list_no_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR NUMERO DE MOVIL</a></li>
                        <br>
                        <li><a href="admin/tropas/lista_tropas.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR NUEVA TROPA</a></li>
                        <br>
                        <li><a href="admin/movil_nuevo/lista_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR EDITAR TITULAR </a></li>
                        <br>
                        <li><a href="admin/uni_comp/list_uni_comp.php" class="btn btn-primary btn-block btn-sm" target="_blank">EDICION DE UNIDAD COMPLETA</a></li>
                        <br>
                        <li><a href="admin/observaciones/inicio_obs.php" target="_blank" class="btn btn-primary btn-block btn-sm">OBSERVACIONES X MOVIL.</a></li>
                    </ul>
                </div>


                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>SEMANAS</h3>
                        <li><a href="#" class=" btn btn-primary btn-block btn-sm">SEMANA los lunes solamente...
                                <!-- <li><a href="actualiza_semana/semana.php" class=" btn btn-primary btn-block btn-sm">SEMANA los lunes solamente... -->
                                <p style="margin-top:0; margin-bottom:0;"><small>Una vez, los lunes al empezar. se ejecuta cuando entra por primera vez a cobrar a moviles</small>
                                    este boton no hace nada, verificar el lunes si cobra 1 semana a todos los moviles</p>
                            </a></li>
                        <br>

                        <h3>VOUCHER</h3>
                        <li><a href="ayuda/ayuda_voucher.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE CARGA DE VOUCHER</a></li>
                        <br>
                        <li> <a href="admin/voucher/inicio_voucher.php" target="_blank" class="btn btn-primary btn-block btn-sm">VOUCHER DE CAJA</a></li>
                        <h3>VENTAS</h3>
                        <li><a href="admin/venta/venta_prod.php" class=" btn btn-primary btn-block btn-sm" target="__blank">STOCK DE PRODUCTOS</a></li>
                        <br>
                        <li><a href="admin/ventas/inicio_ventas.php" class=" btn btn-primary btn-block btn-sm" target="__blank">VENTA</a></li>
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
                        <h3>MENU CAJA </h3>
                        <li><a href="ayuda/help.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE COBROS</a></li>
                        <br>
                        <li> <a href="admin/bonifica_deuda/inicio_deuda.php" class="btn btn-danger btn-block btn-sm" target="__blank">BONIFICA DEUDA</a></li>
                        <br>
                        <li> <a href="admin/genera_deuda/genera_deuda.php" class="btn btn-success btn-block btn-sm" target="__blank">GENERA DEUDA</a></li>
                        <br>
                        <li> <a href="admin/deposito_a_cuenta/genera_dep.php" class="btn btn-secondary btn-block btn-sm" target="__blank">DEPOSITO A CUENTA DE LOS MOVILES</a></li>
                        <br>
                        <li><a href="admin/cobros/inicio_cobros.php" target="_blank" class=" btn btn-primary btn-block btn-sm">COBRAR A MOVIL</a></li>
                        <br>
                        <li><a href="admin/historial/inicio_resumen.php" target="_blank" class=" btn btn-primary btn-block btn-sm">HISTORIAL DE PAGOS DEL MOVIL</a></li>
                        <br>
                        <li><a href="admin/cobros/estado_de_caja.php" target="_blank" class=" btn btn-primary btn-block btn-sm">RESUMEN DE CAJA</a></li>
                        <br>
                        <li><a href="admin/depositos_a_moviles/inicio_movimientos.php" target="_blank" class=" btn btn-primary btn-block btn-sm">DEPOSITOS A LOS MOVILES</a></li>
                        <br>
                        <h3>SIN TERMINAR</h3>

                        <h3>ESTADOS </h3>
                        <li><a href="admin/cobros/recibos" target="_blank" class=" btn btn-primary btn-block btn-sm">RECIBOS</a></li>
                        <br>
                        <li><a href="#" target="_blank" class=" btn btn-danger btn-block btn-sm">EDICION DE DEUDAS</a></li>
                        <br>
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
                <div class="col-md-3">
                    <ul class="list-group">


                        <h3>SIN TERMINAR</h3>
                        <li><a href="#" class=" btn btn-INFO btn-block btn-sm">INGRESOS</a></li>
                        <br>
                        <li><a href="#" class="btn btn-info btn-block">F-MAILER</a></li>
                        <br>
                        <li><a href="administrador/logeados/logeos.php" class="btn btn-info btn-block btn-sm">SESIONES en proceso</a></li>
                        <br>
                        <li><a href="admin/listados/lista_numeros.php" class=" btn btn-info btn-block btn-sm">LISTADO DE MOVILES X NUMERO</a></li>
                        <br>
                        <li><a href="admin/cobros/codigos_y_errores.php" class=" btn btn-info btn-block btn-sm" target="_blank">LISTADO DE CODIGOS Y ERRORES</a></li>
                        <br><br>
                        <h3>INICIALIZAR PROGRAMA</h3>

                        <button onclick="confirmarAccion()">INICIALIZAR DEUDAS
                            <p>Este boton pone todos los importes en 0</p>
                            <p>No borra ninguna unidad pero ninguna debe nada</p>
                            <p>Se borran las listas de caja y extracciones</p>
                            <p>No se modifica nada de los moviles, ni productos en venta</p>
                        </button>
                        </li>


                    </ul>
                </div>

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