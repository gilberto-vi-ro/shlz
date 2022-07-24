<?php

   function listarProductos(){
        //listar inventario
        $miConsulta = connDB()->prepare("SELECT * FROM producto");
        $miConsulta->execute();// Ejecutar consulta
        return $data = $miConsulta->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
    }

  function registroProducto()
  {
    $cod = $_POST["codigo_prod"];
    $nombre = $_POST["nombre_prod"];
    $precio = $_POST["precio_prod"];
    $cantidad = $_POST["cantidad_prod"];
    $pathImg = "null";
    $insertar = "INSERT INTO producto(`cod_producto`,`nombre`,`precio`,`stock`,`img`) value ('$cod','$nombre','$precio','$cantidad','$pathImg');";
     try{
         $miConsulta = connDB()->prepare($insertar); // preparar la consulta
         $miConsulta->execute(); // Ejecuta consulta
         if($miConsulta->rowCount()>0) //contar los registros afectados en la BD
             return $msg = "Producto registrado Correctamente";
         else
             return $msg = "Ocurrio un error al registrar producto";
     }catch(PDOException $e){
         //echo $e->getMessage(); //para ver el error
         return $msg = $e->getMessage();
     }
  }

  function eliminarProducto(){
    $miConsulta = connDB()->prepare("DELETE FROM producto WHERE cod_producto= '{$_GET["codigo"]}' ");
    $miConsulta->execute();// Ejecutar consulta
    if($miConsulta->rowCount()>0)
        return $msg = "Producto Eliminado correctamente";
    else
        return $msg = "Ocurrio un Error al eliminar el producto";
  }

  function obtenerDatosParaEditarProducto(){
    $miConsulta = connDB()->prepare("SELECT * FROM producto WHERE cod_producto = '{$_GET["codigo"]}' ");
    $miConsulta->execute();// Ejecutar consulta
    return $miConsulta->fetch(PDO::FETCH_ASSOC);//devolver los datos en array
  }
  function editarProductoDelForm(){
    $sql = " UPDATE producto SET nombre='".$_POST["nombre_prod"]."' ,
        precio = '".$_POST["precio_prod"]."', stock='".$_POST["cantidad_prod"]."' 
        WHERE cod_producto='".$_POST["codigo_prod"]."' 
        ";
    $miConsulta = connDB()->prepare($sql);
    $miConsulta->execute();// Ejecutar consulta
    if($miConsulta->rowCount()>0)//contamos las filas afectadas
        return $msg = "Producto actualizado correctamente";
    else
        return $msg = "Ocurrio un Error al actualizar";
  }

  function buscarProducto(){
        $miConsulta = connDB()->prepare("SELECT * FROM producto WHERE 
                    cod_producto like '%".$_POST["buscar"]."%' OR nombre like '%".$_POST["buscar"]."%' ");
        $miConsulta->execute();// Ejecutar consulta
        return $data = $miConsulta->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
  }

  //////////////////////////////////////////////////////////////////////////////
  function registrarEmpleado(){
    $nombre_emp = $_POST["nombre_emp"];
    $apellido_emp = $_POST["apellido_emp"];
    $telefono_emp = $_POST["telefono_emp"];
    $direccion_emp = $_POST["direccion_emp"];
    $rfc_emp = $_POST["rfc_emp"];
    $usuario_emp = $_POST["usuario_emp"];
    $contrasena_emp = $_POST["contrasena_emp"];


    $insertar = "INSERT INTO empleado (`nombre`, `apellido`, `telefono`, `direccion`, `rfc`, `usuario`, `contrasena`, `id_admin`)
             VALUES ( '$nombre_emp', '$apellido_emp', '$telefono_emp', '$direccion_emp', '$rfc_emp', '$usuario_emp', '$contrasena_emp', '".$_SESSION["id_admin"]."');
            ;";
     try{
         $miConsulta = connDB()->prepare($insertar); // preparar la consulta
         $miConsulta->execute(); // Ejecuta consulta
         if($miConsulta->rowCount()>0) //contar los registros afectados en la BD
            return $msg = "Empleado registrado correctamente";
         else
            return $msg = "Ocurrio un error al registrar el empleado";
     }catch(PDOException $e){ //para ver el error de la BD
         // echo $e->getMessage(); 
         // exit;
         return $msg = $e->getMessage();
     }
  }

  function listarEmpleados(){
    //listar inventario
    $miConsulta = connDB()->prepare("SELECT * FROM empleado");
    $miConsulta->execute();// Ejecutar consulta
    return $data = $miConsulta->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
}

function eliminarEmpleado(){
    $miConsulta = connDB()->prepare("DELETE FROM empleado WHERE id= '{$_GET["id"]}' ");
    $miConsulta->execute();// Ejecutar consulta
    if($miConsulta->rowCount()>0)
        return $msg = "Eliminado correctamente";
    else
        return $msg = "Ocurrio un Error al eliminar";
  }

  function obtenerDatosParaEditarEmpleado(){
    $miConsulta = connDB()->prepare("SELECT * FROM empleado WHERE id = '{$_GET["id"]}' ");
    $miConsulta->execute();// Ejecutar consulta
    return $miConsulta->fetch(PDO::FETCH_ASSOC);//devolver los datos en array
  }


  
  function editarEmpleadoDelForm(){
    
    $sql = " UPDATE empleado SET nombre='{$_POST["nombre_emp"]}', apellido='{$_POST["apellido_emp"]}',
     telefono='{$_POST["telefono_emp"]}', direccion='{$_POST["direccion_emp"]}', rfc='{$_POST["rfc_emp"]}',
     usuario='{$_POST["usuario_emp"]}', contrasena='{$_POST["contrasena_emp"]}' WHERE  `id`= '{$_POST["id_empleado"]}';
        ";
    $miConsulta = connDB()->prepare($sql);
    $miConsulta->execute();// Ejecutar consulta
    if($miConsulta->rowCount()>0)//contamos las filas afectadas
        return $msg = "Empleado actualizado correctamente";
    else
        return $msg = "Ocurrio un Error al actualizar";
  }

?>