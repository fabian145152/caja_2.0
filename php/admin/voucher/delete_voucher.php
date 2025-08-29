    <?php
    session_start();
    include_once "../../../funciones/funciones.php";
    $con = conexion();
    $con->set_charset("utf8mb4");
    echo $id = $_GET['q'];


    $sql_mov = "SELECT * FROM `voucher_nuevos` WHERE id=" . $id;
    $stmt = $con->query($sql_mov);
    $row = $stmt->fetch_assoc();

    echo $row['id'];
    echo "<br>";
    echo $movil = $row['movil'];
    echo "<br>";
    echo $row['viaje_no'];
    echo "<br>";



    $sql = "DELETE FROM `voucher_nuevos` WHERE id =" . $id;
    $result = $con->query($sql);

    header("Location: buscador_voucher.php?movil=$movil");
    //header("Location:inicio_voucher.php");

    ?>
