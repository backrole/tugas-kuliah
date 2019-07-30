<?php  
$kd = @$_GET['kd'];
?>
<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Edit Resep Obat</h3></span>
		<hr>
	</div>
</div>
<?php  
	$tampil = $db->prepare("SELECT * FROM resep WHERE NoResep = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
			<label for="">Nomer Resep</label>
			<input type="text" class="form-control" value="<?php echo $data->NoResep; ?>" readonly="redonly"  name="nomer">
		</div>
		<div class="form-group">
			<label for="">Dosis</label>
			<input type="text" class="form-control" value="<?php echo $data->Dosis; ?>" name="dosis">
		</div>
		<div class="form-group">
			<label for="">Jumlah</label>
			<input type="text" class="form-control" value="<?php echo $data->Jumlah; ?>" name="jumlah">
		</div>
		<div class="form-group">
			<label for="">Kode Obat</label>
			<input type="text" class="form-control" readonly="readonly"> value="<?php echo $data->KdObat; ?>" name="namaobat">
		</div>
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$nomer = @$_POST['nomer'];
	$dosis = @$_POST['dosis'];
	$jumlah = @$_POST['jumlah'];
	$namaobat = @$_POST['namaobat'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE resep SET Dosis = ?, Jumlah = ?, KdObat = ? WHERE NoResep = '$kd'");
		$array = array($dosis, $jumlah, $namaobat);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('resep'); ?>";
				</script>
			<?php
		}
	}
?>