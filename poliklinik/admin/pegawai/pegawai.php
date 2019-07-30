<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Pegawai</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Pegawai</a>
		</div>

	</div>
</div>
<div class="container">
	<div class="row col-md-12">
		<!-- Tabel -->
		<br>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>NIP</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Telp</th>
					<th>Tgl Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM pegawai");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->NIP; ?></td>
						<td><?php echo $data->NamaPeg; ?></td>
						<td><?php echo $data->AlmPeg; ?></td>
						<td><?php echo $data->TelpPeg; ?></td>
						<td><?php echo $data->TglLhrPeg; ?></td>
						<td><?php echo $data->JnsKelPeg; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('pegawai'); ?>&action=edit&kd=<?php echo $data->NIP; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('pegawai'); ?>&action=hapus&kd=<?php echo $data->NIP; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- MODAL-->

<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Pasien</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					
					<div class="form-group">
						<label for="">NIP</label>
						<input type="text" class="form-control"  name="nip">
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control"  name="nama">
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<input type="text" class="form-control"  name="alamat">
					</div>
					<div class="form-group">
						<label for="">Telepon</label>
						<input type="text" class="form-control" name="telepon">
					</div>
					<div class="form-group">
						<label for="">Tgl Lahir</label>
						<input type="date" class="form-control"  name="tgl">
					</div>
					<div class="form-group">
						<select name="jk" id="inputJk" class="form-control" required="required">
							<option value="">Pilih Jenis Kelamin</option>
							<option value="Laki-laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="tambah" class="btn btn-primary" value="submit">Save changes</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php  
$nip = @$_POST['nip'];
$nama = @$_POST['nama'];
$alamat = @$_POST['alamat'];
$telepon = @$_POST['telepon'];
$tgl = @$_POST['tgl'];
$jk = @$_POST['jk'];

try {
	if (@$_POST['tambah']) {
	$ins = $db->prepare("INSERT INTO pegawai (NIP, NamaPeg, AlmPeg, TelpPeg, TglLhrPeg, JnsKelPeg) VALUES (?,?,?,?,?,?)");
	$array = array($nip, $nama, $alamat, $telepon, $tgl, $jk);
	$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('pegawai'); ?>";
			</script>
			<?php
		} else {
			?>
			<script>
				alert("gagal");
			</script>
			<?php
		}
	}
} catch (Exception $e) {
	echo "Gagal Tambah Data Pegawai! ".$e->getMessage();
}
?>

<!-- MODAL EDIT -->

