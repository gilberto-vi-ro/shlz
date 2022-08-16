<?php
    session_start();  //inicializar la sesion
    $_SESSION = array(); // dar valor de array vacio a la variable sesion
    session_destroy();  //destruir la sesion

    header('Location:login.php'); //redirecciona a login.php
?>