<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config.php";

$scores = array();
foreach ($conn->query('SELECT sum(sc.sc_result) as total, c.c_id, c.c_department, c.c_name, c.c_pic FROM score as sc right join candidate as c on sc.c_id = c.c_id group by c.c_name order by total DESC, c.c_id ASC') as $row) {
    $score = array(
        'total' => $row['total'],
        'c_pic' => "../uploads/candidate/".$row['c_pic'],
        'c_name' => $row['c_name'],
        'c_department' => $row['c_department'],
    );
    array_push($scores, $score);
}
echo json_encode($scores);
$conn = null;
?>