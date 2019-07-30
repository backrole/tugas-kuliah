<h3 class="text-muted">Tambah Data Kasir</h3>
<hr>
<form method="post">
	<div class="form-group col-sm-12">
		<label>Nama Kasir</label>
		<input type="text" name="nama" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Alamat</label>
		<input type="text" name="alamat" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Telepon</label>
		<input type="text" name="telepon" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Username</label>
		<input type="text" name="username" required class="form-control" placeholder="Isikan Nama Depan Kasir Yang Akan Di Daftarkan">
	</div>
	<div class="form-group col-sm-6">
		<label>Password</label>
		<input type="password" name="password" required class="form-control" placeholder="Isikan Nama Depan Kasir Yang Akan Di Daftarkan">
	</div>
	<div class="form-group col-sm-6">
		<label>Status</label>
		<input type="text" name="status" required class="form-control">
	</div>
	<div class="form-group col-sm-6">
		<label>Akses</label>
		<select class="form-control" name="akses">
			<option value=""> ==> Pilih Hak Akses <== </option>
			<option value="admin">Admin</option>
			<option value="kasir">Kasir</option>
		</select>
	</div>
	<div class="form-group col-sm-6">
		<input type="reset" class="btn btn-danger">
		<input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
	</div>
</form>
<?php  
	$nama = @$_POST['nama'];
	$alamat = @$_POST['alamat'];
	$telepon = @$_POST['telepon'];
	$status = @$_POST['status'];
	$username = @$_POST['username'];
	$password = base64_encode(@$_POST['password']);
	$akses = @$_POST['akses'];	
	try {
		if (@$_POST['tambah']) {
			$tambah = $db->prepare("INSERT INTO kasir (nama, alamat, telepon, username, password, status, akses) VALUES(?,?,?,?,?,?,?)");
			$array = array($nama, $alamat, $telepon, $username, $password, $status, $akses);
			$tambah->execute($array);
			if ($tambah->rowCount()>0) {
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