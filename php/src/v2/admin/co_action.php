<?php
session_start();
ob_start();
include '../config.php';
include '../style/sweetalert.php';
include 'status.php';


$update = false;
$co_id = "";
$co_username = "";
$co_password = "";
$co_name = "";
$co_status = "";


if (isset($_POST['add'])) {
	$co_username = $_POST['co_username'];
	$co_password = $_POST['co_password'];
	$co_name = $_POST['co_name'];
	$co_status = 1;

	if (isset($_FILES['co_pic']['name']) && ($_FILES['co_pic']['name'] != "")) {

		$dn = date('ymdHis');
		$co_pic = $_FILES['co_pic']['name'];
		$extension = pathinfo($co_pic, PATHINFO_EXTENSION);
		$randomno = rand(0, 10000);
		$pic_rand = $dn . $randomno . '.' . $extension;
		$upicture = "../uploads/counter/" . $pic_rand;
	} else {

		$pic_rand = "";
		$upicture = "";
	}


	$result = $conn->query("SELECT * FROM counter WHERE co_username = '$co_username' AND co_password = '$co_password'");
	$row_cnt = $result->num_rows;

	if ($row_cnt > 0) {

		echo "<script>
			$(document).ready(function() {
			Swal.fire({
			position: 'center',
			icon: 'info',
			title: 'ຊື່ແລະລະຫັດມີຢູ່ໃນລະບົບແລ້ວ',
			showConfirmButton: false,
			timer: 3000
		  });
		});
			</script>";

		header("refresh:3; url=counter");
	} else {

		$query = "INSERT INTO counter(co_username,co_password,co_name,co_pic,co_status)VALUES(?,?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssss", $co_username, $co_password, $co_name, $pic_rand, $co_status);
		$stmt->execute();
		move_uploaded_file($_FILES['co_pic']['tmp_name'], $upicture);

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

		header("refresh:3; url=counter");
	}
}
if (isset($_GET['delete'])) {
	$co_id = $_GET['delete'];

	$sql = "SELECT co_pic FROM counter WHERE co_id=?";
	$stmt2 = $conn->prepare($sql);
	$stmt2->bind_param("i", $co_id);
	$stmt2->execute();
	$result2 = $stmt2->get_result();
	$row = $result2->fetch_assoc();

	$imagepath = "../uploads/counter/" . $row['co_pic'];
	unlink($imagepath);

	$query = "DELETE FROM counter WHERE co_id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $co_id);
	$stmt->execute();

	if ($stmt) {

		header("refresh:1; url=counter");
	}
}

if (isset($_POST['update'])) {
	$co_id = $_POST['co_id'];
	$co_username = $_POST['co_username'];
	$co_password = $_POST['co_password'];
	$co_name = $_POST['co_name'];
	$oldpic = $_POST['oldpic'];

	if (isset($_FILES['co_pic']['name']) && ($_FILES['co_pic']['name'] != "")) {
		$dn = date('ymdHis');
		$co_pic = $_FILES['co_pic']['name'];
		$extension = pathinfo($co_pic, PATHINFO_EXTENSION);
		$randomno = rand(0, 10000);
		$pic_rand = $dn . $randomno . '.' . $extension;
		$upicture = "../uploads/counter/" . $pic_rand;

		$nco_pic = $pic_rand;
		if($oldpic!="") {
			unlink("../uploads/counter/" . $oldpic);
		}
		move_uploaded_file($_FILES['co_pic']['tmp_name'], $upicture);

	} else {

		$nco_pic = $oldpic;
	}


	$query = "UPDATE counter SET co_username=?,co_password=?,co_name=?,co_pic=? WHERE co_id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssssi", $co_username, $co_password, $co_name, $nco_pic, $co_id);
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

	header("refresh:3; url=counter");
}

ob_end_flush();

?>