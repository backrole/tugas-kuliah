<?php 
function encrypt($data){
	return base64_encode($data);
}
function decrypt($data){
	return base64_decode($data);
}
 function show($table, $value = "*") {
 	return mysql_query("SELECT $value FROM $table");
 }
 function update($table, $value) {
 	return mysql_query("UPDATE $table SET $value");
 }
 function insert($table, $value ) {
 	return mysql_query("INSERT INTO $table VALUES ($value)");
 }
 function fetch($table) {
 	return mysql_fetch_array($table);
 }
 function delete($id) {
 	return mysql_query("DELETE FROM $id");
 }
 function redirect($link){
 	echo "<script>location.href=('$link');</script>";
 }
 function alert($link){
 	echo "<script>alert('$link');</script>";
 }
?>