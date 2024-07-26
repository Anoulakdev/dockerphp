<?php
session_start();
ob_start();
include '../style/sweetalert.php';

if (isset($_POST['a_username'])) {

  include("../config.php");

  $a_username = $conn->real_escape_string($_POST['a_username']);
  $a_password = $conn->real_escape_string($_POST['a_password']);

  $sql = "SELECT * FROM admin 
          WHERE a_username='$a_username' 
          AND a_password='$a_password'";

  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $_SESSION["a_id"] = $row["a_id"];
    $_SESSION["a_name"] = $row["a_name"];
    $_SESSION["a_status"] = $row["a_status"];

    if ($_SESSION["a_status"] == "1") {
      header("Location: home");
      exit(); // Ensure script stops after redirect
    }
  } else {
    echo "<script>
            $(document).ready(function() {
              Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'ຊື່ ແລະ ລະຫັດ ບໍ່ຖືກຕ້ອງ',
                showConfirmButton: false,
                timer: 3000
              });
            });
          </script>";
    header("refresh:3; url=index");
    exit(); // Ensure script stops after refresh header
  }
} else {
  header("Location: index");
  exit(); // Ensure script stops after redirect
}

ob_end_flush();
