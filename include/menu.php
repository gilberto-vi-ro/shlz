<head>

  <meta charset="utf 8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="img/Logo.jpeg">

  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/administrador.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/icon/font-awesome.min.css">
  <link rel="stylesheet" href="css/icon/ka-f.fontawesome.v5.15.4.free.min.css">
  <script src="js/bootstrap_js/bootstrap.min.js"></script>
  <script src="js/sweetalert.min.js"></script>
  <!-- /*=============================================
    ICONS FONTAWESOME FREE
    https://fontawesome.com/v5/search 
    =============================================*/-->
  <header>
    <!-- inicio de navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/Logo.jpeg" alt="" style="width:60px;" class="rounded-pill"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a id="inventario" class="nav-link" aria-current="page" href="admin_inventario.php">Inventario</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Registro
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a id="empleado" class="dropdown-item" href="admin_registro_empleado.php">Empleado</a></li>
                <hr class="dropdown-divider">
                <li><a id="producto" class="dropdown-item" href="admin_registro_producto.php">Producto</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a id="ventas" class="nav-link" aria-current="page" href="admin_ventas.php">Ventas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="cerrar_sesion.php">Cerrar sesion</a>
            </li>
          </ul>
          <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
        </div>
      </div>
    </nav>
  </header>
  <script>//====================  pequenio escript de javascript =====================================
    var section = "<?= $section; ?>"; //variable que obtine el valor de la variable de php $section
    var msg = "<?= $msg; ?>";  //variable que obtine el valor de la variable de php $msg
    

    if (section == "admin_inventario") //si la seccion o pagina es = a admin_inventario
      document.getElementById("inventario").classList.add("active");// busca el id en html y le agrega una clase css
    else if (section == "admin_registro_empleado") //sino, entonces la seccion o pagina es = a admin_registro_empleado
      document.getElementById("navbarDropdown").classList.add("active");// busca el id en html y le agrega una clase css
    else if (section == "admin_registro_producto") //sino, entonces la seccion o pagina es = a admin_registro_producto
      document.getElementById("navbarDropdown").classList.add("active");// busca el id en html y le agrega una clase css
    else if (section == "admin_ventas") //sino, entonces la seccion o pagina es = a admin_ventas
      document.getElementById("ventas").classList.add("active");// busca el id en html y le agrega una clase css

    if(msg!="null")// si y solo si la variable msg es diferente de null
      swal("INFO", msg, "info")// mensaje de cuadro del dialogo
      .then(function(val){// se ejecuta al cerrar el cuadro del dialogo
          history.pushState(null,"","?");//quita el get de la url
      });
  </script>

</head>