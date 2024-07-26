<?php
session_start();
ob_start();
include '../config.php';
include '../style/sweetalert.php';
include 'status.php';


$update = false;
$m_id = "";
$m_username = "";
$m_password = "";
$m_code = "";
$m_name = "";
$m_part = "";
$m_status = "";


if (isset($_POST['add'])) {

    $sql1 = "SELECT max(m_id) as mid FROM member";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $mid = $row1['mid'];

    $count = 100001;
    if ($row1['mid'] == "NULL") {
        $username = $count;
    } else {
        $username = $mid + $count;
    }

    $m_username = $username;
    $m_password = password_hash("MEM1234", PASSWORD_DEFAULT);
    $m_code = $_POST['m_code'];
    $m_name = $_POST['m_name'];
    $m_part = $_POST['m_part'];
    $m_status = 1;


    $query = "INSERT INTO member(m_username,m_password,m_code,m_name,m_part,m_status)VALUES(?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $m_username, $m_password, $m_code, $m_name, $m_part, $m_status);
    $stmt->execute();

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

    header("refresh:3; url=member");
}

if (isset($_GET['delete'])) {
    $m_id = $_GET['delete'];

    $query = "DELETE FROM member WHERE m_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $m_id);
    $stmt->execute();

    if ($stmt) {

        header("refresh:1; url=member");
    }
}

if (isset($_POST['update'])) {
    $m_id = $_POST['m_id'];
    $m_code = $_POST['m_code'];
    $m_name = $_POST['m_name'];
    $m_part = $_POST['m_part'];

    $query = "UPDATE member SET m_code=?,m_name=?,m_part=? WHERE m_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $m_code, $m_name, $m_part, $m_id);
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

    header("refresh:3; url=member");
}

ob_end_flush();
