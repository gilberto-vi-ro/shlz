<?php
    session_start();

    if (!isset($_SESSION["id_empleado"])) {
        header("Location:login.php");
    }
    echo "empleado"; echo "empleado";
?>
