<?php

    require('pdf/fpdf.php');
    require_once "config.php";   
    require_once "db/connDb.php";

    function verVenta()//funcion para listar los productos vendidos
    {
        $miConsulta = connDB()->prepare("SELECT * FROM productos_vendidos
                INNER JOIN producto ON productos_vendidos.cod_producto = producto.cod_producto
                where id_venta = ?");
        $miConsulta->execute([$_GET["id"]]); // Ejecutar consulta
        return $data = $miConsulta->fetchAll(PDO::FETCH_OBJ); // Obtener en obejto los datos de la BD
    }




class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/Logo.jpeg', 10, 8, 15);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 13);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(60, 10, 'Reporte de Ventas', 'TB', 0, 'C');




        // Salto de línea
        $this->Ln(24);
        //dibujar los contornos de la tabla (encabezado)
        $this->Cell(20,10, "ID Venta",1,0,'c');
        $this->Cell(45,10,utf8_decode("cod_producto"),1,0,'C');
        $this->Cell(40, 10, utf8_decode("cantidad"), 1, 0, 'C');
        $this->Cell(30, 10, utf8_decode("total"), 1, 0, 'C');
        $this->Cell(55, 10, utf8_decode("nombre"), 1, 0, 'C');
        //salto de linea
        // $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
//generar el documento PDF
$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetY(44);
//extraer datos de la tabla de forma automatica
//traer la consulta por GET


foreach (verVenta() as $indice => $venta) { //dar vuelta a todos elementos que contiene verVenta()

    
    $pdf->Cell(20, 10, utf8_decode($venta->id_venta), 1, 0, 'C');
    $pdf->Cell(45, 10, utf8_decode($venta->cod_producto), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($venta->cantidad), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($venta->total), 1, 0, 'C');
    $pdf->Cell(55, 10, utf8_decode($venta->nombre), 1, 1, 'C');
    
}

$pdf->Output();


?>