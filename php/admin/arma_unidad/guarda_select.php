<?php

echo $options_1 = $_POST['opciones'];
if ($options_1 == NULL) {

    echo "Elija el importe... ";
?>
    <script>
        confirm("Seleccione importe a cobrarle...");
        window.location.href = "select.php";
    </script>
<?php
}
