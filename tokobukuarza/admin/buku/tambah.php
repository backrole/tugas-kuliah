<h3 class="text-muted">Tambah Data Buku</h3>
<hr>
<form method="post">
	<div class="form-group col-sm-6">
		<label>NO ISBN</label>
		<input type="text" name="noisbn" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Judul Buku</label>
		<input type="text" name="judul" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Penulis</label>
		<input type="text" name="penulis" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Penerbit</label>
		<input type="text" name="penerbit" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Tahun</label>		
		<input type="text" name="tahun" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Harga Pokok</label>
		<input type="text" name="hargapokok" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Harga Jual</label>
		<input type="text" name="hargajual" required class="form-control">
	</div>
	<div class="form-group col-sm-3">
		<label>PPN</label>
		<input type="text" name="ppn" required class="form-control">
	</div>
	<div class="form-group col-sm-3">
		<label>Diskon</label>
		<input type="text" name="diskon" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<input type="reset" class="btn btn-danger">
		<input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
	</div>
</form>
<?php  
	$nosibn = @$_POST['noisbn'];
	$judul = @$_POST['judul'];
	$penulis = @$_POST['penulis'];
	$penerbit = @$_POST['penerbit'];
	$tahun = @$_POST['tahun'];
	$hargapokok = @$_POST['hargapokok'];
	$hargajual = @$_POST['hargajual'];
	$ppn = @$_POST['ppn'];
	$diskon = @$_POST['diskon'];
	try {
		if (@$_POST['tambah']) {
			$tambah = $db->prepare("INSERT INTO buku (judul, noisbn, penulis, penerbit,tahun, harga_pokok, harga_jual, ppn, diskon) VALUES(?,?,?,?,?,?,?,?,?) ");
			$array = array($judul, $nosibn, $penulis, $penerbit, $tahun, $hargapokok, $hargajual, $ppn, $diskon);
			$tambah->execute($array);
			if ($tambah->rowCount()>0) {
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