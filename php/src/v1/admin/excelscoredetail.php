<?php 
 
// Load the database configuration file 
include_once '../config.php'; 
 
// Include XLSX generator library 
require_once '../SimpleXLSXGen.php'; 

// Excel file name for download 
$fileName = date('YmdHis') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('ລ/ດ', 'ຜູ້​ແທນ', '​ຜູ້​ສະ​ໝັກ'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT sc.*, m.*, c.*  FROM score as sc inner join member as m on sc.m_id = m.m_id inner join candidate as c on sc.c_id = c.c_id WHERE sc.sc_result = 0 order by sc.m_id ASC"); 

    $i = 1;
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($i++, $row['m_name'], $row['c_name']);  
        $excelData[] = $lineData; 
    } 

 
// Export data to excel and download as xlsx file 
$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>
