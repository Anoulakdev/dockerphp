<?php 
 
// Load the database configuration file 
include_once '../config.php'; 
 
// Include XLSX generator library 
require_once '../SimpleXLSXGen.php'; 

// Excel file name for download 
$fileName = date('YmdHis') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('ລ/ດ', 'ກຳ​ມ​ະ​ການ', 'ເລກ​ທີໃບ​ລົງ​ຄະ​ແນນ', '​ຜູ້​ສະ​ໝັກ'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT sc.*, co.*, c.*  FROM score as sc inner join counter as co on sc.co_id = co.co_id inner join candidate as c on sc.c_id = c.c_id WHERE sc.sc_result = 0 order by s_no ASC"); 

    $i = 1;
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($i++, $row['co_name'], $row['s_no'], $row['c_name']);  
        $excelData[] = $lineData; 
    } 

 
// Export data to excel and download as xlsx file 
$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>