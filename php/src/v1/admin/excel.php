<?php 
 
// Load the database configuration file 
include_once '../config.php'; 
 
// Include XLSX generator library 
require_once '../SimpleXLSXGen.php'; 

// Excel file name for download 
$fileName = date('YmdHis') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('ລ/ດ', 'ຊື່​ເຂົ້າ​ລະ​ບົບ', '​ລະ​ຫັດ​ພະ​ນັກ​ງານ', 'ຊື່ ແລະ ນາມ​ສະ​ກຸນ', 'ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT * FROM member"); 

    $i = 1;
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($i++, $row['m_username'], $row['m_code'], $row['m_name'], $row['m_part']);  
        $excelData[] = $lineData; 
    } 

 
// Export data to excel and download as xlsx file 
$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>
