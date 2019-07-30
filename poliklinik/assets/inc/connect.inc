<?php  
	try {
		$db = new PDO ("mysql:host=localhost;dbname=poliklinik","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "connection failed " .$e->getMessage();
	}
?>