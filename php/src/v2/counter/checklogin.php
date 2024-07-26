<?php
session_start();
ob_start();
include '../style/sweetalert.php';

if (isset($_POST['co_username'])) {

  include("../config.php");

  $co_username = $conn->real_escape_string($_POST['co_username']);

  $co_password = $conn->real_escape_string($_POST['co_password']);



  $sql = "SELECT * FROM counter 

                  WHERE  co_username='" . $co_username . "' 

                  AND  co_password='" . $co_password . "' ";

  $result = $conn->query($sql);



  if (mysqli_num_rows($result) == 1) {

    $row = $result->fetch_assoc();



    $_SESSION["co_id"] = $row["co_id"];

    $_SESSION["co_name"] = $row["co_name"];

    $_SESSION["co_pic"] = $row["co_pic"];

    $_SESSION["co_status"] = $row["co_status"];


    if ($_SESSION["co_status"] == "1") {

      Header("Location: addscore");
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



    header("refresh:3; url=../index");
  }
} else {

  Header("Location: ../index"); //user & password incorrect back to login again

}

ob_end_flush();
