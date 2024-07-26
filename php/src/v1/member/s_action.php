<?php
session_start();
ob_start();
include '../config.php';
include '../style/sweetalert.php';
include 'status.php';


$update = false;
$sc_id = "";
$m_id = "";
$c_id = "";
$sc_result = "";



if (isset($_POST['add'])) {
	$m_id = $_POST['m_id'];
	$c_id = $_POST['c_id'];
	$sc_result = 1;
	$sc_res = 0;

	$sql = "SELECT c_id FROM candidate";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}


	foreach ($data as $row) {
		$data1 = $row['c_id'];

		$query = "INSERT INTO score(m_id,c_id,sc_result)VALUES(?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sss", $m_id, $data1, $sc_result);
		$stmt->execute();
	}


	foreach ($c_id as $cid) {
		$stmt1 = $conn->prepare("UPDATE score SET sc_result = $sc_res WHERE m_id = $m_id AND c_id = ?");
		$stmt1->bind_param("s", $cid);
		$stmt1->execute();
	}


	echo "<script>
				$(document).ready(function() {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'ທ່ານ​ໄດ້​ລົງ​ຄະ​ແນນສຳເລັດແລ້ວ',
						showConfirmButton: false,
						timer: 3000
					  });
				});
			</script>";

	header("refresh:3; url=addscore");
}
ob_end_flush();
