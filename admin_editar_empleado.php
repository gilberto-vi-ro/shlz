<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    $section = "";
    $msg = "null";

    if (isset($_POST["editarEmpleadoDelForm"]))
        $msg  = editarEmpleadoDelForm();

    if (isset($_GET["editarEmpleado"]))
        $datoEmpleado = obtenerDatosParaEditarEmpleado();
    else 
        header("Location:admin_registro_empleado.php");


        


?>
<!DOCTYPE html>
<html>
<title class="titulos">Actualizar producto</title>
<?php include_once "include/menu.php"; ?>

<body>

    <section>
        <center>
        <h2>Editar de Empleado</h2>
        </center>
        <!-- inicio de registro -->
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
        <!-- fin de registro -->
    </section>


    <footer>
        <?php
            include_once("pie_de_pagina.php");
        ?>

    </footer>

</body>

</html>