<?php

require_once('../tcpdf/tcpdf.php');
include '../config.php';

if (isset($_GET['s_id'])) {
    $id = $_GET['s_id'];
    $s_id = "WHERE s_id = '$id'";
} else {
    $s_id = "";
}

// Retrieve data from the database
$sql = "SELECT * FROM sheet {$s_id}";
$result = $conn->query($sql);

// create new PDF document
$pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set font
$pdf->SetFont('phetsarath_ot', '', 11);


while ($row = $result->fetch_assoc()) {
    $barcodeValue = $row["s_no"];
    // add a page
    $pdf->AddPage();
    $pdf->Ln(244);


    // define barcode style
    $style = array(
        'position' => 'C',
        'align' => 'B',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false,
        'text' => true,
        'font' => 'phetsarath_ot',
        'fontsize' => 8,
        'stretchtext' => 30
    );
    // Generate the barcode image
    $pdf->write1DBarcode($barcodeValue, 'C128', '', '', '', 22, 0.8, $style, 'N');

    // Move to the next line
}

$pdf->Output('sheet.pdf', 'I');
