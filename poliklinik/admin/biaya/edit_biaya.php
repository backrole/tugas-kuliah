<?php  
$kd = @$_GET['kd'];
?>
<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Edit Jenis Biaya</h3></span>
		<hr>
	</div>
</div>
<?php  
	$tampil = $db->prepare("SELECT * FROM jenisbiaya WHERE IDJenisBiaya = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
			<label for="">Nomer</label>
			<input type="text" class="form-control" value="<?php echo $data->IDJenisBiaya; ?>" readonly="redonly"  name="id">
		</div>
		<div class="form-group">
			<label for="">Nama Biaya</label>
			<input type="text" class="form-control" value="<?php echo $data->NamaBiaya; ?>" name="nama">
		</div>
		<div class="form-group">
			<label for="">Tarif</label>
			<input type="text" class="form-control" value="<?php echo $data->Tarif; ?>" name="tarif">
		</div>
		<div class="form-group">
			<label for="">No Pendaftar</label>
			<input type="text" class="form-control" readonly="readonly" value="<?php echo $data->NoPendaftaran; ?>" name="nopen">
		</div>
		
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
	$tarif = @$_POST['tarif'];
	$nopen = @$_POST['nopen'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE jenisbiaya SET NamaBiaya = ?, Tarif = ?, NoPendaftaran = ? WHERE IDJenisBiaya = '$kd'");
		$array = array($id, $nama, $tarif, $nopen);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('biaya'); ?>";
				</script>
			<?php
		}
	}
?>