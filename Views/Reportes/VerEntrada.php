<?php
include "./conexion.php";
        $desde = $_REQUEST['desde'];
        $hasta = $_REQUEST['hasta'];
        $entradas = mysqli_query($conexion, "SELECT SUM(d.cantidad) as cantidad, p.nombre, p.medida FROM detalle_compra d
          INNER JOIN productos p ON d.id_producto = p.id
          WHERE d.Fecha between '$desde' and '$hasta'
          GROUP BY p.id");
require_once "Assets/pdf/fpdf.php";
$total = 0.00;
$pdf = new FPDF('P', 'mm', array(105, 148));
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Reporte de entrada");
$pdf->image(base_url().'Assets/img/logo.jpg', 73, 11, 22, 6.5, 'JPG');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(50, 5, utf8_decode($alert['nombre']), 0, 1, 'L');
$pdf->Cell(30, 5, utf8_decode("Codigo"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($alert['ruc']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("Teléfono"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($alert['telefono']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("Dirección"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($alert['direccion']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("Fecha de reporte"), 0, 0, 'L');
$pdf->Ln();
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("Desde"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($desde), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("Hasta"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($hasta), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
/*$pdf->Cell(50, 5, utf8_decode($result_fecha['fecha']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 8);
$pdf->Cell(30, 5, utf8_decode("No. Entrada"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($noFactura), 0, 1, 'L');*/
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(80, 8, utf8_decode("Detalle de los productos entrantes"), 0, 1, 'C');
$pdf->setFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'Cant.', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'Medida', 1, 1, 'C', 1);
/*
foreach ($data as $compras) {
    $subtotal = $compras['cantidad'];
    $total = $total + $subtotal;
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(35, 5, utf8_decode($compras['producto']), 1, 0, 'L');
    $pdf->Cell(10, 5, $compras['cantidad'], 1, 0, 'L');
    $pdf->Cell(40, 5, $compras['fecha'], 1, 1, 'L');
}*/
while ($row = mysqli_fetch_assoc($entradas)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(50, 5, utf8_decode($row['nombre']), 0, 0, 'L');
    $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(35, 5, utf8_decode($row['medida']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');

$pdf->Output();
