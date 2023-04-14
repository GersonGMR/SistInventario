<?php
include "./conexion.php";
require('./cellfit.php');
        $alimentos = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Alimentos'");
          date_default_timezone_set('America/El_Salvador');
          $date = date('m/d/Y');
$total = 0.00;
//$pdf = new FPDF('P', 'mm', array(105, 148));
$pdf = new FPDF_CellFit('P', 'mm', array(105, 148));
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Reporte de productos");
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
$pdf->Cell(30, 5, utf8_decode("Fecha impreso"), 0, 0, 'L');
$pdf->setFont('Arial', '', 8);
$pdf->Cell(50, 5, utf8_decode($date), 0, 1, 'L');

//Despliega alimentos
$rowAlimentos=mysqli_num_rows($alimentos);
if ($rowAlimentos > 0) {

$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(80, 8, utf8_decode("Alimentos"), 0, 1, 'C');
$pdf->setFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(9, 5, 'Cod', 1, 0, 'L', 1);
$pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
$pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
$pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
$pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($alimentos)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
} 

//Despliega lacteos
$lacteos = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Lacteos'");

$rowLacteos=mysqli_num_rows($lacteos);
if ($rowLacteos > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Lacteos"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($lacteos)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega cereales
$cereales = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Cereales'");

$rowCereales=mysqli_num_rows($cereales);
if ($rowCereales > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Cereales"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($cereales)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega embutidos
$embutidos = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Embutidos'");

if (mysqli_num_rows($embutidos) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Embutidos"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($embutidos)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega enlatados
$enlatados = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Enlatados'");

$rowEnlatados=mysqli_num_rows($enlatados);
if ($rowEnlatados > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Enlatados"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($enlatados)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega vitaminas
$vitaminas = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='vitaminas'");

$rowVitaminas=mysqli_num_rows($vitaminas);
if ($rowVitaminas > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Vitaminas"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($vitaminas)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega insumos médicos
$insuMedicos = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Insumos médicos'");

if (mysqli_num_rows($insuMedicos) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Insumos médicos"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($insuMedicos)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Prendas de vestir
$prendVestir = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Prendas de vestir'");

if (mysqli_num_rows($prendVestir) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Prendas de vestir"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($prendVestir)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Insumos de bodega
$insuBodega = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Insumos de bodega'");

if (mysqli_num_rows($insuBodega) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Insumos de bodega"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($insuBodega)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega higiene
$higiene = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Higiene'");

if (mysqli_num_rows($higiene) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Higiene"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($higiene)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Calzado
$calzado = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Calzado'");

if (mysqli_num_rows($calzado) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Calzado"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($calzado)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Libros
$libros = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Libros'");

if (mysqli_num_rows($libros) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Libros"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($libros)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Herramientas
$herramientas = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Herramientas'");

if (mysqli_num_rows($herramientas) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Herramientas"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($herramientas)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega Emergencia
$emergencia = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento, p.medida
          FROM productos as p
          INNER JOIN familia as f ON p.id_familia = f.id_familia
          WHERE p.vencimiento > CURRENT_DATE
          AND p.cantidad > 0
          AND f.nombre='Emergencia'");

if (mysqli_num_rows($emergencia) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Emergencia"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);
while ($row = mysqli_fetch_assoc($emergencia)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}

//Despliega otros
$otros = mysqli_query($conexion, "SELECT p.codigo, p.nombre as nombre_producto,f.nombre as nombre_fam, p.cantidad, p.vencimiento , p.medida
            FROM productos as p
            INNER JOIN familia as f ON p.id_familia = f.id_familia
            WHERE p.vencimiento > CURRENT_DATE
            AND p.cantidad > 0
            AND f.nombre!='Alimentos' AND f.nombre!='Lacteos' AND f.nombre!='Cereales' AND f.nombre!='Embutidos' AND f.nombre!='Enlatados' AND f.nombre!='vitaminas'
            AND f.nombre!='Insumos médicos' AND f.nombre!='Prendas de vestir' AND f.nombre!='Insumos de bodega' AND f.nombre!='Higiene' AND f.nombre!='Calzado' AND f.nombre!='Libros'
            AND f.nombre!='Herramientas' AND f.nombre!='Emergencia'");

if (mysqli_num_rows($otros) > 0) {
    $pdf->setFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("Otros"), 0, 1, 'C');
    $pdf->setFont('Arial', 'B', 8);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(9, 5, 'Cod', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
    $pdf->Cell(8, 5, 'Cant', 1, 0, 'C', 1);
    $pdf->Cell(14, 5, 'Medida', 1, 0, 'C', 1);
    $pdf->Cell(15, 5, 'Vence', 1, 1, 'R', 1);

while ($row = mysqli_fetch_assoc($otros)) {
    $subtotal = $row['cantidad'];
    $total = $total + $subtotal;
    $pdf->setFont('Arial', '', 6);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('Arial', '', 5);
    $pdf->Cell(10, 5, $row['codigo'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(45, 5, utf8_decode($row['nombre_producto']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
    $pdf->setFont('Arial', '', 5);
    $pdf->CellFitScale(14, 5, utf8_decode($row['medida']), 0, 0, 'L');
    $pdf->setFont('Arial', '', 6);
    $pdf->Cell(20, 5, utf8_decode($row['vencimiento']), 0, 1, 'L');
}
$pdf->Ln(1);
$pdf->setFont('Arial', 'B', 6);
$pdf->Cell(90, 3.5, 'Total productos: '. number_format($total), 0, 1, 'R');
$total = 0.00;
}
$pdf->Output();
