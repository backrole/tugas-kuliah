<h3 class="text-muted">Edit Data Buku</h3>
<hr>
<form method="post">
	<?php  
		$id = @$_GET['id'];
		$show = $db->prepare("SELECT * FROM buku WHERE id_buku = ?");
		$show->execute(array($id));
		$data = $show->fetch(PDO::FETCH_LAZY);
	?>
	<div class="form-group col-sm-6">
		<label>NO ISBN</label>
		<input type="text" value="<?php echo $data->noisbn; ?>" name="noisbn" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Judul Buku</label>
		<input type="text" value="<?php echo $data->judul; ?>" name="judul" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Penulis</label>
		<input type="text" value="<?php echo $data->penulis; ?>" name="penulis" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Penerbit</label>
		<input type="text" value="<?php echo $data->penerbit; ?>" name="penerbit" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Tahun</label>		
		<input type="text" value="<?php echo $data->tahun; ?>" name="tahun" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Stok</label>
		<input type="text" value="<?php echo $data->stok; ?>" name="stok" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Harga Pokok</label>
		<input type="text" value="<?php echo $data->harga_pokok; ?>" name="hargapokok" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Harga Jual</label>
		<input type="text" value="<?php echo $data->harga_jual; ?>" name="hargajual" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>PPN</label>
		<input type="text" value="<?php echo $data->ppn; ?>" name="ppn" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Diskon</label>
		<input type="text" value="<?php echo $data->diskon; ?>" name="diskon" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<button name="edit" value="Edit" class="btn btn-primary">Edit <i class="fa fa-send"></i></button>
		<a href=".?page=buku" class="btn btn-danger">Cancel</a>
	</div>
</form>
<?php  
	$nosibn = @$_POST['noisbn'];
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
			$edit = $db->prepare("UPDATE buku SET judul = ?, noisbn = ?, penulis = ?, penerbit = ?, tahun = ?, stok = ? , harga_pokok = ?, harga_jual = ?, ppn = ?, diskon = ? WHERE id_buku = $id");
			$array = array($judul, $nosibn, $penulis, $penerbit, $tahun, $stok, $hargapokok, $hargajual, $ppn, $diskon);
			$edit->execute($array);
			if ($edit->rowCount()>0) {
				?>
					<script type="text/javascript">
						window.location.href=".?page=buku";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>