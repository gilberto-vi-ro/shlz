<?php

   

    function agregarAlCarrito(){
        if (!isset($_POST["codigo"])) { // sino existe el metodo post con el indice codigo
            return "No se recibio el codigo."; // devolver el mensaje
        }

        $codigo = $_POST["codigo"];
        $clasePDO = connDB()->prepare("SELECT * FROM producto WHERE cod_producto = ? LIMIT 1;");//prepara la consulta sql
        $clasePDO->execute([$codigo]); //ejecuta y asigna los parametros a la consulta sql
        $producto = $clasePDO->fetch(PDO::FETCH_OBJ);// obtiene los datos de la bd en objeto
        # Si no existe, salimos y lo indicamos
        if (!$producto) {
            //header("Location:?status=4");
            return "El codigo no existe en la BD.";// devolver el mensaje
        }
        # Si no hay existencia...
        if ($producto->stock < 1) {
            //header("Location:?status=5");
            return "El producto se ha agotado.";// devolver el mensaje
        }
        
        # Buscar producto dentro del cartito
        $indice = false;
        for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {// ciclo or para dar vuelta a la sesion carrito
           
            if ($_SESSION["carrito"][$i]->cod_producto == $codigo) {
                $indice = $i;
                break; // rompe elciclo for
            }
        }

    
        # Si el producto no existe en la sesion carrito, lo agregamos como nuevo
        if ($indice === false) {
            $producto->cantidad = 1;
            $producto->total = $producto->precio;
            array_push($_SESSION["carrito"], $producto); // agrega un nuevo producto a  la sesion carrito
        } else {//sino
            # Si ya existe, se agrega la cantidad Pero espera, tal vez ya no haya
            $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
            
            if ($cantidadExistente + 1 > $producto->stock) { # si al sumarle uno supera lo que existe, no se agrega
                //header("Location: ?status=5");
                return "El producto se ha agotado."; // devolver el mensaje
            }

            $_SESSION["carrito"][$indice]->cantidad = $_SESSION["carrito"][$indice]->cantidad + 1 ;
            $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        }
        header("Location: ?"); //redireccionar en la misma pagina
    }

    function cambiarCantidad(){
        if (!isset($_POST["cantidad"])) { // sino existe el metodo post con el indice cantidad
            return "No hay cantidad."; // devolver el mensaje
        }
        if (!isset($_POST["indice"])) {// sino existe el metodo post con el indice indice
            return "No hay índice."; // devolver el mensaje
        }
        $cantidad = floatval($_POST["cantidad"]);// Esta funcion convierte una cadena en un flotante sin importar el punto separador decimal
        $indice = intval($_POST["indice"]); // intval convierte dobles en enteros truncando el componente fraccionario del numero
        
        if ($cantidad > $_SESSION["carrito"][$indice]->stock) {// si la cantidad es mayor a la que hay en la sesion carrrito del producto
            //header("Location: ?status=5");
            return "El producto se ha agotado."; // devolver el mensaje
        }
        $_SESSION["carrito"][$indice]->cantidad = $cantidad;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        header("Location: ?");  //redireccionar en la misma pagina
    }

    function quitarDelCarrito(){
        if (!isset($_GET["indice"])) return; // sino existe el metodo get con el indice indice terminar la funcion
        $indice = $_GET["indice"];
        array_splice($_SESSION["carrito"], $indice, 1); //esta funcion elimina los elementos seleccionados de una matriz y los reemplaza con elementos nuevos.
        //header("Location: ?status=3");
        return "Se elimino de la venta."; // devolver el mensaje
    }

