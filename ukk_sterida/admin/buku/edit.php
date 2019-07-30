<?php  
$id = @$_GET['id'];
?>
<h3 class="text-muted">Edit Data Buku <i class="fa fa-book"></i></h3> 
<hr>
<?php  
	$show = $db->prepare("SELECT * FROM buku WHERE id_buku = '$id'");
	$show->execute();
	$showed = $show->fetch(PDO::FETCH_LAZY);
?>
<form method="POST" role="form">
	<div class="form-group">
		<label for="">ID Buku</label>
		<input type="text" value="<?php echo $showed->id_buku; ?>" class="form-control" id="" name="idbuku" readonly>
	</div>
	<div class="form-group">
		<label for="">Judul</label>
		<input type="text" value="<?php echo $showed->judul; ?>" class="form-control" id="" name="judul" >
	</div>
	<div class="form-group">
		<label for="">Penulis</label>
		<input type="text" value="<?php echo $showed->penulis; ?>" class="form-control" id="" name="penulis" >
	</div>
	<div class="form-group">
		<label for="">Penerbit</label>
		<input type="text" value="<?php echo $showed->penerbit; ?>" class="form-control" id="" name="penerbit" >
	</div>
	<div class="form-group">
		<label for="">Tahun</label>
		<input type="text" value="<?php echo $showed->tahun; ?>" class="form-control" id="" name="tahun" >
	</div>
	<div class="form-group">
		<label for="">Stok</label>
		<input type="text" value="<?php echo $showed->stok; ?>" class="form-control" id="" name="stok" >
	</div>
	<div class="form-group">
		<label for="">Harga Pokok</label>
		<input type="text" value="<?php echo $showed->harga_pokok; ?>" class="form-control" id="" name="hargapokok" >
	</div>
	<div class="form-group">
		<label for="">Harga Jual</label>
		<input type="text" value="<?php echo $showed->harga_jual; ?>" class="form-control" id="" name="hargajual" >
	</div>
	<div class="form-group">
		<label for="">PPN</label>
		<input type="text" value="<?php echo $showed->ppn; ?>" class="form-control" id="" name="ppn" >
	</div>	
	<div class="form-group">
		<label for="">Diskon</label>
		<input type="text" value="<?php echo $showed->diskon; ?>" class="form-control" id="" name="diskon" >
	</div>

	

	<input type="submit" class="btn btn-primary" name="edit" value="Edit">
</form>

<?php  
				$id = @$_POST['idbuku'];
				$noisbn = @$_POST['noisbn'];
				$judul = @$_POST['judul'];
				$penulis = @$_POST['penulis'];
				$penerbit = @$_POST['penerbit'];
				$tahun = @$_POST['tahun'];
				$stok = @$_POST['stok'];
				$hargapokok = @$_POST['hargapokok'];
				$hargajual = @$_POST['hargajual'];
				$ppn = @$_POST['ppn'];
				$diskon = @$_POST['diskon'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE buku SET judul = ?, penulis = ?, penerbit = ?, tahun = ?, stok = ?, harga_pokok = ?, harga_jual = ?, ppn = ?, diskon = ? WHERE id_buku = '$id'");
				$array = array($judul, $penulis, $penerbit, $tahun, $stok, $hargapokok, $hargajual, $ppn, $diskon);
				$edit->execute($array);
				if ($edit->rowCount()>0) {
					?>
						<script>
							window.location.href=".?page=buku";
						</script>
					<?php
				}
		}
	} catch (Exception $e) {
		echo "Error " .$e->getMessage();
	}

?>