<?php
session_start();
ob_start();
include '../config.php';
include '../style/sweetalert.php';
include 'status.php';


$update = false;
$c_id = "";
$c_name = "";
$c_age = "";
$c_phak = "";
$c_lat = "";
$c_saonoum = "";
$c_part = "";
$c_reason = "";
$c_pic = "";



if (isset($_POST['add'])) {
	$c_name = $_POST['c_name'];
	$c_age = $_POST['c_age'];
	$c_phak = $_POST['c_phak'];
	$c_lat = $_POST['c_lat'];
	$c_saonoum = $_POST['c_saonoum'];
	$c_part = $_POST['c_part'];
	$c_reason = $_POST['c_reason'];

	if (isset($_FILES['c_pic']['name']) && ($_FILES['c_pic']['name'] != "")) {

		$dn = date('ymdHis');
		$c_pic = $_FILES['c_pic']['name'];
		$extension = pathinfo($c_pic, PATHINFO_EXTENSION);
		$randomno = rand(0, 10000);
		$pic_rand = $dn . $randomno . '.' . $extension;
		$upicture = "../uploads/candidate/" . $pic_rand;
	} else {

		$pic_rand = "";
		$upicture = "";
	}

	$query = "INSERT INTO candidate(c_name,c_age,c_phak,c_lat,c_saonoum,c_part,c_reason,c_pic)VALUES(?,?,?,?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssssssss", $c_name, $c_age, $c_phak, $c_lat, $c_saonoum, $c_part, $c_reason, $pic_rand);
	$stmt->execute();
	move_uploaded_file($_FILES['c_pic']['tmp_name'], $upicture);

	echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'ເພີ່ມຂໍ້​ມູນເຂົ້າລະບົບສຳເລັດແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=candidate");
}

if (isset($_GET['delete'])) {
	$c_id = $_GET['delete'];

	$sql = "SELECT c_pic FROM candidate WHERE c_id=?";
	$stmt2 = $conn->prepare($sql);
	$stmt2->bind_param("i", $c_id);
	$stmt2->execute();
	$result2 = $stmt2->get_result();
	$row = $result2->fetch_assoc();

	$imagepath = "../uploads/candidate/" . $row['c_pic'];
	unlink($imagepath);

	$query = "DELETE FROM candidate WHERE c_id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $c_id);
	$stmt->execute();

	if ($stmt) {

		header("refresh:1; url=candidate");
	}
}

if (isset($_POST['update'])) {
	$c_id = $_POST['c_id'];
	$c_name = $_POST['c_name'];
	$c_age = $_POST['c_age'];
	$c_phak = $_POST['c_phak'];
	$c_lat = $_POST['c_lat'];
	$c_saonoum = $_POST['c_saonoum'];
	$c_part = $_POST['c_part'];
	$c_reason = $_POST['c_reason'];
	$oldpic = $_POST['oldpic'];

	if (isset($_FILES['c_pic']['name']) && ($_FILES['c_pic']['name'] != "")) {
		$dn = date('ymdHis');
		$c_pic = $_FILES['c_pic']['name'];
		$extension = pathinfo($c_pic, PATHINFO_EXTENSION);
		$randomno = rand(0, 10000);
		$pic_rand = $dn . $randomno . '.' . $extension;
		$upicture = "../uploads/candidate/" . $pic_rand;

		$nc_pic = $pic_rand;
		if ($oldpic != "") {
			unlink("../uploads/candidate/" . $oldpic);
		}
		move_uploaded_file($_FILES['c_pic']['tmp_name'], $upicture);
	} else {

		$nc_pic = $oldpic;
	}


	$query = "UPDATE candidate SET c_name=?, c_age=?, c_phak=?, c_lat=?, c_saonoum=?, c_part=?, c_reason=?, c_pic=? WHERE c_id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssssssssi", $c_name, $c_age, $c_phak, $c_lat, $c_saonoum, $c_part, $c_reason, $nc_pic, $c_id);
	$stmt->execute();

	echo "<script>
				$(document).ready(function() {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'ອັບເດດຂໍ້ມູນສຳເລັດແລ້ວ',
						showConfirmButton: false,
						timer: 3000
					  });
				});
			</script>";

	header("refresh:3; url=candidate");
}

ob_end_flush();
