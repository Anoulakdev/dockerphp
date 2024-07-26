<?php
include '../config.php';

$sql15 = "SELECT count(DISTINCT s_no) as ds_no FROM score";
$result15 = $conn->query($sql15);
$row15 = $result15->fetch_assoc();
$ds_no = $row15['ds_no'];

echo '<u>ລົງ​ສຳ​ເລັດ</u>: ' .$ds_no .' ໃບ';
?>