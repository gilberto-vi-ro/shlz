<?php
  require_once "config.php";
  require "db/connDb.php";


  $cod = $_POST["codigo_prod"];
   $nombre = $_POST["nombre_prod"];
   $precio = $_POST["precio_prod"];
   $cantidad = $_POST["cantidad_prod"];
   $pathImg = "null";


 $insertar = "INSERT INTO producto(`cod_producto`,`nombre`,`precio`,`stock`,`img`) value ('$cod','$nombre','$precio','$cantidad','$pathImg');";
    
  $miConsulta = connDB()->prepare($insertar);
 // Ejecuta consulta
 $miConsulta->execute();

    header('Location:admin_registro_producto.php');

    function moveFile ($moveFilePath) 
     {   
         if (!is_dir($moveFilePath))
             @mkdir($moveFilePath, 0777, true);
         #========================= validate if exist img ========================
         foreach ($_FILES as $keys_name)
         {
            $filename = $keys_name["name"];
            $filetype = $keys_name["type"];
            $source = $keys_name["tmp_name"];
            $n = $keys_name["error"];
            if (!is_uploaded_file($source))
                return "error: ".$n; 
            if (!copy($source, $moveFilePath.$filename))
                return "null"; 
         }
         #================================ end img ================================
         return $moveFilePath.$filename; 
     } 

?>