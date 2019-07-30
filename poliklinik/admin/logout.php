<?php
  include '../assets/inc/connect.inc';
  session_start();
  session_destroy();

  header("location:../login.php");
?>
