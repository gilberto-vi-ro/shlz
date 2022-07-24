<?php
require_once "config.php";
require_once "db/connDb.php";
session_start(); //inicializar la sesion
if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
  header("Location:login.php");
}
$section = "admin_registro_empleado";
?>
<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>
<title>Registro empleado</title>

<body>
  <center>
    <h2>Registro de Empleado</h2>
  </center>
  <!-- inicio de registro -->
  <form class="cont-form">
    <div class="mb-3 row form-goup">
      <label class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nombre_emp" required>
      </div>
    </div>

    <div class="mb-3 row form-goup">
      <label class="col-sm-2 col-form-label">Apellido</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="apellido_emp" required>
      </div>
    </div>

    <div class="mb-3 row form-goup">
      <label class="col-sm-2 col-form-label">Telefono</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="telefono_emp" required>
      </div>
    </div>

    <div class="mb-3 row form-goup">
      <label class="col-sm-2 col-form-label">Direccion</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="direccion_emp" required>
      </div>
    </div>

    <div class="mb-3 row form-goup">
      <label class="col-sm-2 col-form-label">RFC</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="rfc_emp" required>
      </div>
    </div>
    <center><button type="submit" class="btn btn-primary">Registrar</button></center>
  </form>
  <!-- fin de registro -->

  <!-- inicio de tabla -->
  <div class="top-table table-responsive">
    <table class="table table-striped table-bordered ">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Telefono</th>
          <th scope="col">Direccion</th>
          <th scope="col">RFC</th>
          <th scope="col">Fecha Ingreso</th>
          <th scope="col">Opcion</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>
            <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger js-delete"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>Otto</td>
          <td>
            <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger js-delete"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <tr>
          <th scope="row">3</th>

          <td>uhhkj </td>
          <td>Thornton</td>
          <td>@fat</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td>Otto</td>
          <td>
            <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger js-delete"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
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
    <script>
      var deletes = document.querySelectorAll(".js-delete");
      deletes.forEach(function(value, key) {
        value.addEventListener("click", function() {
          dialogDelete(value)
        }, false);
      });

      function dialogDelete(value) {
        swal('ADVERTENCIA', "Estas seguro de eliminar el Empleado?.", "warning", {
          buttons: ["Cancelar", "Eliminar"]
        }).then(function(val) {
          var redir = value.getAttribute("href");
          if (val)
            window.location.href = redir.substr(1);
        }).then(function(val) {});
      }
    </script>
  </footer>


</body>

</html>