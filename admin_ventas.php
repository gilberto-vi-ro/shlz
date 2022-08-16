<?php
require_once "config.php";
require_once "db/connDb.php";
require_once "funcion_back_admin.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php"); //redirecciona a login.php
}
$section = "admin_ventas"; //variable para identificar la seccion o pagina en que se esta
$msg = "null"; // variable que contendra los mensajes que devuelven las funciones 
$verVenta  = array();  //varible en array que guardara los datos de las ventas
$ventaTotal = 0; //variable que guarda el total de las ventas

$listarVentas = listarVentas(); //guarda los datos devueltos de la funcion en la variable $listarVentas

if (isset($_GET["verVenta"])) { //si y solo si existe el metodo get con el indice verVenta 
  $verVenta = verVenta(); //variable que almacena el los datos de la db de las ventas
}


?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?> <!-- incluye el navbar, los link de los estilos .css y los script .js -->
<title>Ventas</title>

<body>

  <?php if (isset($_GET["verVenta"])) {  ?> <!-- si existe el metodo get con el indice verVenta  -->

    <section style="padding: 22px;">
      <div class="container p-5 s">
        <div class="row">
          <div class="col-md-6 ">
            <a href="?" class="btn btn-primary mb-4 btn-top">Regresar</a>
          </div>
        </div>

        <!-- inicio de la tabla de ventas por articulos-->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>

                <th>#</th>
                <th>Codigo producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($verVenta as $indice => $producto) {
                $ventaTotal += $producto->total;
              ?>
                <tr>
                  <td><?= $indice + 1 ?></td>
                  <td><?= $producto->cod_producto ?></td>
                  <td><?= $producto->nombre ?></td>
                  <td><?= $producto->precio ?></td>
                  <td><?= $producto->cantidad ?></td>
                  <td><?= $producto->total ?></td>
                  <!-- <td><a class="btn btn-danger" href="?= "?eliminarVenta&id=" . $producto->id_venta ?>"><i class="fa fa-trash"></i></a></td> -->
                  <!-- <td><a class="btn btn-primary" href="<?= "?verVenta&id=" . $producto->id_venta ?>"><i class="fas fa-eye"></i></a></td> -->
                </tr>
              <?php } ?>
            </tbody>
            <tr class="tr-colspan">
              <td scope="row" colspan="5">Total price</td>
              <td translate="no">$ <?= $ventaTotal ?></td>
            </tr>
          </table>
           <!-- fin de la tabla de ventas por articulos -->
        </div>
        <br>
        <br>
    </section>

  <?php } else {  ?>  <!-- sino existe el metodo get con el indice verVenta  -->
    <section style="padding: 22px;">
      <!-- rango de fecha -->
      <form class="date-range">
        <ul>
          <li>
            <input type="date" class="date-box" name="date_range1">
          </li>
          <li>
            <input type="date" class="date-box" name="date_range2">
          </li>

        </ul>
        <center><button type="submit" class="btn btn-primary mt-2">Filtrar</button></center>
      </form>
      <!-- fin rango de fecha -->
      <div class="container p-5 s">
        <!-- inicio del formulario de buscaddor-codigo -->
        <form method="POST" action="?buscar" class="buscaddor-codigo">
          <label for="codigo">Buscar:</label>
          <input autocomplete="off" autofocus class="form-control" name="buscar" type="text" placeholder="Buscar">
        </form>
         <!-- fin del formulario de buscaddor-codigo -->
         <!-- inicio de la tabla de ventas -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>

                <th>#</th>
                <th>Id venta</th>
                <th>Total</th>
                <th>Fecha de venta</th>
                <th>ID Empleado</th>
                <th>Nombre Empleado</th>
                <th>Ver</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listarVentas as $indice => $venta) {

              ?>
                <tr>
                  <td><?= $indice + 1 ?></td>
                  <td><?= $venta->id_venta ?></td>
                  <td><?= $venta->total ?></td>
                  <td><?= $venta->fecha_venta ?></td>
                  <td><?= $venta->dni ?></td>
                  <td><?= $venta->nombre_completo ?></td>
                  <!-- <td><a class="btn btn-danger" href="?= "?eliminarVenta&id=" . $venta->id_venta ?>"><i class="fa fa-trash"></i></a></td> -->
                  <td><a class="btn btn-primary" href="<?= "?verVenta&id=" . $venta->id_venta ?>"><i class="fas fa-eye"></i></a></td>
                </tr>
              <?php } ?>
            </tbody>

          </table><!-- fin de la tabla de ventas -->
        </div>
        <br>
        <br>
    </section>
  <?php  } ?>
  <footer>
    <?php
    include_once("include/pie_de_pagina.php");
    ?>

  </footer>

</body>

</html>