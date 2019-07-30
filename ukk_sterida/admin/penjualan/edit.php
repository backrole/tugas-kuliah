<?php  
$id = @$_GET['id'];
?>
<h3 class="text-muted">Edit Data Penjualan <i class="fa fa-book"></i></h3> 
<hr>
<?php  
	$show = $db->prepare("SELECT * FROM penjualan WHERE id_penjualan = '$id'");
	$show->execute();
	$showed = $show->fetch(PDO::FETCH_LAZY);
?>
<form method="POST" role="form">
	<div class="form-group">
		<label for="">ID Kasir</label>
		<input type="text" value="<?php echo $showed->id_penjualan; ?>" class="form-control" id="" name="id" readonly>
	</div>
	<div class="form-group">
		<label for="">ID Buku</label>
		<select name="idbuku" id="inputIdbuku" class="form-control" required="required">
							<option value="">Pilh Buku</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM buku");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_buku; ?>"><?php echo $view->judul; ?></option>
									<?php
								}
							?>
						</select>
	</div>
	<div class="form-group">
		<label for="">ID Kasir</label>
		<select name="idkasir" id="inputIdKasir" class="form-control" required="required">
							<option value="">Pilh Petugas Kasir</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM kasir");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_kasir; ?>"><?php echo $view->nama; ?></option>
									<?php
								}
							?>
						</select>
	</div>
	<div class="form-group">
		<label for="">Jumlah</label>
		<input type="text" value="<?php echo $showed->jumlah; ?>" class="form-control" id="" name="jumlah" >
	</div>
	<div class="form-group">
		<label for="">Total</label>
		<input type="text" value="<?php echo $showed->total; ?>" class="form-control" id="" name="total" >
	</div>
	<div class="form-group">
		<label for="">Tanggal</label>
		<input type="date" value="<?php echo $showed->tanggal; ?>" class="form-control" id="" name="tanggal" >
	</div>
		<input type="submit" class="btn btn-primary" name="edit" value="Edit">
</form>

<?php  
				$id = @$_POST['id'];
				$idbuku = @$_POST['idbuku'];
				$idkasir = @$_POST['idkasir'];
				$jumlah = @$_POST['jumlah'];
				$total = @$_POST['total'];
				$tanggal = @$_POST['tanggal'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE penjualan SET id_buku = ?, id_kasir = ?, jumlah = ?, total = ?, tanggal = ? WHERE id_penjualan = '$id'");
				$array = array($idbuku, $idkasir, $jumlah, $total, $tanggal);
				$edit->execute($array);
				if ($edit->rowCount()>0) {
					?>
						<script>
							window.location.href=".?page=penjualan";
						</script>
					<?php
				}
		}
	} catch (Exception $e) {
		echo "Error " .$e->getMessage();
	}

?>