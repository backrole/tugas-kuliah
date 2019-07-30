<?php  
	try {
		$db = new PDO("mysql:host=localhost;dbname=belajar","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "koneksi gagal" .$e->getMessage();
	}
?>