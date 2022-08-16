<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php"); //redirecciona a login.php
    }
    $section = ""; //variable para identificar la seccion o pagina en que se esta
    $msg = "null"; // variable que contendra los mensajes que devuelven las funciones

    if (isset($_POST["editarProductoDelForm"])) //si y solo si existe el metodo post con el indice editarProductoDelForm 
        $msg  = editarProductoDelForm(); // llamar a lafuncion y guardar lo que devuelve en $msg

    if (isset($_GET["editarProducto"])) //si existe el metodo get  con el indice editarProducto 
        $datoProducto = obtenerDatosParaEditarProducto(); // llamar a lafuncion y guardar lo que devuelve en $datoProducto 
    else //si no existe el metodo get  con el indice editarProducto 
        header("Location:admin_inventario.php"); // redireccionar a admin_inventario.php

        


?>
<!DOCTYPE html>
<html>
<title class="titulos">Actualizar producto</title>
<?php include_once "include/menu.php"; ?>  <!-- incluye el navbar, los link de los estilos .css y los script .js -->

<body>

    <section>
        <center>
            <h2>Actualizar Producto</h2>
        </center>
        <!-- inicio del formulario de registro -->
        <form class="cont-form" action="?editarProducto&codigo=<?=$_GET['codigo']?>" method="POST">
            <input type="hidden" name="editarProductoDelForm">
            <input type="hidden" name="codigo_prod" value="<?=$datoProducto["cod_producto"]?>">
            
            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Codigo</label>
                <div class="col-sm-10">
                    <input type="text" disabled class="form-control"  value="<?=$datoProducto["cod_producto"]?>" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nombre_prod" value="<?=$datoProducto["nombre"]?>" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="precio_prod" value="<?=$datoProducto["precio"]?>" required>
                </div>
            </div>

            <div class="mb-3 row form-goup">
                <label class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="cantidad_prod" value="<?=$datoProducto["stock"]?>" required>
                </div>
            </div>

            <center><button type="submit" class="btn btn-primary">actualizar</button></center>
        </form>
        <!-- del formulario de registro -->

    </section>


    <footer>
        <?php
        include_once("include/pie_de_pagina.php");
        ?>

    </footer>

</body>

</html>