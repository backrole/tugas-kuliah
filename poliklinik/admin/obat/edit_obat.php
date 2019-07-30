<?php  
$kd = @$_GET['kd'];
?>
<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Edit Data Obat</h3></span>
		<hr>
	</div>
</div>
<?php  
	$tampil = $db->prepare("SELECT * FROM obat WHERE KdObat = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
			<label for="">Kode Obat</label>
			<input type="text" class="form-control" value="<?php echo $data->KdObat; ?>" readonly="redonly"  name="nomer">
		</div>
		<div class="form-group">
			<label for="">Nama Obat</label>
			<input type="text" class="form-control" value="<?php echo $data->NamaObt; ?>" name="nama">
		</div>
		<div class="form-group">
			<label for="">Merk</label>
			<input type="text" class="form-control" value="<?php echo $data->Merk; ?>" name="merk">
		</div>
		<div class="form-group">
			<label for="">Satuan</label>
			<input type="text" class="form-control" value="<?php echo $data->Satuan; ?>" name="satuan">
		</div>
		<div class="form-group">
			<label for="">Harga Jual</label>
			<input type="text" class="form-control" value="<?php echo $data->HargaJual; ?>"  name="hargajual">
		</div>
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$nomer = @$_POST['nomer'];
	$nama = @$_POST['nama'];
	$merk = @$_POST['merk'];
	$satuan = @$_POST['satuan'];
	$hargajual = @$_POST['hargajual'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE obat SET NamaObt = ?, Merk = ?, Satuan = ? , HargaJual = ? WHERE KdObat = '$kd'");
		$array = array($nama, $merk, $satuan, $hargajual);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('obat'); ?>";
				</script>
			<?php
		}
	}
?>