<?php
    require_once "config.php";
    require_once "db/connDb.php";
    require_once "funcion_back_admin.php";

    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php"); //redirecciona a login.php
    }
    $section = "admin_inventario"; //variable para identificar la seccion o pagina en que se esta
    $msg = "null"; // variable que contendra los mensajes que devuelven las funciones
    

    if (isset($_GET["eliminarProducto"])){ //si y solo si existe el metodo get con el indice eliminarProducto 
        $msg = eliminarProducto(); // ejecutar la funcion y guardar lo que devuelve en $msg
    }

    $datosProductos = listarProductos(); // guarda los datos devueltos de la funcion en la variable $datosProductos

    if (isset($_POST["buscarProducto"])){ //si y solo si existe el metodo post con el indice buscarProducto 
        if($_POST["buscar"]=="") //ademas si existe el metodo post con el indice buscar 
            $datosProductos = listarProductos();  // guarda los datos devueltos de la funcion en la variable $datosProductos
        else // sino
            $datosProductos = buscarProducto(); // guarda los datos devueltos de la funcion en la variable $datosProductos
    }
        


    

?>

<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>  <!-- incluye el navbar, los link de los estilos .css y los script .js -->

<body>

      <!-- formulario buscar-->
    <center>
        <form action="?" method="POST">
            <div class="input-group mb-3 size-input-search">
                <span class="input-group-text"><button type="submit"><i class="fas fa-search"></i></button> </span>
                <input type="hidden" name="buscarProducto">
                <input type="text" class="form-control" placeholder="Buscar" name="buscar">
            </div>
        </form>
    </center>
    <!-- fin del formulario buscar -->
    <!-- inicio de la tabla inventario-->
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
    <!--  fin de la tabla inventario -->


    <footer>
        <?php
        include_once("include/pie_de_pagina.php");
        ?>
        <script> //====================  pequenio escript de javascript =====================================
        var deletes = document.querySelectorAll(".js-delete"); // busca en html a todos los que contengan la clase css js-delete
        deletes.forEach(function(value, key) { // le da vuelta a todos los elementos encontrados
            value.addEventListener("click", function() {// se le asigana el evento click a los elementos
            dialogDelete(value)//al dar click se invoca a esta funcion
            }, false);
        });

        function dialogDelete(value) { // funcion para preguntar al eliminar un elemento
            swal('ADVERTENCIA', "Estas seguro de eliminar el Producto?.", "warning", {// funcion de swalAlert para cuadros de dialogo
                buttons: ["Cancelar", "Eliminar"]
            }).then(function(val) { // se ejecuta al cerrar el cuadro del dialogo
                var redir = value.getAttribute("href");// se obtine el atributo href del boton del elemento a eliminar
                if (val)
                    window.location.href = redir.substr(1);//redireccionar
            });
        }
    </script>
    </footer>
</body>

</html>