<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    $section = "admin_registro_producto";
    $msg = "null";

    if (isset($_POST["editarProductoDelForm"]))
        $msg  = editarProductoDelForm();

    if (isset($_GET["editarProducto"]))
        $datoProducto = obtenerDatosParaEditarProducto();
    else 
        header("Location:admin_inventario.php");


        


?>
<!DOCTYPE html>
<html>
<title class="titulos">Actualizar producto</title>
<?php include_once "include/menu.php"; ?>

<body>

    <section>
        <center>
            <h2>Actualizar Producto</h2>
        </center>
        <!-- inicio de registro -->
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
        <!-- fin de registro -->

    </section>


    <footer>
        <?php
            include_once("pie_de_pagina.php");
        ?>

    </footer>

</body>

</html>