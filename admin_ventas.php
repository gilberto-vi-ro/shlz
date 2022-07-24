<?php
require_once "config.php";
require_once "db/connDb.php";
require_once "funcion_back_admin.php";


session_start(); //inicializar la sesion
if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}
$section = "admin_ventas";

?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>
<title>Ventas</title>

<body>


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
  <br>
  <br>
  <br>
  <!-- inicio de tabla -->
  <div class="top-table table-responsive">
    <table class="table table-striped table-bordered ">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Total</th>
          <th scope="col">Fecha</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>@mdo</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>Otto</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>@fat</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>Otto</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>@fat</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>Otto</td>
        </tr>
      </tbody>
      <tr>
        <th scope="row">4</th>
        <td class="col" colspan="2">Total</td>
        <td scope="row" colspan="2">$100</td>

      </tr>
    </table>
  </div>
  <!--  end table -->

  <footer>
    <?php
    include_once("pie_de_pagina.php");
    ?>
  </footer>

</body>