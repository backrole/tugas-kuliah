<h3 class="text-muted">Tambah Data Pasok</h3>
<hr>
<form method="post">
	<div class="form-group col-sm-6">
		<label>Nama Distributor</label>
		<select class="form-control" name="distributor">
			<option value=""> ==> Pilih Distributor <== </option>
		<?php  
			$show = $db->prepare("SELECT * FROM distributor");
			$show->execute();
			while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
				?>
					<option value="<?php echo $showed->id_distributor; ?>"><?php echo $showed->nama_distributor; ?></option>
				<?php
			}
		?>
			
		</select>
	</div>
	<div class="form-group col-sm-6">
		<label>Nama Buku</label>
		<select class="form-control" name="buku">
			<option value=""> ==> Pilih Judul Buku <== </option>
		<?php  
			$show = $db->prepare("SELECT * FROM buku");
			$show->execute();
			while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
				?>
					<option value="<?php echo $showed->id_buku; ?>"><?php echo $showed->judul; ?></option>
				<?php
			}
		?>
			
		</select>
	</div>
	<div class="form-group col-sm-6">
		<label>Jumlah</label>
		<input type="text" name="jumlah" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Tanggal</label>
		<input type="date" class="form-control" name="tanggal">
	</div>
	<div class="form-group col-sm-6">
		<input type="reset" class="btn btn-danger">
		<input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
	</div>
</form>
<?php  
	$buku = @$_POST['buku'];
	$distributor = @$_POST['distributor'];
	$jumlah = @$_POST['jumlah'];
	$tanggal = @$_POST['tanggal'];	
	try {
		if (@$_POST['tambah']) {
			$tambah = $db->prepare("INSERT INTO pasok (id_distributor, id_buku, jumlah, tanggal) VALUES(?,?,?,?)");
			$array = array($distributor, $buku, $jumlah, $tanggal);
			$tambah->execute($array);
			if ($tambah->rowCount()>0) {
				$update = $db->prepare("UPDATE buku SET stok = stok + ? WHERE id_buku = $buku");
				$update->execute(array($jumlah));
				?>
					<script type="text/javascript">
						window.location.href=".?page=pasok";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>