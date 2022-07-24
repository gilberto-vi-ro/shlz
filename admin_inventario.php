<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php");
    }
    $section = "admin_inventario";
    $msg = "null";
    

    if (isset($_GET["eliminarProducto"])){
        $msg = eliminarProducto();
    }

    $datosProductos = listarProductos();

    if (isset($_POST["buscarProducto"])){
        if($_POST["buscar"]=="")
            $datosProductos = listarProductos();
        else
            $datosProductos = buscarProducto();
    }
        


    

?>

<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>

<body>

      <!-- buscador-->
    <center>
        <form action="?" method="POST">
            <div class="input-group mb-3 size-input-search">
                <span class="input-group-text"><button type="submit"><i class="fas fa-search"></i></button> </span>
                <input type="hidden" name="buscarProducto">
                <input type="text" class="form-control" placeholder="Buscar" name="buscar">
            </div>
        </form>
    </center>

    <!-- inicio de tabla -->
    <div class="top-table table-responsive">
        <table class="table table-striped table-bordered ">
            <thead>
                <tr>
                   
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Opcion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosProductos as $key => $value) {
                    
                    echo '<tr>
                           
                            <td>'. $value["cod_producto"]. '</td>
                            <td>'. $value["nombre"] . '</td>
                            <td>' . $value["precio"] . '</td>
                            <td>' . $value["stock"] . '</td>
                            <td>
                                <a href="admin_editar_producto.php?editarProducto&codigo='.$value["cod_producto"].'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="#?eliminarProducto&codigo='.$value["cod_producto"].'" class="btn btn-danger js-delete"><i class="fas fa-trash-alt"></i></a>
                        </tr>
                        ';
                } ?>
                
            </tbody>
        </table>
    </div>
    <!--  end table -->


    <footer>
        <?php
        include_once("pie_de_pagina.php");
        ?>
        <script>
        var deletes = document.querySelectorAll(".js-delete");
        deletes.forEach(function(value, key) {
            value.addEventListener("click", function() {
            dialogDelete(value)
            }, false);
        });

        function dialogDelete(value) {
            swal('ADVERTENCIA', "Estas seguro de eliminar el Producto?.", "warning", {
            buttons: ["Cancelar", "Eliminar"]
            }).then(function(val) {
            var redir = value.getAttribute("href");
            if (val)
                window.location.href = redir.substr(1);//redireccionar
            }).then(function(val) {});
        }
    </script>
    </footer>
</body>

</html>