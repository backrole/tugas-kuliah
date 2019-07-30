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
	$tampil = $db->prepare("SELECT * FROM jadwalpraktek WHERE KdJadwal = '$kd'");
	$tampil->execute();
	$data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="container">
	<form method="POST" role="form">
		<div class="form-group">
						<label for="">Kode Jadwal</label>
						<input type="text" class="form-control" readonly="readonly" value="<?php echo $data->KdJadwal; ?>" name="kode">
					</div>
					<div class="form-group">
						<label for="">Hari</label>
						<input type="text" class="form-control" value="<?php echo $data->Hari; ?>" name="hari">
					</div>
					<div class="form-group">
						<label for="">Jam Mulai</label>
						<input type="time" class="form-control" value="<?php echo $data->JamMulai; ?>" name="jammul">
					</div>
					<div class="form-group">
						<label for="">Jam Selesai</label>
						<input type="time" class="form-control" value="<?php echo $data->JamSelesai; ?>" name="jamsel">
					</div>
					<div class="form-group">
						<label for="">Kode Dokter</label>
						<select name="kddok" id="input" class="form-control" required="required">
							<option value="">Pilih Dokter</option>
							<?php  
								$ta = $db->query("SELECT * FROM dokter");
								$ta->execute();
								while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
									?>
									<option value="<?php echo $da->KdDok; ?>"><?php echo $da->NamaDok; ?></option>
									<?php
								}
							?>
						</select>
					</div>
		<!-- <input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input> -->
		<button type="submit" name="edit" class="btn btn-primary" value="submit">Save changes</button>
	</form>
</div>			
<?php  
	$kode = @$_POST['kode'];
	$hari = @$_POST['hari'];
	$jamsel = @$_POST['jamsel'];
	$jammul = @$_POST['jammul'];
	$kddok = @$_POST['kddok'];

	if (@$_POST['edit']) {
		$upd = $db->prepare("UPDATE jadwalpraktek SET Hari = ?, JamMulai = ? , JamSelesai = ?, KdDokter = ? WHERE KdJadwal = '$kd'");
		$array = array($hari, $jammul, $jamsel, $kddok);
		$upd->execute($array);
		if ($upd->rowCount()>0) {
			?>
				<script>
					window.location.href=".?page=<?php echo encrypt('jadwal'); ?>";
				</script>
			<?php
		}
	}
?>