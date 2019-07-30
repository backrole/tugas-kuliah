<h3 class="text-muted">Edit Data Distributor</h3>
<hr>
<form method="post">
	<?php  
		$id = @$_GET['id'];
		$show = $db->prepare("SELECT * FROM distributor WHERE id_distributor = ?");
		$show->execute(array($id));
		$data = $show->fetch(PDO::FETCH_LAZY);
	?>
	<div class="form-group col-sm-6">
		<label>ID Distributor</label>
		<input type="text" value="<?php echo $data->id_distributor; ?>" name="id" required class="form-control" readonly>
	</div>
	<div class="form-group col-sm-6">
		<label>Nama Distributor</label>
		<input type="text" value="<?php echo $data->nama_distributor; ?>" name="nama" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Alamat</label>
		<input type="text" value="<?php echo $data->alamat; ?>" name="alamat" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Telepon</label>
		<input type="text" value="<?php echo $data->telepon; ?>" name="telepon" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<button name="edit" value="Edit" class="btn btn-primary">Edit <i class="fa fa-send"></i></button>
		<a href=".?page=distributor" class="btn btn-danger">Cancel</a>
	</div>
</form>
<?php  
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE distributor SET nama_distributor = ?, alamat = ?, telepon = ? WHERE id_distributor = $id");
			$array = array($nama, $alamat, $telepon);
			$edit->execute($array);
			if ($edit->rowCount()>0) {
				?>
					<script type="text/javascript">
						window.location.href=".?page=distributor";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>