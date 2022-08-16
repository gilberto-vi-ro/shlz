<?php
  require_once "config.php";
  require_once "db/connDb.php";
  require_once "funcion_back_admin.php";

  session_start(); //inicializar la sesion
  if (!isset($_SESSION["id_admin"])) { //si no existe la sesion id_admin regresar al login.php
    header("Location:login.php"); //redirecciona a login.php
  }
  $section = "admin_registro_empleado";//variable para identificar la seccion o pagina en que se esta
  $msg = "null";// variable que contendra los mensajes que devuelven las funciones 
 

  if (isset($_POST["registrarEmpleado"])){ //si y solo si existe el metodo post con el indice registrarEmpleado 
       $msg = registrarEmpleado(); // ejecutar a la funcion y guardar lo que devuelve en $msg
  }

  if (isset($_GET["eliminarEmpleado"])){ //si y solo si existe el metodo get con el indice eliminarEmpleado 
    $msg = eliminarEmpleado();  // ejecutar a la funcion y guardar lo que devuelve en $msg
  }

    
  $datosEmpleados = listarEmpleados(); // guarda los datos devueltos de la funcion en la variable  $datosEmpleados
  

?>


<!DOCTYPE html>
<html>

<?php include_once "include/menu.php"; ?> <!-- incluye el navbar, los link de los estilos .css y los script .js -->
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
    <!-- inicio del formulario registro -->
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
    <!-- fin del formulario registro -->
  </div>

  <!-- inicio de tabla de los empleados -->
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
  <!--  fin de tabla de los empleados -->


  <footer>
    <?php
    include_once("include/pie_de_pagina.php");

    ?>
    <script>//====================  pequenio escript de javascript =====================================
      var deletes = document.querySelectorAll(".js-delete"); // busca en html a todos los que contengan la clase css js-delete
      deletes.forEach(function(value, key) { // le da vuelta a todos los elementos encontrados
        value.addEventListener("click", function() { // se le asigana el evento click a los elementos
          dialogDelete(value)//al dar click se invoca a esta funcion
        }, false);
      });

      function dialogDelete(value) {  // funcion para preguntar al eliminar un elemento
        swal('ADVERTENCIA', "Estas seguro de eliminar el Empleado?.", "warning", { // funcion de swalAlert para cuadros de dialogo
          buttons: ["Cancelar", "Eliminar"]
        }).then(function(val) {// se ejecuta al cerrar el cuadro del dialogo
          var redir = value.getAttribute("href"); // se obtine el atributo href del boton del elemento a eliminar
          if (val)
            window.location.href = redir.substr(1);
        });
      }
    </script>
  </footer>


</body>

</html>