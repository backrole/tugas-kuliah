<h3 class="text-muted">Edit Data Kasir</h3>
<hr>
<form method="post">
	<?php  
		$id = @$_GET['id'];
		$show = $db->prepare("SELECT * FROM kasir WHERE id_kasir = ?");
		$show->execute(array($id));
		$data = $show->fetch(PDO::FETCH_LAZY);
	?>
	<div class="form-group col-sm-6">
		<label>ID Kasir</label>
		<input type="text" value="<?php echo $data->id_kasir; ?>" name="id" required class="form-control" readonly>
	</div>
	<div class="form-group col-sm-6">
		<label>Nama Kasir</label>
		<input type="text" value="<?php echo $data->nama; ?>" name="nama" required class="form-control">
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
		<label>Status</label>
		<input type="text" value="<?php echo $data->status; ?>" name="status" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Level</label>
		<input type="text" value="<?php echo $data->akses; ?>" name="akses" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<button name="edit" value="Edit" class="btn btn-primary">Edit <i class="fa fa-send"></i></button>
		<a href=".?page=kasir" class="btn btn-danger">Cancel</a>
	</div>
</form>
<?php  
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	$status = @$_POST['status'];
	$akses = @$_POST['akses'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE kasir SET nama = ?, alamat = ?, telepon = ?, status = ?, akses = ? WHERE id_kasir = $id");
			$array = array($nama, $alamat, $telepon,$status, $akses);
			$edit->execute($array);
			if ($edit->rowCount()>0) {
				?>
					<script type="text/javascript">
						window.location.href=".?page=kasir";
					</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo "Failed " .$e->getMessage();
	}
?>