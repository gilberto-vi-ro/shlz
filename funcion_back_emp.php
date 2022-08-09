<?php

   

    function agregarAlCarrito(){
        if (!isset($_POST["codigo"])) {
            return "No se recibio el codigo.";
        }

        $codigo = $_POST["codigo"];
        $sentencia = connDB()->prepare("SELECT * FROM producto WHERE cod_producto = ? LIMIT 1;");
        $sentencia->execute([$codigo]);
        $producto = $sentencia->fetch(PDO::FETCH_OBJ);
        # Si no existe, salimos y lo indicamos
        if (!$producto) {
            //header("Location:?status=4");
            return "El codigo no existe en la BD.";
        }
        # Si no hay existencia...
        if ($producto->stock < 1) {
            //header("Location:?status=5");
            return "El producto se ha agotado.";
        }
        
        # Buscar producto dentro del cartito
        $indice = false;
        for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
           
            if ($_SESSION["carrito"][$i]->cod_producto == $codigo) {
                $indice = $i;
                break;
            }
        }

    
        # Si no existe, lo agregamos como nuevo
        if ($indice === false) {
            $producto->cantidad = 1;
            $producto->total = $producto->precio;
            array_push($_SESSION["carrito"], $producto);
        } else {
            # Si ya existe, se agrega la cantidad
            # Pero espera, tal vez ya no haya
            $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
            # si al sumarle uno supera lo que existe, no se agrega
            if ($cantidadExistente + 1 > $producto->stock) {
                //header("Location: ?status=5");
                return "El producto se ha agotado.";
            }

            $_SESSION["carrito"][$indice]->cantidad = $_SESSION["carrito"][$indice]->cantidad + 1 ;
            $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        }
        header("Location: ?");
    }

    function cambiarCantidad(){
        if (!isset($_POST["cantidad"])) {
            return "No hay cantidad.";
        }
        if (!isset($_POST["indice"])) {
            return "No hay índice.";
        }
        $cantidad = floatval($_POST["cantidad"]);
        $indice = intval($_POST["indice"]);
        
        if ($cantidad > $_SESSION["carrito"][$indice]->stock) {
            //header("Location: ?status=5");
            return "El producto se ha agotado.";
        }
        $_SESSION["carrito"][$indice]->cantidad = $cantidad;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        header("Location: ?");
    }

    function quitarDelCarrito(){
        if (!isset($_GET["indice"])) return;
        $indice = $_GET["indice"];
        array_splice($_SESSION["carrito"], $indice, 1);
        //header("Location: ?status=3");
        return "Se elimino de la venta.";
    }

function cancelarVenta()
{
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];
    //header("?status=2");
    return "Se cancelo la venta.";
}
function terminarVenta()
{
    if (!isset($_POST["total"]) || $_POST["total"] == 0) return "Ha ocurrido un error al terninar la venta";

    try{
        $total = $_POST["total"];
        $ahora = date("Y-m-d H:i:s");
        $dni = $_SESSION["id_empleado"];


        $sentencia = connDB()->prepare("INSERT INTO `ventas` (`total`, `fecha_venta`, `dni`) VALUES (?, ?, ?);");
        $sentencia->execute([$total, $ahora, $dni]);

        $sentencia = connDB()->prepare("SELECT id_venta FROM ventas ORDER BY id_venta DESC LIMIT 1;");
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        
        $idVenta = $resultado === false ? 1 : $resultado->id_venta;

        //connDB()->beginTransaction();
        $query = connDB()->prepare("INSERT INTO productos_vendidos (cod_producto, id_venta, cantidad, total) VALUES (?, ?, ?, ?);");
        $queryStock = connDB()->prepare("UPDATE producto SET stock = stock - ? WHERE cod_producto= ?;");
        
        foreach ($_SESSION["carrito"] as $producto) {
        
                $total += $producto->total;
                $query->execute([$producto->cod_producto, $idVenta, $producto->cantidad, $producto->total ]);
                $queryStock->execute([$producto->cantidad, $producto->cod_producto]);
        }
    
        //connDB()->commit();

        unset($_SESSION["carrito"]);
        $_SESSION["carrito"] = [];
        //header("Location: ?status=1");
        return "Se termino la venta Correctamente.";

    }catch(PDOException $e)  {
        echo $e->getMessage();
        exit();
    }
    
}

function listarVentas(){

   try{
        $ahora = date("Y-m-d");
        //listar inventario
        if (isset($_POST['buscar']) && $_POST['buscar'] != "") {
            $miConsulta = connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
	    INNER JOIN empleado
	    ON ventas.dni = empleado.id
        WHERE ventas.id_venta = ? OR ventas.dni = ? OR empleado.nombre like ? OR empleado.apellido like ? AND ventas.fecha_venta = ? order by id_venta desc");
            $miConsulta->execute([$_POST['buscar'], $_POST['buscar'], "%".$_POST['buscar']."%", "%".$_POST['buscar']."%", $ahora]);
        } else {
            $miConsulta = connDB()->prepare("SELECT id_venta, total, fecha_venta, dni, CONCAT(empleado.nombre,' ', empleado.apellido) AS nombre_completo FROM ventas
	    INNER JOIN empleado
	    ON ventas.dni = empleado.id AND ventas.fecha_venta = ?  order by id_venta desc");
            $miConsulta->execute([$ahora]);
        }
        // Ejecutar consulta
        return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ);// Obtener en obejto los datos de la BD

   } catch(PDOException $e)  {
        echo $e->getMessage();
        exit();
    }
    
}

function verVenta(){

    //listar inventario
    $miConsulta = connDB()->prepare("SELECT * FROM productos_vendidos
	        INNER JOIN producto ON productos_vendidos.cod_producto = producto.cod_producto
            where id_venta = ?");
    $miConsulta->execute([$_GET["id"]]);// Ejecutar consulta
    return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ);// Obtener en obejto los datos de la BD
}



?>