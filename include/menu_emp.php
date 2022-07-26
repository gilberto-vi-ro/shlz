<head>

  <meta charset="utf 8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="img/Logo.jpeg">

  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/administrador.css">
  <link rel="stylesheet" href="css/empleado.css">
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
              <a id="emp_vender" class="nav-link" aria-current="page" href="emp_vender.php">Vender</a>
            </li>
            <li class="nav-item">
              <a id="emp_ventas" class="nav-link" aria-current="page" href="emp_ventas.php">Ventas</a>
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
    var msg = "<?= $msg; ?>"; //variable que obtine el valor de la variable de php $msg

    if (section == "emp_vender") //si la seccion o pagina es = a emp_vender
      document.getElementById("emp_vender").classList.add("active");// busca el id en html y le agrega una clase css
    else if (section == "emp_ventas") //sino, entonces la seccion o pagina es = a emp_ventas
      document.getElementById("emp_ventas").classList.add("active");// busca el id en html y le agrega una clase css

    if(msg!="null"){ // si y solo si la variable msg es diferente de null
      swal("INFO", msg, "info")// mensaje de cuadro del dialogo 
      .then(function(val){// se ejecuta al cerrar el cuadro del dialogo
          history.pushState(null,"","?"); //quita el get de la url
      });
    }
      
  </script>

</head>