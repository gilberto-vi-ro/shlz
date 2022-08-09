<?php
require_once "config.php";
require_once "db/connDb.php";
require_once "funcion_back_emp.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_empleado"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}

$section = "emp_ventas";
$msg = "null";
$verVenta  = array();
$ventaTotal = 0;

$listarVentas = listarVentas();

if (isset($_GET["verVenta"])) {
  $verVenta = verVenta();
}


?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu_emp.php"; ?>
<title>Ventas</title>

<body>

  <?php if (isset($_GET["verVenta"])) {  ?>

    <section style="padding: 22px;">
      <div class="container p-5 s">
        <div class="row">
          <div class="col-md-6 ">
            <a href="?" class="btn btn-primary mb-4 btn-top">Regresar</a>
          </div>
        </div>


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
        </div>
        <br>
        <br>
    </section>

  <?php } else {  ?>
    <section style="padding: 22px;">
      <div class="container p-5 s">
        <form method="POST" action="?buscar" class="buscaddor-codigo">
          <label for="codigo">Buscar:</label>
          <input autocomplete="off" autofocus class="form-control" name="buscar" type="text" placeholder="Buscar">
        </form>
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
                  <td><a class="btn btn-primary" href="<?= "?verVenta&id=" . $venta->id_venta ?>"><i class="fas fa-eye"></i></a>
                  <a class="btn btn-primary" href="<?= "imprimirPdf.php?imprimirVenta&id=" . $venta->id_venta ?>"><i class="fas fa-print"></i></a>

                  </td>
                </tr>
              <?php } ?>
            </tbody>

          </table>
        </div>
        <br>
        <br>
    </section>
  <?php  } ?></td>
  <footer>
    <?php
    include_once("include/pie_de_pagina.php");
    ?>
    <script src="js/bootstrap_js/bootstrap.min.js"></script>

  </footer>

</body>

</html>