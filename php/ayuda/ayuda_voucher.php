<?php
session_start();
include_once "../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYUDA CREAR UNIDAD</title>
    <?php head() ?>
</head>

<body>
    <button onclick="cerrarPagina()">CERRAR PAGINA</button>
    <h1>PROCESO DE CARGA DE VOUCHER</h1>
    <ul>
        <li>
            <h2>Primer paso.</h2>
            <p>Realizar un reporte de la APP</p>
            <a href="http://taxicorp.rtportenio.com/Web/Reportes">REPORTES</a>

            <p>Siempre realizarlo de el dia anterior.</p>
            <p><strong>Nunca realizarlo del dia en curso </strong> porque al dia siguiente cuando hagan el
                reporte del dia anterior se cargaran los voucher del dia completo y los primeros voucher estaran duplicados </p>
            <h2>Segundo paso.</h2>
            <p>Presionar el boton Seleccionar el archivo.</p>
            <h2>Tercer paso.</h2>
            <p>Luego <strong>IMPORTAR</strong> ojo!!! presionar el boton y esperar, si no los voucher se cargan varias veces.</p>

            <p>En el caso de que se cargen 2 veces eliminar todo y cargarlos de nuevo.</p>
            <p>Poner en el cuadro de junto el numero de movil deseado y presionar buscar.</p>
        </li>
        <li>
            <p>Si aparecen numeros en el cuadro movil resetearlo con el boton reset buscador</p>
            <p>Con limpiar tabla se borran todos los voucher</p>
            <p>Ingresar el movil deseado y presionar buscar</p>
            <p>Aparecen la lista de los Voucher del móvil en cuestión con boton de <strong>DETALLES VALIDAR</strong> y <strong>BORRAR</strong></p>
            <p>El boton <strong>BORRAR </strong> lo elimina el boton <strong>VALIDAR </strong> lo guarda en la DDBB para procesarselo al movil</p>
        </li>
    </ul>

    <button onclick="cerrarPagina()">CERRAR PAGINA</button>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</body>


</html>