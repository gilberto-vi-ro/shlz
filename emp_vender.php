<?php
require_once "config.php";
require_once "db/connDb.php";
require_once "funcion_back_emp.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_empleado"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}

$section = "emp_vender";
$msg = "null";
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;



if (isset($_GET["agregarAlCarrito"])) {
  $msg = agregarAlCarrito();
}
else if (isset($_GET["cancelarVenta"])) {
  $msg = cancelarVenta();
} else if (isset($_GET["cambiarCantidad"])) {
  $msg = cambiarCantidad();
} else if (isset($_GET["quitarDelCarrito"])) {
  $msg = quitarDelCarrito();
} else if (isset($_GET["terminarVenta"])) {
  $msg = terminarVenta();
} else if (isset($_GET["cancelarVenta"])) {
  $msg = cancelarVenta();
}




?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu_emp.php"; ?>
<title>Ventas</title>

<body>


  <section style="padding: 22px;">


    <div class="container p-5 s">
      <form method="POST" action="?agregarAlCarrito" class="buscaddor-codigo">
        <label for="codigo">Código de barras:</label>
        <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
      </form>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
            
              <th>Código</th>
              <th>Descripción</th>
              <th>Precio de venta</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Quitar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION["carrito"] as $indice => $producto) {
              $granTotal += $producto->total;
            ?>
              <tr>
                <td><?= $producto->cod_producto ?></td>
                <td><?= $producto->nombre ?></td>
                <td><?= $producto->precio ?></td>
                <td>
                  <form action="?cambiarCantidad" method="post">
                    <input name="indice" type="hidden" value="<?= $indice; ?>">
                    <input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?= $producto->cantidad; ?>">
                  </form>
                </td>
                <td><?= $producto->total ?></td>
                <td><a class="btn btn-danger" href="<?= "?quitarDelCarrito&indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <h3>Total: <?php echo $granTotal; ?></h3>
      <form action="?terminarVenta" method="POST">
        <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
        <button type="submit" class="btn btn-success">Terminar venta</button>
        <a href="?cancelarVenta" class="btn btn-danger">Cancelar venta</a>
      </form>

      <br>
      <br>
  </section>
      <footer>
        <?php
        include_once("include/pie_de_pagina.php");
        ?>
        <script src="js/bootstrap_js/bootstrap.min.js"></script>

      </footer>

</body>

</html>