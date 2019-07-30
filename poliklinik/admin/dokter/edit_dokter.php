<?php  
$kd = @$_GET['kd'];
?>
<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Edit Data Pasien</h3></span>
		<hr>
	</div>
</div>
<?php  
	$tampil = $db->prepare("SELECT * FROM dokter WHERE KdDok = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
			<label for="">Kode Dokter</label>
			<input type="text" class="form-control" value="<?php echo $data->KdDok; ?>" readonly="redonly"  name="kode">
		</div>
		<div class="form-group">
			<label for="">Nama</label>
			<input type="text" class="form-control" value="<?php echo $data->NamaDok; ?>" name="nama">
		</div>
		<div class="form-group">
			<label for="">Alamat</label>
			<input type="text" class="form-control" value="<?php echo $data->AlmDok; ?>" name="alamat">
		</div>
		<div class="form-group">
			<label for="">Telepon</label>
			<input type="text" class="form-control" value="<?php echo $data->TelpDok; ?>" name="telepon">
		</div>
		<div class="form-group">
			<label for="">Kode Poli</label>
			<input type="text" class="form-control" value="<?php echo $data->KdPoli; ?>"  name="poli">
		</div>
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$kode = @$_POST['kode'];
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	$poli = @$_POST['poli'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE dokter SET NamaDok = ?, AlmDok = ? , TelpDok = ?, KdPoli = ? WHERE KdDok = '$kd'");
		$array = array($nama, $alamat, $telepon, $poli);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('dokter'); ?>";
				</script>
			<?php
		}
	}
?>