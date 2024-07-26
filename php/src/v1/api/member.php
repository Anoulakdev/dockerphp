<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config.php";

$members = array();
foreach ($conn->query('SELECT * FROM member order by m_id desc') as $row) {
    $member = array(
        'm_id' => $row['m_id'],
        'm_username' => $row['m_username'],
        'm_code' => $row['m_code'],
        'm_name' => $row['m_name'],
        'm_part' => $row['m_part'],
    );
    array_push($members, $member);
}
echo json_encode($members);
$conn = null;
?>