<?php

$servidor="localhost";
$usuario="root";
$password="";
$base="shaliz";

// variable para la conexion
$conn=mysqli_connect($servidor,$usuario,$password,$base);

// probar conexion
if(!$conn)
{
    die("Error en la conexion".mysqli_connect_error());
}
echo "Conexion realizada correctamente";

?>