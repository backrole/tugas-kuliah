<?php  
$id = @$_GET['id'];
?>
<h3 class="text-muted">Edit Data Distributor <i class="fa fa-book"></i></h3> 
<hr>
<?php  
	$show = $db->prepare("SELECT * FROM distributor WHERE id_distributor = '$id'");
	$show->execute();
	$showed = $show->fetch(PDO::FETCH_LAZY);
?>
<form method="POST" role="form">
	<div class="form-group">
		<label for="">ID Distributor</label>
		<input type="text" value="<?php echo $showed->id_distributor; ?>" class="form-control" id="" name="id" readonly>
	</div>
	<div class="form-group">
		<label for="">Nama Distributor</label>
		<input type="text" value="<?php echo $showed->nama_distributor; ?>" class="form-control" id="" name="nama" >
	</div>
	<div class="form-group">
		<label for="">Alamat</label>
		<input type="text" value="<?php echo $showed->alamat; ?>" class="form-control" id="" name="alamat" >
	</div>
	<div class="form-group">
		<label for="">Telepon</label>
		<input type="text" value="<?php echo $showed->telepon; ?>" class="form-control" id="" name="telepon" >
	</div>
	<input type="submit" class="btn btn-primary" name="edit" value="Edit">
</form>

<?php  
				$id = @$_POST['id'];
				$nama = @$_POST['nama'];
				$alamat = @$_POST['alamat'];
				$telepon = @$_POST['telepon'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE distributor SET nama_distributor = ?, alamat = ?, telepon = ? WHERE id_distributor = '$id'");
				$array = array($nama, $alamat, $telepon);
				$edit->execute($array);
				if ($edit->rowCount()>0) {
					?>
						<script>
							window.location.href=".?page=distributor";
						</script>
					<?php
				}
		}
	} catch (Exception $e) {
		echo "Error " .$e->getMessage();
	}

?>