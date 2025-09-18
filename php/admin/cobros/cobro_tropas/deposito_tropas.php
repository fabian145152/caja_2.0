<?php

$tropa = $_POST['tropa'];
echo "<br>" . $tropa;



echo "<br>";
if (isset($_POST['moviles'])) {
    $moviles_recibidos = $_POST['moviles']; // array de móviles

    foreach ($moviles_recibidos as $index => $movil) {
        // Creamos variables dinámicas $movil_1, $movil_2, etc.
        ${"movil_" . ($index + 1)} = $movil;

        echo "Móvil " . ($index + 1) . ": " . ${"movil_" . ($index + 1)} . "<br>";
    }

    
}
