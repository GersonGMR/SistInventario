<?php
include "./conexion.php";
        $codCliente = $_REQUEST['cliente'];
        $noFactura = $_REQUEST['id'];
        $consulta = mysqli_query($conexion, "SELECT * FROM configuracion");
        $resultado = mysqli_fetch_assoc($consulta);
        $ventas = mysqli_query($conexion, "SELECT * FROM ventas WHERE id = $noFactura");
        $result_venta = mysqli_fetch_assoc($ventas);
        $clientes = mysqli_query($conexion, "SELECT c.id,c.ruc,c.DUI,c.nombre,c.direccion,c.telefono,c.representante,c.cant_ninios,f.descripcion FROM clientes c
          INNER JOIN frecuencia f ON c.id_frecuencia = f.id
          WHERE c.id = $codCliente");
        $result_cliente = mysqli_fetch_assoc($clientes);
        $productos = mysqli_query($conexion, "SELECT c.representante,c.cant_ninios,d.id_venta, d.id_producto, d.cantidad, p.id, p.nombre, p.medida FROM detalle_venta d
          INNER JOIN productos p ON d.id_venta = $noFactura
          INNER JOIN ventas v ON d.id_venta = v.id
          INNER JOIN clientes c ON v.id_cliente = c.id
          WHERE d.id_producto = p.id");
require_once "Assets/pdf/fpdf.php";
$total = 0.00;
$pdf = new FPDF('P', 'mm', array(105 , 148));
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Reporte de salida");
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(55, 0, utf8_decode($resultado['nombre']), 0, 0, 'C');
$pdf->image(base_url().'Assets/img/logo.jpg', 73, 8, 22, 6.5, 'JPG');
$pdf->Ln(5);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(20, 12, utf8_decode("No. de entrega: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 6.5);
$pdf->Cell(15, 12, utf8_decode($result_venta['numentrega']), 0, 1, 'L');
$pdf->Ln(-12);
$pdf->setFont('Arial', 'B', 6.5);
$pdf->Cell(70, 12, utf8_decode("Código: "), 0, 0, 'R');
$pdf->setFont('Arial', '', 6.5);
$pdf->Cell(15, 12, utf8_decode($result_cliente['ruc']), 0, 1, 'R');
$pdf->Ln(-9);
$pdf->setFont('Arial', 'B', 6.5);
$pdf->Cell(70, 12, utf8_decode("Fecha: "), 0, 0, 'R');
$pdf->setFont('Arial', '', 6.5);
$pdf->Cell(15, 12, utf8_decode($result_venta['fecha']), 0, 1, 'R');
$pdf->Ln(-9);
$pdf->setFont('Arial', 'B', 6.5);
$pdf->Cell(70, 12, utf8_decode("Frecuencia ent: "), 0, 0, 'R');
$pdf->setFont('Arial', '', 6.5);
$pdf->Cell(15, 12, utf8_decode($result_cliente['descripcion']), 0, 1, 'R');
$pdf->Ln(-5);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(20, 5, utf8_decode("Justificante de entrega: "), 0, 0, 'L');
$pdf->Ln(9);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(20, 5, utf8_decode("Solicitante: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 7);
$pdf->multiCell(65, 5, utf8_decode($result_cliente['representante']), 0);
$pdf->Ln(-1);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(20, 5, utf8_decode("Organización: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 7);
$pdf->multiCell(65, 5, utf8_decode($result_cliente['nombre']), 0);
$pdf->Ln(-1);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 7);
$pdf->multiCell(65, 5, utf8_decode($result_cliente['direccion']), 0);
$pdf->Ln(2);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(40, 5, utf8_decode("Número de niños beneficiados: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 7);
$pdf->multiCell(65, 5, utf8_decode($result_cliente['cant_ninios']), 0);
$pdf->Ln(-1);
$pdf->setFont('Arial', '', 7);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(45, 3, utf8_decode('Descripción'), 1, 0, 'L', 1);
$pdf->Cell(15, 3, 'Cant.', 1, 0, 'C', 1);
$pdf->Cell(25, 3, utf8_decode('Presentación'), 1, 1, 'L', 1);

//loop de datos
while ($row = mysqli_fetch_assoc($productos)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(50, 5, utf8_decode($row['nombre']), 0, 0, 'L');
    $pdf->Cell(9, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->Cell(25, 5, utf8_decode($row['medida']), 0, 1, 'L');
    $pdf->Ln(-2.5);
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 7);
$pdf->Cell(86, 5, 'Total productos: '. number_format($total), 0, 1, 'R');

// parte de abajo de la tabla
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->MultiCell(85, 5, utf8_decode("LA VENTA, CANJE, U OTRO TIPO DE COMERCIALIZACIÓN DE ESTOS PRODUCTOS ES PROHIBIDO Y PENADO POR LA LEY."), 0, 'C');
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(25, 5, utf8_decode("Autoriza la ayuda: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode($resultado['autoriza']), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(30, 5, utf8_decode("Firma: "), 0, 0, 'L');
$pdf->Ln(5);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(25, 5, utf8_decode("Entrega la ayuda: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode($resultado['entrega']), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(30, 5, utf8_decode("Firma: "), 0, 0, 'L');
$pdf->Ln(5);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(55, 5, utf8_decode("Sello Convoy of Hope: "), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(9, 5, utf8_decode("Sello: "), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(30, 5, utf8_decode("________________"), 0, 0, 'L');
$pdf->Ln(5);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(25, 5, utf8_decode("Recibe la ayuda: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode($result_cliente['representante']), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(30, 5, utf8_decode("Firma: "), 0, 0, 'L');
$pdf->Ln(5);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(25, 5, utf8_decode("DUI: "), 0, 0, 'L');
$pdf->setFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode($result_cliente['DUI']), 0, 0, 'L');
$pdf->Output();
