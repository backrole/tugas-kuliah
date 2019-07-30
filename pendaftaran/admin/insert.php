<form method="post" role="form">
				<legend>Pendaftaran</legend>

				<div class="form-group">
					<label for="">No Identitas</label>
					<input type="text" class="form-control" id="" required name="no_indentitas">
				</div>

				<div class="form-group">
					<label for="">Audisi</label>
					<select name="audisi" id="" required class="form-control">
						<option value="" selected="selected" disabled="disabled">Pilih Lokasi</option>
						<?php  
				          $tampil = $db->query("SELECT * FROM audisi");
				          $tampil->execute();
				          while ($data = $tampil->fetch(PDO::FETCH_LAZY)) {
				           ?>
				           <option value="<?php echo $data->lokasi; ?>"><?php echo $data->lokasi; ?></option>
				           <?php  
				           }
				           ?>
					</select>
				</div>

				<div class="form-group">
					<label for="">Nama</label>
					<input type="text" class="form-control" id="" required name="nama">
				</div>
				<div class="form-group">
					<label for="">Jenis Kelamin</label>
					<select name="jk" id="" required class="form-control">
						<option value="" selected="selected" disabled="disabled">Pilih Jenis Kelamin</option>
						<option value="laki-laki" >Laki-Laki</option>
						<option value="perempuan" >Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="" required class="form-control">
						<option value="" selected="selected" disabled="disabled">Pilih Status</option>
						<option value="belum menikah" >Belum Menikah</option>
						<option value="menikah" >Menikah</option>
						<option value="pernah menikah" >Pernah Menikah</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tempat Lahir</label>
					<input type="text" class="form-control" id="" name="tempat_lahir" required>
				</div>
				<div class="form-group">
					<label for="">Tanggal Lahir</label>
					<input type="date" class="form-control" id="" name="tgl_lahir" required>
				</div>
				<div class="form-group">
					<label for="">Alamat</label>
					<input type="text" class="form-control" id="" name="alamat" required>
				</div>
				<div class="form-group">
					<label for="">Kota</label>
					<input type="text" class="form-control" id="" name="kota" required>
				</div>
				<div class="form-group">
					<label for="">Provinsi</label>
					<select name="provinsi" id="" required class="form-control">
						<option value="" selected="selected" disabled="disabled">Pilih Provinsi</option>
						<?php
						$tampil = $db->query("SELECT * FROM t_provinsi");
						$tampil->execute();
						while ($data = $tampil->fetch(PDO::FETCH_LAZY)) {
							?>
							<option value="<?php echo $data->nama; ?>"><?php echo $data->nama; ?></option>
							<?php  
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Kode Pos</label>
					<input type="text" class="form-control" id="" name="kode_pos" required>
				</div>
				<div class="form-group">
					<label for="">Pekerjaan</label>
					<input type="text" class="form-control" id="" name="pekerjaan" required>
				</div>
				<div class="form-group">
					<label for="">Telepon</label>
					<input type="text" class="form-control" id="" name="telepon" required>
				</div>

				<button type="submit" name="kirim" value="kirim" class="btn btn-primary">Send</button>
				<input type="reset" value="Reset" class="btn btn-danger">
			</form>
<?php 
$nama = @$_POST['nama'];
$audisi = @$_POST['audisi'];
$jk = @$_POST['jk'];
$status = @$_POST['status'];
$tempat_lahir = @$_POST['tempat_lahir'];
$tgl_lahir = @$_POST['tgl_lahir'];
$kota = @$_POST['kota'];
$telepon = @$_POST['telepon'];
$pekerjaan = @$_POST['pekerjaan'];
$kode_pos = @$_POST['kode_pos'];
$alamat = @$_POST['alamat'];
$provinsi = @$_POST['provinsi'];
$no_indentitas = @$_POST['no_indentitas'];

if (@$_POST['kirim']) {
	$insert = $db->prepare("INSERT INTO daftar (audisi, nama, jk, status, tempat_lahir, tgl_lahir, no_identitas, alamat, kota, provinsi, kode_pos, pekerjaan, telepon) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$insert->execute(array($audisi, $nama, $jk, $status, $tempat_lahir, $tgl_lahir, $no_indentitas, $alamat, $kota, $provinsi, $kode_pos, $pekerjaan, $telepon));
	if ($insert->rowCount()>0) {
		?>
			<script>
			alert("SUKSES DAFTAR!");
				</script>
		<?php
	}
}
?>
<br>
<br>
