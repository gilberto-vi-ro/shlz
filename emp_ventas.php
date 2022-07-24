<?php
require_once "config.php";
require_once "db/connDb.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_empleado"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}
$section = "admin_ventas";

$p_codigo = "codigo:";
$p_nombre = "nombre";
$p_precio = "$0.0";


if (isset($_POST["buscar_codigo"])) {
  $p_codigo = $_POST["buscar_codigo"];
  // Prepara SELECT
  $miConsulta = connDB()->prepare("SELECT * FROM producto WHERE cod_producto='$p_codigo';");
  // Ejecuta consulta
  $miConsulta->execute();
  $data = $miConsulta->fetch(PDO::FETCH_ASSOC);

  $p_nombre =  $data["nombre"];
  $p_precio = $data["precio"];
  
  
}

//  //listar inventario
//  $miConsulta = connDB()->prepare("SELECT * FROM producto");
//  $miConsulta->execute();// Ejecutar consulta
//  $data = $miConsulta->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD

?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu_emp.php"; ?>
<title>Ventas</title>

<body>


  <section style="padding: 22px;">

    <div class="container p-5 s">
      <div class="row">
        <div class="col-lg-5">
          <div class="card" style="width: 18rem;">
            <!-- <img src="<?= $p_img ?>" class="card-img-top"> -->
            <div class="card-body">
              <form action="?" method="POST">
                <h2>Producto</h2>
                <hr>
                <input type="hidden" name="p_codigo" value="<?= $p_codigo ?>"></input>
                <h5 class="card-title"><?= $p_codigo ?></h5>
                <hr>
                <h5 class="card-text">
                  Nombre : <?= $p_nombre ?>
                </h5>
                <h5 class="card-text">
                  Precio : <?= $p_precio ?>
                </h5>
                <h5 class="card-text">
                  cantidad : <input type="text" name="p_cantidad"></input>
                  <br>
                  <br>
                 
                  <button class="btn btn-primary mx-5" data-item="3" style="margin-right: 1rem;">+</button>
                  
  <head>
    <br>
    <hr>
     
    <div class="container">
        <div class="row">
            <!-- Elementos generados a partir del JSON -->
            <main id="items" class="col-sm-16 row"></main>
            <!-- Carrito -->
            <aside class="col-sm-8">
            <h2>venta</h2>
                <!-- Elementos del carrito -->
                <ul id="carrito" class="list-group"></ul>
                <li class="list-group-item text-right mx-2">
                    <button class="btn btn-danger mx-5" data-item="3" style="margin-left: 1rem;">X</button></li>
                <hr>
                <!-- Precio total -->
                <p class="text-right">Total: <span id="total"></span></p>
                <!-- <button id="boton-vaciar" class="btn btn-danger">Vaciar</button> -->
            </aside>
        </div>
    </div>
              
    </head>
                </h5>
                <hr>
                <a href="" class="btn btn-primary">
                  vender
                </a>
              
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="col-sm-12 col-md-12 col-lg-12" style="width: 700px;">
            <form action="?" method="POST">
              <label>Buscar producto :</label>
              <input type="text" autofocus name="buscar_codigo"></input>
              <br>
              <button style="width:70px; background:whith; color: black;" class="btn btn-primary">Bucar</button>
            </form>

          </div>
        </div>
        <br><br>

    
    <!-- inicio de tabla -->
    <!-- <div class="top-table table-responsive">
        <table class="table table-striped table-bordered ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Opcion</th>
                </tr>
            </thead>
            <tbody> -->
              
                
            </tbody>
        </table>
    </div>

  <footer>
    <?php
      include_once("pie_de_pagina.php");
    ?>
    <script src="js/bootstrap_js/bootstrap.min.js"></script>
    
  </footer>

</body>
</html>