<?php

  $m_id = $_SESSION['m_id'];

  $m_code = $_SESSION['m_code'];

  $m_name = $_SESSION['m_name'];

  $m_part = $_SESSION['m_part'];

  $m_status = $_SESSION['m_status'];

 	if($m_status!='1'){

    Header("Location:../logout");  

  }  

  ?>