<?php
  require_once "config.php";
  require_once "db/connDb.php";
  require_once "funcion_back_admin.php";

  session_start(); //inicializar la sesion
  if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
    header("Location:login.php");
  }
  $section = "admin_registro_empleado";
  $msg = "null";

  if (isset($_POST["registrarEmpleado"])){
       $msg = registrarEmpleado();
  }

  if (isset($_GET["eliminarEmpleado"])){
    $msg = eliminarEmpleado();
  }

    
  $datosEmpleados = listarEmpleados();
  

?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?>
<title>Registro empleado</title>

<body>
  <center>
    <a class="btn  mt-3 bg-navbar" data-bs-toggle="collapse" href="#collapseRegistro" role="button" aria-expanded="false" aria-controls="collapseExample">
        Registrar Empleado
    </a>
  </center>
  <div class="collapse" id="collapseRegistro">
    <center>
      <h2>Registro de Empleado</h2>
    </center>
    <!-- inicio de registro -->
    <form action="?" class="cont-form" method="POST">
      <input type="hidden" name="registrarEmpleado">
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
      <div class="mb-3 row form-goup">
        <label class="col-sm-2 col-form-label">Usuario</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="usuario_emp" required>
        </div>
      </div>
      <div class="mb-3 row form-goup">
        <label class="col-sm-2 col-form-label">Contraseña</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="contrasena_emp" required>
        </div>
      </div>
      <center><button type="submit" class="btn btn-primary">Registrar</button></center>
    </form>
    <!-- fin de registro -->
  </div>

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
        <?php 
        $i = 0;
        foreach ($datosEmpleados as $key => $value) {
                    $i ++;
                    echo '<tr>
                            <td>'. $i. '</td>
                            <td>'. $value["nombre"] . '</td>
                            <td>' .$value["apellido"] . '</td>
                            <td>' .$value["telefono"] . '</td>
                            <td>'. $value["direccion"]. '</td>
                            <td>'. $value["rfc"]. '</td>
                            <td>'. $value["fecha_ingreso"]. '</td>
                            <td>
                                <a href="admin_editar_empleado.php?editarEmpleado&id='.$value["id"].'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="#?eliminarEmpleado&&id='.$value["id"].'" class="btn btn-danger js-delete"><i class="fas fa-trash-alt"></i></a>
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