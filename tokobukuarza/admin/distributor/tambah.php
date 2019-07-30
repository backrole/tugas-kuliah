<h3 class="text-muted">Tambah Data Distributor</h3>
<hr>
<form method="post">
	<div class="form-group col-sm-12">
		<label>Nama Distributor</label>
		<input type="text" name="nama" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Alamat</label>
		<input type="text" name="alamat" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Telepon</label>
		<input type="text" name="telepon" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<input type="reset" class="btn btn-danger">
		<input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
	</div>
</form>
<?php  
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	try {
		if (@$_POST['tambah']) {
			$tambah = $db->prepare("INSERT INTO distributor (nama_distributor, alamat, telepon) VALUES(?,?,?)");
			$array = array($nama, $alamat, $telepon);
			$tambah->execute($array);
			if ($tambah->rowCount()>0) {
				?>
					<script type="text/javascript">
						window.location.href=".?page=distributor";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>