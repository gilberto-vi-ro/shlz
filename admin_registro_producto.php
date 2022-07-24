<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php");
    }

    $section = "admin_registro_producto";
    $msg = "null";

    if (isset($_POST["registroProducto"]))
        $msg = registroProducto();


?>
<!DOCTYPE html>
<html>
<title class="titulos">Registro producto</title>
<?php include_once "include/menu.php"; ?>

<body>

    <section>
        <center>
            <h2>Registro de Producto</h2>
        </center>
        <!-- inicio de registro -->
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
        <!-- fin de registro -->

    </section>


    <footer>
        <?php
        include_once("pie_de_pagina.php");
        
        ?>

    </footer>

</body>

</html>