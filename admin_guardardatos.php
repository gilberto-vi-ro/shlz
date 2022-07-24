<?php
include_once "conexion.php";

$cod_producto = $_GET["codigo"];
$nombre = $_GET["nombre"];
$precio = $_GET["precio"];
$stock = $_GET["stock"];

$sql="UPDATE `producto` SET `cod_producto`=?,`nombre`=?,`precio`=?,`stock`=?,`img`='null' WHERE 1'";

if (mysqli_query($conn,$sql)){
    
    header("location:admin_inventario.php");

  
}else {
    echo "error al tratar de eliminar un producto:" . mysqli_error($conn);
}

mysqli_close($conn);

?>