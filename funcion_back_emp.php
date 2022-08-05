<?php

   

    function agregarAlCarrito(){
        if (!isset($_POST["codigo"])) {
            return;
        }

        $codigo = $_POST["codigo"];
        $sentencia = connDB()->prepare("SELECT * FROM producto WHERE cod_producto = ? LIMIT 1;");
        $sentencia->execute([$codigo]);
        $producto = $sentencia->fetch(PDO::FETCH_OBJ);
        # Si no existe, salimos y lo indicamos
        if (!$producto) {
            header("Location:?status=4");
            exit;
        }
        # Si no hay existencia...
        if ($producto->stock < 1) {
            header("Location:?status=5");
            exit;
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
                header("Location: ?status=5");
                exit;
            }

            $_SESSION["carrito"][$indice]->cantidad = $_SESSION["carrito"][$indice]->cantidad + 1 ;
            $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        }
        header("Location: ?");
    }

    function cambiarCantidad(){
        if (!isset($_POST["cantidad"])) {
            exit("No hay cantidad");
        }
        if (!isset($_POST["indice"])) {
            exit("No hay índice");
        }
        $cantidad = floatval($_POST["cantidad"]);
        $indice = intval($_POST["indice"]);
        
        if ($cantidad > $_SESSION["carrito"][$indice]->stock) {
            header("Location: ?status=5");
            exit;
        }
        $_SESSION["carrito"][$indice]->cantidad = $cantidad;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
        header("Location: ?");
    }

    function quitarDelCarrito(){
        if (!isset($_GET["indice"])) return;
        $indice = $_GET["indice"];
        array_splice($_SESSION["carrito"], $indice, 1);
        header("Location: ?status=3");
    }

function cancelarVenta()
{
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];
    header("?status=2");
}
function terminarVenta()
{
    if (!isset($_POST["total"]) || $_POST["total"] == 0) return;

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
        header("Location: ?status=1");
    }catch(PDOException $e)  {
        echo $e->getMessage();
        exit();
    }
    
}

function listarVentas(){

    //listar inventario
    $miConsulta = connDB()->prepare("SELECT * FROM ventas");
    $miConsulta->execute();// Ejecutar consulta
    return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ);// Obtener en obejto los datos de la BD
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