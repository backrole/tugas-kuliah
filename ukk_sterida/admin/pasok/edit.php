<?php  
$id = @$_GET['id'];
?>
<h3 class="text-muted">Edit Data Pasok <i class="fa fa-book"></i></h3> 
<hr>
<?php  
	$show = $db->prepare("SELECT * FROM pasok WHERE id_pasok = '$id'");
	$show->execute();
	$showed = $show->fetch(PDO::FETCH_LAZY);
?>
<form method="POST" role="form">
	<div class="form-group">
		<label for="">ID Distributor</label>
		<input type="text" value="<?php echo $showed->id_pasok; ?>" class="form-control" id="" name="id" readonly>
	</div>
	<div class="form-group">
		<label for="">Nama Distributor</label>
		<select name="id_distributor" id="inputIdbuku" class="form-control" required="required">
							<option value="">Pilh Distributor</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM distributor");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_distributor; ?>"><?php echo $view->nama_distributor; ?></option>
									<?php
								}
							?>
						</select>
	</div>
	<div class="form-group">
		<label for="">Judul Buku</label>
		<select name="id_buku" id="inputIdbuku" class="form-control" required="required">
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
		<label for="">Jumlah</label>
		<input type="text" value="<?php echo $showed->jumlah; ?>" class="form-control" id="" name="jumlah" >
	</div>
	<div class="form-group">
		<label for="">Tanggal</label>
		<input type="date" value="<?php echo $showed->tanggal; ?>" class="form-control" id="" name="tanggal" >
	</div>
	<input type="submit" class="btn btn-primary" name="edit" value="Edit">
</form>

<?php  
				$id = @$_POST['id'];
				$id_distributor = @$_POST['id_distributor'];
				$id_buku = @$_POST['id_buku'];
				$jumlah = @$_POST['jumlah'];
				$tanggal = @$_POST['tanggal'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE pasok SET id_pasok = ?, id_distributor = ?, id_buku = ?, jumlah = ?, tanggal = ? WHERE id_pasok = '$id'");
				$array = array($id, $id_distributor, $id_buku, $jumlah, $tanggal);
				$edit->execute($array);
				if ($edit->rowCount()>0) {
					$plus = $db->prepare("UPDATE buku SET stok = stok + ? WHERE id_buku = '$id_buku' ");
							$plus->execute(array($jumlah));
							if ($plus->rowCount()>0) {
								?>
							<script>
								window.location.href=".?page=pasok";
							</script>
							<?php
							}
				}
		}
	} catch (Exception $e) {
		echo "Error " .$e->getMessage();
	}

?>