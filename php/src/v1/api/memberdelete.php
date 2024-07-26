<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config.php";

$memberdeletes = array();
foreach ($conn->query('SELECT DISTINCT sc.m_id, m.m_code, m_name, m_part FROM score as sc inner join member as m on sc.m_id = m.m_id') as $row) {
    $memberdelete = array(
        'm_id' => $row['m_id'],
        'm_code' => $row['m_code'],
        'm_name' => $row['m_name'],
        'm_part' => $row['m_part'],
    );
    array_push($memberdeletes, $memberdelete);
}
echo json_encode($memberdeletes);
$conn = null;
?>