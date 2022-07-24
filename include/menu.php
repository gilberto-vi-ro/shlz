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
  <script>
    var section = "<?= $section; ?>";
    var msg = "<?= $msg; ?>";
    

    if (section == "admin_inventario")
      document.getElementById("inventario").classList.add("active");
    else if (section == "admin_registro_empleado")
      document.getElementById("navbarDropdown").classList.add("active");
    else if (section == "admin_registro_producto")
      document.getElementById("navbarDropdown").classList.add("active");
    else if (section == "admin_ventas")
      document.getElementById("ventas").classList.add("active");

      if(msg!="null")
            swal("INFO", msg, "info").then(function(val){
                history.pushState(null,"","?");
            });
  </script>

</head>