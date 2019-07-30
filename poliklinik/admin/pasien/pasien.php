<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Pasien</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Pasien</a>
			<a data-toggle="modal" href='#modal-id1' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Daftarkan Pasien</a>
			<a href=".?page=<?php echo encrypt('pasien'); ?>&action=<?php echo encrypt('lihatpendaftar'); ?>" class="btn btn-info"><span class="fa fa-list"></span>&nbsp;Lihat Pasien Terdaftar</a>
		</div>

	</div>
</div>
<div class="container">
	<div class="row col-md-12">
		<!-- Tabel -->
		<br>
		<script type="text/javascript">
		  $(document).ready(function(){
		    $("#tabel").dataTable();
		  });
		</script>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Telp</th>
					<th>Tgl Registrasi</th>
					<th>Jenis Kelamin</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM pasien ORDER BY NoPasien DESC");
				$tampil->execute();
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $data->NoPasien; ?></td>
						<td><?php echo $data->NamaPas; ?></td>
						<td><?php echo $data->AlmPas; ?></td>
						<td><?php echo $data->TelpPas; ?></td>
						<td><?php echo $data->TglRegistrasi; ?></td>
						<td><?php echo $data->JnsKelPas; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('pasien'); ?>&action=<?php echo encrypt('edit'); ?>&kd=<?php echo $data->NoPasien; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('pasien'); ?>&action=<?php echo encrypt('hapus'); ?>&kd=<?php echo $data->NoPasien; ?>" class="btn btn-danger hapus"><span class="fa fa-trash"></span></a>
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
					<?php  
					$tampil = $db->query("SELECT SUBSTR(MAX(NoPasien),4,6)AS max_id FROM pasien");
					$tampil->execute();
					$data =$tampil->fetch(PDO::FETCH_LAZY);
					$id_max =$data->max_id;
					$sort_num = (int) substr($id_max, 0, 8);
					$sort_num++;
					$new_code = sprintf("%03s", $sort_num);
					$angkaformat="PAS".$new_code;
					?>
					<div class="form-group">
						<label for="">Nomer</label>
						<input type="text" class="form-control" value="<?php echo $angkaformat; ?>" readonly name="nomer">
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
						<label for="">Jenis Kelamin</label>
						<select name="jk" class="form-control" required="required">
							<option value="" disabled selected>Pilih Jenis Kelamin</option>
							<option value="Laki-laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<input type="hidden" name="reg" value="<?php echo date("d-m-y"); ?>"></input>
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
$nomer = @$_POST['nomer'];
$nama = @$_POST['nama'];
$alamat = @$_POST['alamat'];
$telepon = @$_POST['telepon'];
$jk = @$_POST['jk'];
$tgl = @$_POST['tgl'];
$reg = @$_POST['reg'];

try {
	if (@$_POST['tambah']) {
		$ins = $db->prepare("INSERT INTO pasien (NoPasien, NamaPas, AlmPas,TelpPas, TglLhrPas, JnsKelPas, TglRegistrasi) VALUES (?,?,?,?,?,?,?)");
		$array = array($nomer, $nama, $alamat, $telepon, $tgl, $jk, $reg);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('pendaftaran'); ?>php echo encrypt('pasien'); ?>";
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
	echo "Gagal Tambah Data Pasien! ".$e->getMessage();
}
?>

<!-- MODAL EDIT -->



<div class="modal fade" id="modal-id1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Daftarkan Pasien</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
					$tampil = $db->query("SELECT SUBSTR(MAX(NoPendaftaran),4,6)AS max_id FROM pendaftaran");
					$tampil->execute();
					$data =$tampil->fetch(PDO::FETCH_LAZY);
					$id_max =$data->max_id;
					$sort_num = (int) substr($id_max, 0, 8);
					$sort_num++;
					$new_code = sprintf("%03s", $sort_num);
					$angkaformat="DTR".$new_code;
					?>
					<div class="form-group">
						<label for="">No Pendaftaran</label>
						<input type="text" class="form-control" readonly value="<?php echo $angkaformat; ?>" name="nomer">
					</div>
					<div class="form-group">
						<label for="">Tgl Pendaftaran</label>
						<input type="date" class="form-control"  name="tgl">
					</div>
					<div class="form-group">
						<label for="">No Urut</label>
						<input type="text" class="form-control"  name="NoUrut">
					</div>
					<div class="form-group">
						<label for="">Nama Pasien</label>
						<select name="namapas" id="input" class="form-control" required="required">
							<option value="">Pilih Pendafatar</option>
							<?php  
							$ta = $db->query("SELECT * FROM pasien");
							$ta->execute();
							while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
								?>
								<option value="<?php echo $da->NoPasien; ?>"><?php echo $da->NamaPas; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="input1">Jadwal</label>
						<select name="jadwal" id="input1" class="form-control" required="required">
							<option value="">Pilih Jadwal</option>
							<?php  
							$ta = $db->query("SELECT * FROM jadwalpraktek");
							$ta->execute();
							while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
								?>
								<option value="<?php echo $da->KdJadwal; ?>"><?php echo $da->Hari; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="tambah1" class="btn btn-primary" value="submit">Save changes</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php  
$nomer = @$_POST['nomer'];
$tgl = @$_POST['tgl'];
$NoUrut = @$_POST['NoUrut'];
$namapas = @$_POST['namapas'];
// $nip = @$_POST['nip'];
$jadwal = @$_POST['jadwal'];

try {
	if (@$_POST['tambah1']) {
		$ins = $db->prepare("INSERT INTO pendaftaran (NoPendaftaran, TglPendaftaran, NoUrut, NoPasien, KdJadwal) VALUES (?,?,?,?,?)");
		$array = array($nomer, $tgl, $NoUrut, $namapas, $jadwal);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('pendaftaran'); ?>";
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
	echo "Gagal Daftarkan Pasien! ".$e->getMessage();
}
?>