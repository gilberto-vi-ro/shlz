<?php

   function listarProductos(){
        $clasePDO= connDB()->prepare("SELECT * FROM producto"); //prepara la consulta sql
        $clasePDO->execute();// Ejecuta la consulta sql
        return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
    }

  function registroProducto()
  {
    
    $pathImg = "null";
    $insertar = "INSERT INTO producto(`cod_producto`,`nombre`,`precio`,`stock`,`img`) value (?,?,?,?,?);"; 
     try{
         $clasePDO= connDB()->prepare($insertar); //prepara la consulta sql
         $clasePDO->execute([$_POST["codigo_prod"],$_POST["nombre_prod"],$_POST["precio_prod"],$_POST["cantidad_prod"],$pathImg]);//ejecuta y asigna los parametros a la consulta sql
         if($clasePDO->rowCount()>0) //contar los registros afectados en la BD
             return $msg = "Producto registrado Correctamente"; // devolver el mensaje
         else // sino hay registros o filas afectadas en la bd
             return $msg = "Ocurrio un error al registrar producto";// devolver el mensaje
     }catch(PDOException $e){// captura el mensaje de error en caso de un error en la consulta PDO
         return $msg = $e->getMessage();
     }
  }

  function eliminarProducto(){
    $clasePDO= connDB()->prepare("DELETE FROM producto WHERE cod_producto= ? "); //prepara la consulta sql
    $clasePDO->execute([$_GET["codigo"]]);//ejecuta y asigna los parametros a la consulta sql
    if($clasePDO->rowCount()>0)  //contar los registros afectados en la BD
        return $msg = "Producto Eliminado correctamente"; // devolver el mensaje
    else // sino hay registros o filas afectadas en la bd
        return $msg = "Ocurrio un Error al eliminar el producto"; // devolver el mensaje
  }

  function obtenerDatosParaEditarProducto(){
    $clasePDO= connDB()->prepare("SELECT * FROM producto WHERE cod_producto = ?"); //prepara la consulta sql
    $clasePDO->execute([$_GET["codigo"]]);//ejecuta y asigna los parametros a la consulta sql
    return $clasePDO->fetch(PDO::FETCH_ASSOC);//devolver los datos de la bd en array
  }
  function editarProductoDelForm(){
    $sql = "UPDATE producto SET nombre= ?, precio = ?, stock= ? WHERE cod_producto=?  ";
    $clasePDO = connDB()->prepare($sql);//prepara la consulta sql
    $clasePDO->execute([$_POST["nombre_prod"],$_POST["precio_prod"],$_POST["cantidad_prod"],$_POST["codigo_prod"]]);//ejecuta y asigna los parametros a la consulta sql
    if($clasePDO->rowCount()>0)//contamos las filas afectadas
        return $msg = "Producto actualizado correctamente";// devolver el mensaje
    else // sino hay registros o filas afectadas en la bd
        return $msg = "Ocurrio un Error al actualizar";// devolver el mensaje
  }

  function buscarProducto(){
        $clasePDO = connDB()->prepare("SELECT * FROM producto WHERE cod_producto like ? OR nombre like ? ");//prepara la consulta sql
        $clasePDO->execute(['%'.$_POST["buscar"].'%', '%'.$_POST["buscar"].'%']);//ejecuta y asigna los parametros a la consulta sql
        return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);//devolver los datos de la bd en array
  }

  //////////////////////////////////////////////////////////////////////////////
  function registrarEmpleado(){
    

    $insertar = "INSERT INTO empleado (`nombre`, `apellido`, `telefono`, `direccion`, `rfc`, `usuario`, `contrasena`, `id_admin`)
             VALUES ( ?, ?, ?, ?, ?, ?, ?, ?);
            ;";
     try{
         $clasePDO = connDB()->prepare($insertar);//prepara la consulta sql
         //ejecuta y asigna los parametros a la consulta sql
         $clasePDO->execute([$_POST["nombre_emp"],$_POST["apellido_emp"],$_POST["telefono_emp"],$_POST["direccion_emp"],$_POST["rfc_emp"],$_POST["usuario_emp"],$_POST["contrasena_emp"],$_SESSION["id_admin"]]); // Ejecuta consulta
         if($clasePDO->rowCount()>0) //contar los registros afectados en la BD
            return $msg = "Empleado registrado correctamente"; // devolver el mensaje
         else  // sino hay registros o filas afectadas en la bd
            return $msg = "Ocurrio un error al registrar el empleado"; // devolver el mensaje
     }catch(PDOException $e){ // captura el mensaje de error en caso de un error en la consulta PDO
         // echo $e->getMessage(); 
         // exit;
         return $msg = $e->getMessage();
     }
  }

  function listarEmpleados(){
    $clasePDO = connDB()->prepare("SELECT * FROM empleado"); //prepara la consulta sql
    $clasePDO->execute();//ejecuta y asigna los parametros a la consulta sql
    return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);//devolver los datos de la bd en array
}

