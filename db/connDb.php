<?php 
   function  connDB(){
      $hostDB = DB_HOST;
      $nombreDB = DB_NAME;
      $usuarioDB = DB_USER;
      $contraseniaDB = DB_PWD;
      // Conecta con base de datos
      $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
      $miPDO = new PDO($hostPDO, $usuarioDB, $contraseniaDB);
      return  $miPDO ;
   }
   

?>