function cancelarVenta()
{
    unset($_SESSION["carrito"]);//esta funcion de php quita la sesion con el indice carrito
    $_SESSION["carrito"] = [];
    //header("?status=2");
    return "Se cancelo la venta."; // devolver el mensaje
}
function terminarVenta()
{
    // sino existe el metodo post con el indice total o total = 0
    if (!isset($_POST["total"]) || $_POST["total"] == 0) 
        return "Ha ocurrido un error al terninar la venta";// devolver el mensaje

    try{
        $total = $_POST["total"]; // variable que guarda el total de la venta
        $ahora = date("Y-m-d H:i:s"); // varible que guarda la fecha y hora de este momento
        $dni = $_SESSION["id_empleado"];// variable que gurada el id del empleado

        

        $clasePDO = connDB()->prepare("INSERT INTO `ventas` (`total`, `fecha_venta`, `dni`) VALUES (?, ?, ?);");//prepara la consulta sql
        $clasePDO->execute([$total, $ahora, $dni]);//ejecuta y asigna los parametros a la consulta sql

        $clasePDO = connDB()->prepare("SELECT id_venta FROM ventas ORDER BY id_venta DESC LIMIT 1;");//prepara la consulta sql
        $clasePDO->execute();//ejecuta la consulta sql
        $resultado = $clasePDO->fetch(PDO::FETCH_OBJ);//obtine datos de la bd en objeto
        
        $idVenta = $resultado === false ? 1 : $resultado->id_venta;

        //connDB()->beginTransaction();
        $query = connDB()->prepare("INSERT INTO productos_vendidos (cod_producto, id_venta, cantidad, total) VALUES (?, ?, ?, ?);");//prepara la consulta sql
        $queryStock = connDB()->prepare("UPDATE producto SET stock = stock - ? WHERE cod_producto= ?;");//prepara la consulta sql
        
        foreach ($_SESSION["carrito"] as $producto) {//foreach es usado para recorrer el array de principio a fin
        
                $total += $producto->total;
                $query->execute([$producto->cod_producto, $idVenta, $producto->cantidad, $producto->total ]);//ejecuta y asigna los parametros a la consulta sql
                $queryStock->execute([$producto->cantidad, $producto->cod_producto]);//ejecuta y asigna los parametros a la consulta sql
        }
    
        //connDB()->commit();

        unset($_SESSION["carrito"]);//esta funcion de php quita la sesion con el indice carrito
        $_SESSION["carrito"] = [];
        //header("Location: ?status=1");
        return "Se termino la venta Correctamente.";// devolver el mensaje

    }catch(PDOException $e)  { // captura el mensaje de error en caso de un error en la consulta PDO
        echo $e->getMessage();
        exit();
    }
    
}

function listarVentas()
{
   try{
        $ahora = date("Y-m-d");// varible que guarda la fecha de este momento
        if (isset($_POST['buscar']) && $_POST['buscar'] != "") { // si existe el metodo post con el indice buscar y buscar es diferente de vacio
            $miConsulta = connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
                INNER JOIN empleado
                ON ventas.dni = empleado.id
                WHERE ventas.id_venta = ? OR ventas.dni = ? OR empleado.nombre like ? OR empleado.apellido like ? AND ventas.fecha_venta = ? order by id_venta desc");
                    $miConsulta->execute([$_POST['buscar'], $_POST['buscar'], "%".$_POST['buscar']."%", "%".$_POST['buscar']."%", $ahora]);
        } else {
            $miConsulta = connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
                INNER JOIN empleado
                ON ventas.dni = empleado.id AND ventas.fecha_venta = ?  order by id_venta desc");
            $miConsulta->execute([$ahora]); //ejecuta y asigna los parametros a la consulta sql
        }
        // Ejecutar consulta
        return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ);// Obtener en obejto los datos de la BD

   } catch(PDOException $e)  { // captura el mensaje de error en caso de un error en la consulta PDO
        echo $e->getMessage();
        exit();
    }
    
}

function verVenta(){// lista los productos vendidos de una venta

    $miConsulta = connDB()->prepare("SELECT * FROM productos_vendidos
	        INNER JOIN producto ON productos_vendidos.cod_producto = producto.cod_producto
            where id_venta = ?");//prepara la consulta sql
    $miConsulta->execute([$_GET["id"]]);// Ejecutar consulta sql
    return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ);// Obtener en obejto los datos de la BD
}



?>