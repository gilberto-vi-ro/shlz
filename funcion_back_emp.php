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
    if (!isset($_POST["total"])) exit;

    $cantidad = "";
    $total = $_POST["total"];
    $ahora = date("Y-m-d H:i:s");
    $cod_producto = "";
    $dni = $_SESSION["id_empleado"];


    $sentencia = connDB()->prepare("INSERT INTO `venta` (`cantidad`, `total`, `fecha_venta`, `cod_producto`, `dni`) VALUES (?, ?, ?, ?, ?);");
    $sentencia->execute([$cantidad, $total, $ahora, $cod_producto, $dni]);

    $sentencia = connDB()->prepare("SELECT id FROM venta ORDER BY id DESC LIMIT 1;");
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

    $idVenta = $resultado === false ? 1 : $resultado->id;

    connDB()->beginTransaction();
    $sentencia = connDB()->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
    $sentenciaExistencia = connDB()->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");
    foreach ($_SESSION["carrito"] as $producto) {
        $total += $producto->total;
        $sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
        $sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
    }
    connDB()->commit();
    unset($_SESSION["carrito"]);
    $_SESSION["carrito"] = [];
    header("Location: ./vender.php?status=1");
}



?>