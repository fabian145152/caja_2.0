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
    <h1>PROCESO DE ARMADO DE UNA UNIDAD</h1>
    <ul>

        <li>
            <h2>Primer paso.</h2>
            <h2>BOTON <strong>"CREAR NUMERO DE MOVIL"</strong>Del menu principal.<h2>
        </li>
    </ul>
    <ul>
        <li>
            <p>En esta pantalla se ven los numeros de móvil </p>
        </li>
        <li>BOTON <strong>"NUEVO NUMERO DE MOVIL"</strong>
            <p>En esta pantalla se cargan los numeros nuevos.</p>
            <p> <strong>"EDITAR"</strong> Puede cambiar el numero </p>
            <P><strong>"SALIR"</strong>Vuelve a la pantalla anterior.</P>
            <p>Los números de movil no se podran repetir.</p>
        </li>
    </ul>
    <ul>
        <li>
            <h2>Segundo paso.</h2>

            <h2>BOTON <strong>"CREAR NUEVA TROPA"</strong>Del menu principal.</h2>

        </li>
        <li>
            <P>En esta pantalla se ve el listado de tropas completo por orden numero de tropa</P>
        </li>
        <li>BOTON <strong>"NUEVA TROPA"</strong>
            <p>Primero carga el numero de tropa</p>
            <p>Los numeros de moviles separados por coma</p>
            <p>Y los datos del titular</p>
            <p></p>
            <p>Tener en cuenta que si queda un solo movil en la tropa debera cambiarle el numero a 50 y pasa a ser unidad libre</p>
        </li>
    </ul>
    <ul>
        <li>
            <h2>Tercer paso.</h2>
            <h2>BOTON <strong>"CREAR EDITAR TITULARES"</strong>Del menu principal.</h2>
        </li>
        <li>
            <P>Seleccionar el movil creado anteriormente en el menu <strong>CREAR NUMERO DE MOVIL</strong></P>
            <p>Editar los daos del titular</p>
        </li>
    </ul>
    <ul>
        <li>
            <h2>Cuarto paso.</h2>
            <h2>BOTON <strong>"EDICION UNIDAD COMPLETA"</strong> Del menu principal</h2>
        </li>
        <li>
            <p>En la siguiente pantalla aparece la lista resumida de los detalles de cada unidad.</p>
            <p>En detalle se ven todos los detalles de la unidad numero de movil titular choferes y unidad.</p>
        </li>
    </ul>
    <ul>
        <li>
            <h2>Quinto paso.</h2>
            <h2>BOTON <strong>"CONFIGURA UNIDAD PARA COBRAR"</strong> Del menu principal</h2>
        </li>
        <li>
            <p>Ingresar el numero de movil + enter</p>
            <p>Muestra los el numero de movil y los datos del titular.</p>
            <p>Seleccionar el abono y la fecha de inicio de facturacion.</p>
        </li>
    </ul>
    <ul>
        <li>
            <h2>Una vez realizados estos pasos, al móvil ya se le empieza a facturar.</h2>
        </li>
    </ul>
    <button onclick="cerrarPagina()">CERRAR PAGINA</button>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
    <br><br><br>
    <?php foot() ?>
</body>

</html>