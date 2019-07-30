<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("toko_nanang") or die (mysql_error());
?>