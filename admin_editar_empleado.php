<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php");//redirecciona a login.php
    }
    $section = ""; //variable para identificar la seccion o pagina en que se esta
    $msg = "null"; // variable que contendra los mensajes que devuelven las funciones

    if (isset($_POST["editarEmpleadoDelForm"])) //si y solo si existe el metodo post con el indice editarEmpleadoDelForm 
        $msg  = editarEmpleadoDelForm(); // llamar a lafuncion y guardar lo que devuelve en $msg

    if (isset($_GET["editarEmpleado"]))//si existe el metodo get  con el indice editarEmpleado 
        $datoEmpleado = obtenerDatosParaEditarEmpleado();// llamar a lafuncion y guardar lo que devuelve en $datoEmpleado 
    else //si no existe el metodo get  con el indice editarEmpleado 
        header("Location:admin_registro_empleado.php"); // redireccionar a admin_registro_empleado.php


        


?>
<!DOCTYPE html>
<html>
<title class="titulos">Actualizar producto</title>
<?php include_once "include/menu.php"; ?>  <!-- incluye el navbar, los link de los estilos .css y los script .js -->

<body>

    <section>
        <center>
        <h2>Editar de Empleado</h2>
        </center>
        <!-- inicio del formulario del registro -->
        <form action="?editarEmpleado&id=<?=$_GET["id"]?>" class="cont-form" method="POST">
        <input type="hidden" name="editarEmpleadoDelForm">
        <input type="hidden" name="id_empleado" value="<?=$datoEmpleado["id"]?>">
        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="nombre_emp" value="<?=$datoEmpleado["nombre"]?>" required>
            </div>
        </div>

        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Apellido</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="apellido_emp" value="<?=$datoEmpleado["apellido"]?>" required>
            </div>
        </div>

        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Telefono</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="telefono_emp" value="<?=$datoEmpleado["telefono"]?>" required>
            </div>
        </div>

        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Direccion</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="direccion_emp" value="<?=$datoEmpleado["direccion"]?>" required>
            </div>
        </div>

        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">RFC</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="rfc_emp" value="<?=$datoEmpleado["rfc"]?>" required>
            </div>
        </div>
        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="usuario_emp" value="<?=$datoEmpleado["usuario"]?>" required>
            </div>
        </div>
        <div class="mb-3 row form-goup">
            <label class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" name="contrasena_emp" value="<?=$datoEmpleado["contrasena"]?>" required>
            </div>
        </div>
        <center><button type="submit" class="btn btn-primary">Guardar cambios</button></center>
        </form>
        <!-- fin del formulario del registro -->
    </section>


    <footer>
        <?php
            include_once("include/pie_de_pagina.php");
        ?>

    </footer>

</body>

</html>