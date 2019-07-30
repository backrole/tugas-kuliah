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
	$tampil = $db->prepare("SELECT * FROM pasien WHERE NoPasien = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
			<label for="">Nomer</label>
			<input type="text" class="form-control" value="<?php echo $data->NoPasien; ?>" readonly="redonly"  name="nomer">
		</div>
		<div class="form-group">
			<label for="">Nama</label>
			<input type="text" class="form-control" value="<?php echo $data->NamaPas; ?>" name="nama">
		</div>
		<div class="form-group">
			<label for="">Alamat</label>
			<input type="text" class="form-control" value="<?php echo $data->AlmPas; ?>" name="alamat">
		</div>
		<div class="form-group">
			<label for="">Telepon</label>
			<input type="text" class="form-control" value="<?php echo $data->TelpPas; ?>" name="telepon">
		</div>
		<div class="form-group">
			<label for="">Tgl Lahir</label>
			<input type="date" class="form-control" value="<?php echo $data->TglLhrPas; ?>"  name="tgl">
		</div>
		<div class="form-group">
			<label for="">Jenis Kelamin</label>
			<select name="jk" class="form-control" required="required">
				<option value="" disabled selected>Pilih Jenis Kelamin</option>
				<option value="Laki-laki">Laki-Laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$nomer = @$_POST['nomer'];
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	$jk = @$_POST['jk'];
	$tgl = @$_POST['tgl'];
	$reg = @$_POST['reg'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE pasien SET NamaPas = ?, AlmPas = ?, TelpPas = ? , TglLhrPas = ?, JnsKelPas = ? WHERE NoPasien = '$kd'");
		$array = array($nama, $alamat, $telepon, $tgl, $jk);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('pasien'); ?>";
				</script>
			<?php
		}
	}
?>