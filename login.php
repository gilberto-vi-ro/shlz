<?php
require_once "config.php";
require "db/connDb.php";
$msg = "";

if (isset($_POST["usuario"])) {
    $clasePDO = connDb()->prepare("select id,usuario,contrasena from empleado where usuario=? and contrasena=? ");
    $clasePDO->bindParam(1, $_POST["usuario"]);
    $clasePDO->bindParam(2, $_POST["contrasena"]);
    $clasePDO->execute(); //ejecutar la consulta
    $datosEmpleado = $clasePDO->fetch(PDO::FETCH_ASSOC); //obtener y guardar los datos de la bd en un array

    if (empty($datosEmpleado)) { //si esta vacio $datosEmpleado

        $clasePDO = connDb()->prepare("select id_admin,usuario,contrasena from administrador where usuario=? and contrasena=? ");
        $clasePDO->bindParam(1, $_POST["usuario"]);
        $clasePDO->bindParam(2, $_POST["contrasena"]);
        $clasePDO->execute(); //ejecutar la consulta
        $datosAdmin = $clasePDO->fetch(PDO::FETCH_ASSOC);
        if (empty($datosAdmin)) { //si esta vacio $datosAdmin
            $msg = "Usuario o contraseña incorrectos";
        } else {  //si no esta vacio es porque ingreso un administrador
            //echo "bienvenido como admin";
            session_start();
            $_SESSION["id_admin"] = $datosAdmin["id_admin"]; //guardamos el administrador.id_admin en una sesion id_admin
            header("Location:admin_inventario.php");
        }
    } else {  //si no esta vacio es porque ingreso un empleado
        // "bienvenido como empleado";
        session_start();
        $_SESSION["id_empleado"] = $datosEmpleado["id"]; //guardamos el empleado.id en una sesion id_empleado
        header("Location:emp_ventas.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf 8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache" />

    <link rel="stylesheet" href="css/css.css">
    <link rel="icon" type="image/x-icon" href="img/Logo.jpeg">
    <script src="js/sweetalert.min.js"></script>
    <title>
        Sha-Liz
    </title>

<body>
    <div><?php  if ($msg!="")
            echo '<script>swal("WARNING", "' . $msg . '", "warning")</script>'; ?></div><!--  cuadro de dialogo con js -->
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Ingresar </h2>
            <!-- <h2 class="inactive underlineHover">Registrarse </h2> -->


            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/Logo.jpeg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form action="?" method="POST">
                <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuario" required>
                <input type="password" id="password" class="fadeIn third" name="contrasena" placeholder="Contraseña" required>
                <input type="submit" class="fadeIn fourth" value="Ingresar">
            </form>

            <!-- Remind Passowrd
            <div id="formFooter">
                <a class="underlineHover" href="">Password</a>
            </div> -->

        </div>
    </div>
    <footer>

    </footer>
</body>

</html>