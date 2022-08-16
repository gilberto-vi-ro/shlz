<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php"); //redirecciona a login.php
    }

    $section = "admin_registro_producto";  //variable para identificar la seccion o pagina en que se esta
    $msg = "null"; // variable que contendra los mensajes que devuelven las funciones 

    if (isset($_POST["registroProducto"])) //si y solo si existe el metodo post con el indice registroProducto 
        $msg = registroProducto(); // ejecutar a la funcion y guardar lo que devuelve en $msg


?>
<!DOCTYPE html>
<html>
<title class="titulos">Registro producto</title>
<?php include_once "include/menu.php"; ?><!-- incluye el navbar, los link de los estilos .css y los script .js -->

<body>

    <section>
        <center>
            <h2>Registro de Producto</h2>
        </center>
        <!-- inicio del formulario registro -->
        <form class="cont-form" action="?" method="POST">
            <input type="hidden" name="registroProducto">
            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Codigo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="codigo_prod" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nombre_prod" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="precio_prod" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="cantidad_prod" required>
                </div>
            </div>

            <center><button type="submit" class="btn btn-primary">Registrar</button></center>
        </form>
        <!-- fin del formulario registro -->

    </section>


    <footer>
        <?php
        include_once("include/pie_de_pagina.php");
        
        ?>

    </footer>

</body>

</html>