function eliminarEmpleado(){
    $clasePDO = connDB()->prepare("DELETE FROM empleado WHERE id= ? "); //prepara la consulta sql
    $clasePDO->execute([$_GET["id"]]);//ejecuta y asigna los parametros a la consulta sql
    if($clasePDO->rowCount()>0) //contar los registros afectados en la BD
        return $msg = "Eliminado correctamente"; // devolver el mensaje
    else // sino hay registros o filas afectadas en la bd
        return $msg = "Ocurrio un Error al eliminar"; // devolver el mensaje
  }

  function obtenerDatosParaEditarEmpleado(){
    $clasePDO = connDB()->prepare("SELECT * FROM empleado WHERE id = ? "); //prepara la consulta sql
    $clasePDO->execute([$_GET["id"]]);//ejecuta y asigna los parametros a la consulta sql
    return $clasePDO->fetch(PDO::FETCH_ASSOC);//devolver los datos de la bd en array
  }


  
  function editarEmpleadoDelForm(){
    
    $sql = "UPDATE empleado SET nombre=?, apellido=?, telefono=?, direccion=?, rfc=?, usuario=?, contrasena=? WHERE  id = ?; ";
    $clasePDO = connDB()->prepare($sql); //prepara la consulta sql
    $clasePDO->execute([$_POST["nombre_emp"],$_POST["apellido_emp"],$_POST["telefono_emp"],$_POST["direccion_emp"],$_POST["rfc_emp"],$_POST["usuario_emp"],$_POST["contrasena_emp"],$_POST["id_empleado"]]);// Ejecutar consulta
    if($clasePDO->rowCount()>0)//contar los registros afectados en la BD
        return $msg = "Empleado actualizado correctamente"; // devolver el mensaje
    else  // sino
        return $msg = "Ocurrio un Error al actualizar"; // devolver el mensaje
  }

function listarVentas()
{

    try {
        $ahora = date("Y-m-d"); // varible que guarda la fecha de este momento

        $fechaInicio = $ahora; // varible que guarda la fecha de inicio del bucador de fecha
        $fechaFin = $ahora; // varible que guarda la fecha fin del bucador de fecha

        if (isset($_GET["date_range1"]) && isset($_GET["date_range2"])){// si y solo si existe el metodo get con el indice date_range1 y date_range2
            $fechaInicio = $_GET["date_range1"];
            $fechaFin = $_GET["date_range2"];
        }
    
        
        if (isset($_POST['buscar']) && $_POST['buscar'] != "") { // si existe el metodo post con el indice buscar y buscar es diferente de vacio
            //prepara la consulta sql
            $clasePDO= connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
                INNER JOIN empleado
                ON ventas.dni = empleado.id
                WHERE ventas.id_venta = ? OR ventas.dni = ? OR empleado.nombre like ? OR empleado.apellido like ?
                AND ventas.fecha_venta >= ? AND ventas.fecha_venta <= ?
                order by id_venta desc");
            //ejecuta y asigna los parametros a la consulta sql
            $clasePDO->execute([$_POST['buscar'], $_POST['buscar'], "%".$_POST['buscar']."%", "%".$_POST['buscar']."%", $fechaInicio,$fechaFin]);
        } else { // sino
            //prepara la consulta sql
            $clasePDO= connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
                INNER JOIN empleado
                ON ventas.dni = empleado.id  
                WHERE ventas.fecha_venta >= ? AND ventas.fecha_venta <= ?
                order by id_venta desc");
            $clasePDO->execute([$fechaInicio, $fechaFin]); //ejecuta y asigna los parametros a la consulta sql
        }
        // Ejecutar consulta
        return $data = $clasePDO->fetchAll(PDO::FETCH_OBJ); // Obtener en obejto los datos de la BD

    } catch (PDOException $e) { // captura el mensaje de error en caso de un error en la consulta PDO
        echo $e->getMessage();
        exit();
    }
}


function verVenta()
{
    //prepara la consulta sql
    $clasePDO = connDB()->prepare("SELECT * FROM productos_vendidos
	        INNER JOIN producto ON productos_vendidos.cod_producto = producto.cod_producto
            where id_venta = ?");
    $clasePDO->execute([$_GET["id"]]);//ejecuta y asigna los parametros a la consulta sql
    return $data = $clasePDO->fetchAll(PDO::FETCH_OBJ); //devolver los datos de la bd en objeto
}



?>