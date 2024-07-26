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
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

class MyPDF extends TCPDF {
    private $barcodeValue = '';

    public function setBarcodeValue($barcodeValue) {
        $this->barcodeValue = $barcodeValue;
    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        $this->SetY(-18);
        $this->SetX(15);

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
            'stretchtext' => 28
        );
        // Barcode content
        $barcode = '001';
        // Print barcode
        $this->write1DBarcode($this->barcodeValue, 'C128', '', '', '', 20, 0.8, $style, 'N');
    }
}

// create new PDF document
$pdf = new MyPDF("P", "mm", "A4", true, 'UTF-8', false);


$pdf->setPrintHeader(false);


foreach ($data as $row) {
    // Add a new page
    $pdf->AddPage();

    // Set the barcode value for this page
    $pdf->setBarcodeValue($row['s_no']);

}

// Close and output PDF document
$pdf->Output('sheet.pdf', 'I');

?>