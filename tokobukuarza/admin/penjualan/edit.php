<h3 class="text-muted">Edit Data Penjualan</h3>
<hr>
<form method="post">
	<?php  
		$id = @$_GET['id'];
		$show = $db->prepare("SELECT * FROM penjualan WHERE id_penjualan = ?");
		$show->execute(array($id));
		$data = $show->fetch(PDO::FETCH_LAZY);
	?>
	<div class="form-group col-sm-6">
		<label>ID Penjualan</label>
		<input type="text" value="<?php echo $data->id_penjualan; ?>" name="id" required class="form-control" readonly>
	</div>
	<div class="form-group col-sm-6">
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
		<input type="text" value="<?php echo $data->jumlah; ?>" name="jumlah" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Total</label>
		<input type="text" value="<?php echo $data->total; ?>" name="total" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Tanggal</label>
		<input type="date" value="<?php echo $data->tanggal; ?>" name="tanggal" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<button name="edit" value="Edit" class="btn btn-primary">Edit <i class="fa fa-send"></i></button>
		<a href=".?page=penjualan" class="btn btn-danger">Cancel</a>
	</div>
</form>
<?php  
	$buku = @$_POST['buku'];
	$kasir = @$_POST['kasir'];
	$jumlah = @$_POST['jumlah'];
	$total = @$_POST['total'];
	$tanggal = @$_POST['tanggal'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE penjualan SET id_buku = ?, id_kasir = ?, jumlah = ?, total = ?, tanggal = ? WHERE id_penjualan = $id");
			$array = array($buku, $kasir, $jumlah,$total, $tanggal);
			$edit->execute($array);
			if ($edit->rowCount()>0) {
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