<?php 
   function  connDB(){
     
	  //PDO es una clase de php para conexiones a base de datos
      // Conecta con base de datos
      /* Configurar conexion*/
			$dsn = ''.SGDB.':host='.DB_HOST.";port=".DB_PORT.';dbname='.DB_NAME; 
			$option = array(
				PDO::ATTR_PERSISTENT=>true, 
				PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
			);
			/* Crear una instancia de PDO*/
			try {
				$dbh = new PDO($dsn, DB_USER, DB_PWD, $option);
				$dbh->exec(DB_CHARSET);
			} catch (PDOException $e) {
					echo $e->getMessage(); 
				exit();
			}
			return $dbh;
   }
   

?>