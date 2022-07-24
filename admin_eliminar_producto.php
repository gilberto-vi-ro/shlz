<?php
include_once "conexion.php";

$cod_producto = $_GET["codigo"];

$sql="DELETE FROM producto WHERE cod_producto = '$cod_producto'";

if (mysqli_query($conn,$sql)){
    
    header("location:admin_inventario.php");

  
}else {
    echo "error al tratar de eliminar un producto:" . mysqli_error($conn);
}

mysqli_close($conn);

?>