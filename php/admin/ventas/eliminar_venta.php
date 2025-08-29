<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();

echo $movil = $_GET['q'];
echo "<br>";
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">

</head>

<body>
    <?php

    $sql_1 = "SELECT * FROM completa WHERE movil = $movil";
    $lee_1 = $con->query($sql_1);
    $row_1 = $lee_1->fetch_assoc();

    ?>


    <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table width="50%" border="0" align="center">
            <tr>
                <td class="primera_fila">Id</td>
                <td class="primera_fila">Nombre</td>
                <td class="primera_fila">Apellido</td>
                <td class="primera_fila">Dirección</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
            </tr>


            <!-- Esta parte es para que las lineas se repitan -->
            <?php
            //--------------------------------------------------------------------------
            // Esta parte es del READ
            foreach ($row_1 as $persona) :
                /*
            Este es el array donde tengo almacenados todos los objetos de mi BBDD
            $persona es una variable cualquiera
            */
                //-----------------------------------------------------------------------
            ?>

                <tr>
                    <td><?php echo $persona->id ?> </td>
                    <td><?php echo $persona->nombre ?></td>
                    <td><?php echo $persona->apellido ?></td>
                    <td><?php echo $persona->direccion ?></td>

                    <td class="bot"><a href="borrar.php?id=<?php echo $persona->id ?>">
                            <input type='button' name='del' id='del' value='Borrar'></a></td>


                    <td class='bot'><a href="editar.php?id=<?php echo $persona->id
                                                            ?> & nom=<?php echo $persona->nombre ?> 
                                                           & ape=<?php echo $persona->apellido ?> 
                                                           & dir=<?php echo $persona->direccion ?>">
                            <input type='button' name='up' id='up' value='Actualizar'></a></td>
                    <!-- ------------------------------ -->
                </tr>
            <?php
            // READ-------------------------------------------------------------------------------------
            endforeach;
            //Otra forma de hacerlo es concatenando todo para que quede php dentro de cada linea de html
            //------------------------------------------------------------------------------------------

            ?>

            <!-- Esta es la parte del insert con la linea <form action=" <?php //echo $_SERVER['PHP_SELF']; 
                                                                            ?>" method="post">-->
            <tr>
                <td></td>
                <td><input type='text' name='Nom' size='10' class='centrado'></td>
                <td><input type='text' name='Ape' size='10' class='centrado'></td>
                <td><input type='text' name=' Dir' size='10' class='centrado'></td>
                <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
            </tr>
        </table>
    </form>

    <p>&nbsp;</p>
</body>

</html>
</table>