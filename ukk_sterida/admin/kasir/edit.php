<?php  
$id = @$_GET['id'];
?>
<h3 class="text-muted">Edit Data Kasir <i class="fa fa-book"></i></h3> 
<hr>
<?php  
	$show = $db->prepare("SELECT * FROM kasir WHERE id_kasir = '$id'");
	$show->execute();
	$showed = $show->fetch(PDO::FETCH_LAZY);
?>
<form method="POST" role="form">
	<div class="form-group">
		<label for="">ID Kasir</label>
		<input type="text" value="<?php echo $showed->id_kasir; ?>" class="form-control" id="" name="idkasir" readonly>
	</div>
	<div class="form-group">
		<label for="">Nama</label>
		<input type="text" value="<?php echo $showed->nama; ?>" class="form-control" id="" name="nama" >
	</div>
	<div class="form-group">
		<label for="">Alamat</label>
		<input type="text" value="<?php echo $showed->alamat; ?>" class="form-control" id="" name="alamat" >
	</div>
	<div class="form-group">
		<label for="">Telepon</label>
		<input type="text" value="<?php echo $showed->telepon; ?>" class="form-control" id="" name="telepon" >
	</div>
	<div class="form-group">
		<label for="">Status</label>
		<input type="text" value="<?php echo $showed->status; ?>" class="form-control" id="" name="status" >
	</div>
	<div class="form-group">
		<label for="">Akses</label>
		<select name="akses" id="inputAkses" class="form-control" required="required">
							<option value="admin" >ADMIN</option>
							<option value="kasir" <?php if ($showed->akses == "kasir") {
								echo "selected";
							} ?> >KASIR</option>
						</select>
	</div>
		<input type="submit" class="btn btn-primary" name="edit" value="Edit">
</form>

<?php  
				$id = @$_POST['idkasir'];
				$nama = @$_POST['nama'];
				$alamat = @$_POST['alamat'];
				$telepon = @$_POST['telepon'];
				$status = @$_POST['status'];
				$username = @$_POST['username'];
				$password = @$_POST['password'];
				$akses = @$_POST['akses'];
	try {
		if (@$_POST['edit']) {
			$edit = $db->prepare("UPDATE kasir SET nama = ?, alamat = ?, telepon = ?, status = ?, akses = ? WHERE id_kasir = '$id'");
				$array = array($nama, $alamat, $telepon, $status, $akses);
				$edit->execute($array);
				if ($edit->rowCount()>0) {
					?>
						<script>
							window.location.href=".?page=kasir";
						</script>
					<?php
				}
		}
	} catch (Exception $e) {
		echo "Error " .$e->getMessage();
	}

?>