<?php

   function listarProductos(){
        //listar inventario
        $clasePDO= connDB()->prepare("SELECT * FROM producto");
        $clasePDO->execute();// Ejecutar consulta
        return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
    }

  function registroProducto()
  {
    
    $pathImg = "null";
    $insertar = "INSERT INTO producto(`cod_producto`,`nombre`,`precio`,`stock`,`img`) value (?,?,?,?,?);";
     try{
         $clasePDO= connDB()->prepare($insertar); // preparar la consulta
         $clasePDO->execute([$_POST["codigo_prod"],$_POST["nombre_prod"],$_POST["precio_prod"],$_POST["cantidad_prod"],$pathImg]); // Ejecuta consulta
         if($clasePDO->rowCount()>0) //contar los registros afectados en la BD
             return $msg = "Producto registrado Correctamente";
         else
             return $msg = "Ocurrio un error al registrar producto";
     }catch(PDOException $e){
         //echo $e->getMessage(); //para ver el error
         return $msg = $e->getMessage();
     }
  }

  function eliminarProducto(){
    $clasePDO= connDB()->prepare("DELETE FROM producto WHERE cod_producto= ? ");
    $clasePDO->execute([$_GET["codigo"]]);// Ejecutar consulta
    if($clasePDO->rowCount()>0)
        return $msg = "Producto Eliminado correctamente";
    else
        return $msg = "Ocurrio un Error al eliminar el producto";
  }

  function obtenerDatosParaEditarProducto(){
    $clasePDO= connDB()->prepare("SELECT * FROM producto WHERE cod_producto = ?");
    $clasePDO->execute([$_GET["codigo"]]);// Ejecutar consulta
    return $clasePDO->fetch(PDO::FETCH_ASSOC);//devolver los datos en array
  }
  function editarProductoDelForm(){
    $sql = "UPDATE producto SET nombre= ?, precio = ?, stock= ? WHERE cod_producto=?  ";
    $clasePDO = connDB()->prepare($sql);
    $clasePDO->execute([$_POST["nombre_prod"],$_POST["precio_prod"],$_POST["cantidad_prod"],$_POST["codigo_prod"]]);// Ejecutar consulta
    if($clasePDO->rowCount()>0)//contamos las filas afectadas
        return $msg = "Producto actualizado correctamente";
    else
        return $msg = "Ocurrio un Error al actualizar";
  }

  function buscarProducto(){
        $clasePDO = connDB()->prepare("SELECT * FROM producto WHERE cod_producto like ? OR nombre like ? ");
        $clasePDO->execute(['%'.$_POST["buscar"].'%', '%'.$_POST["buscar"].'%']);// Ejecutar consulta
        return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
  }

  //////////////////////////////////////////////////////////////////////////////
  function registrarEmpleado(){
    

    $insertar = "INSERT INTO empleado (`nombre`, `apellido`, `telefono`, `direccion`, `rfc`, `usuario`, `contrasena`, `id_admin`)
             VALUES ( ?, ?, ?, ?, ?, ?, ?, ?);
            ;";
     try{
         $clasePDO = connDB()->prepare($insertar); // preparar la consulta
         $clasePDO->execute([$_POST["nombre_emp"],$_POST["apellido_emp"],$_POST["telefono_emp"],$_POST["direccion_emp"],$_POST["rfc_emp"],$_POST["usuario_emp"],$_POST["contrasena_emp"],$_SESSION["id_admin"]]); // Ejecuta consulta
         if($clasePDO->rowCount()>0) //contar los registros afectados en la BD
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
    $clasePDO = connDB()->prepare("SELECT * FROM empleado");
    $clasePDO->execute();// Ejecutar consulta
    return $data = $clasePDO->fetchAll(PDO::FETCH_ASSOC);// Obtener en array los datos de la BD
}

function eliminarEmpleado(){
    $clasePDO = connDB()->prepare("DELETE FROM empleado WHERE id= ? ");
    $clasePDO->execute([$_GET["id"]]);// Ejecutar consulta
    if($clasePDO->rowCount()>0)
        return $msg = "Eliminado correctamente";
    else
        return $msg = "Ocurrio un Error al eliminar";
  }

  function obtenerDatosParaEditarEmpleado(){
    $clasePDO = connDB()->prepare("SELECT * FROM empleado WHERE id = ? ");
    $clasePDO->execute([$_GET["id"]]);// Ejecutar consulta
    return $clasePDO->fetch(PDO::FETCH_ASSOC);//devolver los datos en array
  }


  
  function editarEmpleadoDelForm(){
    
    $sql = "UPDATE empleado SET nombre=?, apellido=?, telefono=?, direccion=?, rfc=?, usuario=?, contrasena=? WHERE  id = ?; ";
    $clasePDO = connDB()->prepare($sql);
    $clasePDO->execute([$_POST["nombre_emp"],$_POST["apellido_emp"],$_POST["telefono_emp"],$_POST["direccion_emp"],$_POST["rfc_emp"],$_POST["usuario_emp"],$_POST["contrasena_emp"],$_POST["id_empleado"]]);// Ejecutar consulta
    if($clasePDO->rowCount()>0)//contamos las filas afectadas
        return $msg = "Empleado actualizado correctamente";
    else
        return $msg = "Ocurrio un Error al actualizar";
  }

function listarVentas()
{

    try {
        $ahora = date("Y-m-d");

        $fechaInicio = $ahora;
        $fechaFin = $ahora;

        if (isset($_GET["date_range1"]) && isset($_GET["date_range2"])){
            $fechaInicio = $_GET["date_range1"];
            $fechaFin = $_GET["date_range2"];
        }
    
        
        //listar inventario
        if (isset($_POST['buscar']) && $_POST['buscar'] != "") {
            $clasePDO= connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
	    INNER JOIN empleado
	    ON ventas.dni = empleado.id
        WHERE ventas.id_venta = ? OR ventas.dni = ? OR empleado.nombre like ? OR empleado.apellido like ?
        AND ventas.fecha_venta >= ? AND ventas.fecha_venta <= ?
         order by id_venta desc");
            $clasePDO->execute([$_POST['buscar'], $_POST['buscar'], "%".$_POST['buscar']."%", "%".$_POST['buscar']."%", $fechaInicio,$fechaFin]);
        } else {
            $clasePDO= connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
	    INNER JOIN empleado
	    ON ventas.dni = empleado.id  
        WHERE ventas.fecha_venta >= ? AND ventas.fecha_venta <= ?
        order by id_venta desc");
            $clasePDO->execute([$fechaInicio, $fechaFin]);
        }
        // Ejecutar consulta
        return $data = $clasePDO->fetchAll(PDO::FETCH_OBJ); // Obtener en obejto los datos de la BD

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}


function verVenta()
{

    //listar inventario
    $clasePDO = connDB()->prepare("SELECT * FROM productos_vendidos
	        INNER JOIN producto ON productos_vendidos.cod_producto = producto.cod_producto
            where id_venta = ?");
    $clasePDO->execute([$_GET["id"]]); // Ejecutar consulta
    return $data = $clasePDO->fetchAll(PDO::FETCH_OBJ); // Obtener en obejto los datos de la BD
}



?>