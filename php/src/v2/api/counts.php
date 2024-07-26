<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config.php";

$scores = array();
foreach ($conn->query('SELECT count(DISTINCT s_no) as ds_no FROM score') as $row) {
    $count = array(
        'count' => $row['ds_no'],
    );
    array_push($scores, $count);
}
echo json_encode($scores);
$conn = null;
?>