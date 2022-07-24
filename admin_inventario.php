<?php
    require_once "config.php";
    require_once "db/connDb.php";
    session_start(); //inicializar la sesion
    if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
        header("Location:login.php");
    }
    $section = "admin_inventario";

    
    //listar inventario
    $miConsulta = connDB()->prepare("SELECT * FROM producto");
    $miConsulta->execute();// Ejecutar consulta
    $data = $miConsulta->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
    


?>

<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>

<body>

    <center>
        <div class="input-group mb-3 size-input-search">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username">
        </div>
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
                <?php foreach ($data as $key => $value) {
                    
                    echo '<tr>
                           
                            <td>'. $value["cod_producto"]. '</td>
                            <td>'. $value["nombre"] . '</td>
                            <td>' . $value["precio"] . '</td>
                            <td>' . $value["stock"] . '</td>
                            <td><a class="btn btn-danger" href="?codigo='.$value["cod_producto"].'">Eliminar</a> <a class="btn btn-primary" href="admin_editar.php?codigo='.$value["cod_producto"].' '.$value["nombre"].' '.$value["precio"].' '.$value["stock"].'">Editar</a></td>
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
        <script src="js/bootstrap_js/bootstrap.min.js"></script>
        <script src="js/sweetalert.min.js"></script>
    </footer>
</body>

</html>