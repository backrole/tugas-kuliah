<?php  
	try {
		$db = new PDO("mysql:host=localhost;dbname=toko_buku_arza","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Connection failed " .$e->getMessage();
	}
?>
