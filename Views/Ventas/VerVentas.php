<?php
include "./conexion.php";
		$codCliente = $_REQUEST['cliente'];
		$noFactura = $_REQUEST['id'];
		$consulta = mysqli_query($conexion, "SELECT * FROM configuracion");
		$resultado = mysqli_fetch_assoc($consulta);
		$ventas = mysqli_query($conexion, "SELECT * FROM ventas WHERE id = $noFactura");
		$result_venta = mysqli_fetch_assoc($ventas);
		$clientes = mysqli_query($conexion, "SELECT * FROM clientes WHERE id = $codCliente");
		$result_cliente = mysqli_fetch_assoc($clientes);
		$productos = mysqli_query($conexion, "SELECT d.id_venta, d.id_producto, d.cantidad, p.id, p.nombre, p.medida FROM detalle_venta d INNER JOIN productos p ON d.id_venta = $noFactura WHERE d.id_producto = p.id");
require_once "Assets/pdf/fpdf.php";
$total = 0.00;
$pdf = new FPDF('P', 'mm', array(105 , 148));
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Reporte de Venta");
$pdf->image(base_url().'Assets/img/logo.jpg', 45, 3, 20, 10, 'JPG');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(85, 15, utf8_decode("Programa de nutrición Convoy Of Hope 2021"), 0, 0, 'C');
$pdf->Ln();
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 12, utf8_decode("Fecha de entrega"), 0, 0, 'L');
$pdf->setFont('Arial','', 10);
$pdf->Cell(40, 12, utf8_decode($result_venta['fecha']), 0,1, 'R');
$pdf->Ln(-8);
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 12, utf8_decode("No. de entrega"), 0, 0, 'L');
$pdf->setFont('Arial','', 10);
$pdf->Cell(40, 12, utf8_decode($result_venta['id']), 0,1, 'R');
$pdf->Ln(-2);
$pdf->setFont('Arial', '', 9);
$pdf->multiCell(90, 5, utf8_decode($result_cliente['nombre']), 1);
$pdf->setFont('Arial', 'B', 10);
$pdf->setY(48);
$pdf->Cell(20, 12, utf8_decode("Entrega autorizada por"), 0, 0, 'L');
$pdf->Line(50, 55, 100, 55);
$pdf->Ln(5);
$pdf->Cell(20, 12, utf8_decode("Entregado por"), 0, 0, 'L');
$pdf->Line(40, 60, 110-10, 60);
$pdf->Line(40, 65, 110-10, 65);
$pdf->Ln(5);
$pdf->Cell(20, 12, utf8_decode("Recibido por"), 0, 0, 'L');

$pdf->Ln(8);
$pdf->Cell(20, 12, utf8_decode("Firma"), 0, 0, 'L');
$pdf->Line(11, 80, 23, 80);
$pdf->Cell(25, 12, utf8_decode("Sello"), 0, 0, 'R');
$pdf->Line(44, 80, 57, 80);

$pdf->Ln(20);
$pdf->setFont('Arial', '', 9);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 5, 'Cod.', 1, 0, 'L', 1);
$pdf->Cell(50, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
$pdf->Cell(6, 5, 'Cant.', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'Medida', 1, 1, 'L', 1);

/*foreach ($data as $compras) {
    $subtotal = $compras['cantidad'];
    $total = $total + $subtotal;
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(12, 5, $compras['id_producto'], 0, 0, 'C');
    $pdf->Cell(25, 5, utf8_decode($compras['producto']), 0, 0, 'C');
    $pdf->Cell(10, 5, $compras['cantidad'], 0, 0, 'C');
    $pdf->Cell(40, 5, $productos['medida'], 0, 1, 'C');
} */
while ($row = mysqli_fetch_assoc($productos)) {
	  $subtotal = $row['cantidad'];
		$total = $total + $subtotal;
		$pdf->SetTextColor(0, 0, 0);
		$pdf->setFont('Arial', '', 6);
		$pdf->Cell(10, 5, $row['id_producto'], 0, 0, 'L');
		$pdf->Cell(50, 5, utf8_decode($row['nombre']), 0, 0, 'L');
		$pdf->Cell(5.5, 5, $row['cantidad'], 0, 0, 'L');
		$pdf->Cell(25, 5, utf8_decode($row['medida']), 0, 1, 'L');
	}
$pdf->Ln(3);
$pdf->Cell(90, 5, 'Total productos: '. number_format( $total), 0, 1, 'R');

$pdf->Output();
?>
