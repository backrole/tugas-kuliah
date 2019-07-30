<?php  
	function encrypt($data) {
		$salt = base64_encode($data);
		return $hasil = crypt("'$2y$10$'.$salt.'$'", $data);
	} 
	function decrypt ($data) {
		return $hasil = imap_utf7_decode($data);
	}
?>
<!-- encripsi <?php echo encrypt("asnd") ?> -->