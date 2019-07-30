<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Jadwal Praktek Dokter</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Jadwal</a>
			<a data-toggle="modal" href='#modal-id1' class="btn btn-info"><span class="fa fa-plus-circle"></span> Tambah Dokter</a>
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
					<th>Kode Jadwal</th>
					<th>Hari</th>
					<th>Jam Mulai</th>
					<th>Jam Selesai</th>
					<th>Kode Dokter</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM jadwalpraktek");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->KdJadwal; ?></td>
						<td><?php echo $data->Hari; ?></td>
						<td><?php echo $data->JamMulai; ?></td>
						<td><?php echo $data->JamSelesai; ?></td>
						<td><?php echo $data->KdDokter; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('jadwal'); ?>&action=edit&kd=<?php echo $data->KdJadwal; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('jadwal'); ?>&action=hapus&kd=<?php echo $data->KdJadwal; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
				<h4 class="modal-title">Tambah Jadwal</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
					$tampil = $db->query("SELECT SUBSTR(MAX(KdJadwal),4,6)AS max_id FROM jadwalpraktek");
					$tampil->execute();
					$data =$tampil->fetch(PDO::FETCH_LAZY);
					$id_max =$data->max_id;
					$sort_num = (int) substr($id_max, 0, 8);
					$sort_num++;
					$new_code = sprintf("%03s", $sort_num);
					$angkaformat="JPK".$new_code;
					?>
					<div class="form-group">
						<label for="">Kode Jadwal</label>
						<input type="text" class="form-control" value="<?php echo $angkaformat; ?>" readonly name="kodej">
					</div>
					<div class="form-group">
						<label for="">Hari</label>
						<input type="text" class="form-control" name="harij">
					</div>
					<div class="form-group">
						<label for="">Jam Mulai</label>
						<input type="time" class="form-control"  name="jammulj">
					</div>
					<div class="form-group">
						<label for="">Jam Selesai</label>
						<input type="time" class="form-control" name="jamselj">
					</div>
					<div class="form-group">
						<label for="">Kode Dokter</label>
						<select name="kddokj" id="input" class="form-control" required="required">
							<option value="">Pilih Dokter</option>
							<?php  
							$ta = $db->query("SELECT * FROM dokter");
							$ta->execute();
							while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
								?>
								<option value="<?php echo $da->KdDok; ?>"><?php echo $da->NamaDok; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahj" class="btn btn-primary" value="submit">Save changes</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php  
$kodej = @$_POST['kodej'];
$harij = @$_POST['harij'];
$jamselj = @$_POST['jamselj'];
$jammulj = @$_POST['jammulj'];
$kddokj = @$_POST['kddokj'];

try {
	if (@$_POST['tambahj']) {
		$ins = $db->prepare("INSERT INTO jadwalpraktek (KdJadwal, Hari, JamMulai, JamSelesai, KdDokter) VALUES (?,?,?,?,?)");
		$array = array($kodej, $harij, $jammulj, $jamselj, $kddokj);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('jadwal'); ?>";
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
	echo "Gagal Tambah Data Jadwal! ".$e->getMessage();
}
?>

<!-- MODAL DOKTER -->

<div class="modal fade" id="modal-id1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Pasien</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
						$tampil = $db->query("SELECT SUBSTR(MAX(KdDok),4,6)AS max_id FROM dokter");
						$tampil->execute();
						$data =$tampil->fetch(PDO::FETCH_LAZY);
						$id_max =$data->max_id;
						$sort_num = (int) substr($id_max, 0, 8);
						$sort_num++;
						$new_code = sprintf("%03s", $sort_num);
						$angkaformat1="DKR".$new_code;
					?>
					<div class="form-group">
						<label for="">Kode Dokter</label>
						<input type="text" class="form-control" value="<?php echo $angkaformat1; ?>" readonly name="kode">
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
						<label for="">Kode Poli</label>
						<input type="text" class="form-control"  name="poli">
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
$kode = @$_POST['kode'];
$nama = @$_POST['nama'];
$alamat = @$_POST['alamat'];
$telepon = @$_POST['telepon'];
$poli = @$_POST['poli'];

try {
	if (@$_POST['tambah']) {
		$insj = $db->prepare("INSERT INTO dokter (KdDok, NamaDok, AlmDok, TelpDok, KdPoli) VALUES (?,?,?,?,?)");
		$array = array($kode, $nama, $alamat, $telepon, $poli);
		$insj->execute($array);
		if ($insj->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('jadwal'); ?>";
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
	echo "Gagal Tambah Data Dokter! ".$e->getMessage();
}
?>
