<form method="post">
	<input type="text" name="isi">
<input type="submit" name="ecnript" value="encode">
<input type="submit" name="decode" value="deconde">
</form>


<?php  
	$isi1 = @$_POST['isi'];
	if (@$_POST['ecnript']) {
		$hash = base64_encode($isi1);
		echo $hash;
	} else if (@$_POST['decode']) {
		$hashed = base64_decode($isi1);
		echo $hashed;
	}

?>