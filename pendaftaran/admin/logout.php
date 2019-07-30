<?php
include '../assets/connect.inc';
  session_start();
  session_destroy();

  header("location:index.php");
?>
