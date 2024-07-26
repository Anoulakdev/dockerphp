<?php

  $co_id = $_SESSION['co_id'];

  $co_name = $_SESSION['co_name'];

  $co_pic = $_SESSION['co_pic'];

  $co_status = $_SESSION['co_status'];

 	if($co_status!='1'){

    Header("Location:../logout");  

  }  

  ?>