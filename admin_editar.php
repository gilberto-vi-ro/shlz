<?php
require_once "config.php";
require_once "db/connDb.php";
$section = "admin_registro_producto";
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
        <form class="cont-form" action="admin_inventario.php" method="POST">
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

            <center><button type="submit" class="btn btn-primary">actualizar</button></center>
        </form>
        <!-- fin de registro -->

    </section>


    <footer>
        <?php
        include_once("pie_de_pagina.php");
        ?>
        <script src="js/bootstrap_js/bootstrap.min.js"></script>
        <script src="js/sweetalert.min.js"></script>

    </footer>

</body>

</html>