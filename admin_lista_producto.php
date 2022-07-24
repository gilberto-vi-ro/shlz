<?php 
 // require "db/connDb.php";
// Prepara SELECT
  $miConsulta = $miPDO->prepare('SELECT * FROM producto;');
// Ejecuta consulta
   $miConsulta->execute();
?>


<form>
                    <div class="row p-3 mb-2 bg-white text-white">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class ="table" style="background:white">
                        <thead>
                            <th scope ="col">Codigo</th>
                            <th scope ="col">Nombre producto</th>
                            <th scope ="col">Precio</th>
                            <th scope ="col">cantidad</th>
                        </thead>
                        <tbody>
    <?php foreach ($miConsulta as $clave => $valor): ?> 
    <tr>
       <td><?= $valor['cod_producto']; ?></td>
       <td><?= $valor['nombre']; ?></td>
       <td><?= $valor['precio']; ?></td>
       <td><?= $valor['stock']; ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
                    </table>
                    
                    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"> </script>-->
    </form>   
    