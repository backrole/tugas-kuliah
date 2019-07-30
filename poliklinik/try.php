<?php  
	try {
		$db = new PDO("mysql:host=localhost;dbname=db_negaretail_toko_bm01","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Connection Failed ".$e->getMessage();
	}

	$tampil = $db->prepare("SELECT ID_DETAIL_JURNAL FROM td_jurnal WHERE UPLOADED IS NULL");
	$tampil->execute();

	while ($data = $tampil->fetch(PDO::FETCH_LAZY)) {
		echo $data->ID_DETAIL_JURNAL;
		?>
		<br>
		<?php
	}
?>