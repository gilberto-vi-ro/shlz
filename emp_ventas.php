<?php
require_once "config.php";
require_once "db/connDb.php";
require_once "funcion_back_emp.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_empleado"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}

if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
$section = "admin_ventas";


if (isset($_GET["agregarAlCarrito"])) {
   agregarAlCarrito();
  }
else if (isset($_GET["cancelarVenta"])) {
    cancelarVenta();
} else if (isset($_GET["cambiarCantidad"])) {
  cambiarCantidad();
} else if (isset($_GET["quitarDelCarrito"])) {
  quitarDelCarrito();
} else if (isset($_GET["terminarVenta"])) {
  terminarVenta();
} else if (isset($_GET["cancelarVenta"])) {
  cancelarVenta();
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
      <form method="POST" action="?agregarAlCarrito" class="buscaddor-codigo">
        <label for="codigo">Código de barras:</label>
        <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
      </form>


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

      <h3>Total: <?php echo $granTotal; ?></h3>
      <form action="?terminarVenta" method="POST">
        <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
        <button type="submit" class="btn btn-success">Terminar venta</button>
        <a href="?cancelarVenta" class="btn btn-danger">Cancelar venta</a>
      </form>

      <br>
      <br>
      <footer>
        <?php
        include_once("pie_de_pagina.php");
        ?>
        <script src="js/bootstrap_js/bootstrap.min.js"></script>

      </footer>

</body>

</html>