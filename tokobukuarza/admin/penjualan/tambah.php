<h3 class="text-muted">Tambah Data Penjualan</h3>
<hr>
<form method="post">
	<div class="form-group col-sm-12">
		<label>Nama Buku</label>
		<select class="form-control" name="buku">
			<option value=""> ==> Pilih Buku <== </option>
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
		<label>Nama Kasir</label>
		<select class="form-control" name="kasir">
			<option value=""> ==> Pilih Petugas Kasir <== </option>
		<?php  
			$show = $db->prepare("SELECT * FROM kasir");
			$show->execute();
			while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
				?>
					<option value="<?php echo $showed->id_kasir; ?>"><?php echo $showed->nama; ?></option>
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
		<label>Total</label>
		<input type="text" name="total" required class="form-control">
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
	$kasir = @$_POST['kasir'];
	$jumlah = @$_POST['jumlah'];
	$total = @$_POST['total'];
	$tanggal = @$_POST['tanggal'];	
	try {
		if (@$_POST['tambah']) {
			$tambah = $db->prepare("INSERT INTO penjualan (id_buku, id_kasir, jumlah, total, tanggal) VALUES(?,?,?,?,?)");
			$array = array($buku, $kasir, $jumlah, $total, $tanggal);
			$tambah->execute($array);
			if ($tambah->rowCount()>0) {
				$update = $db->prepare("UPDATE buku SET stok = stok - ? WHERE id_buku = $buku");
				$update->execute(array($jumlah));
				?>
					<script type="text/javascript">
						window.location.href=".?page=penjualan";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>