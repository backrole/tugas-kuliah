<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Dokter</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Dokter</a>
			<a data-toggle="modal" href='#modal-id1' class="btn btn-info"><span class="fa fa-plus-circle"></span> Tambah Poli</a>
		</div>

	</div>
</div>
<div class="container">
	<div class="row col-md-9">
		<!-- Tabel -->
		<br>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Dokter</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Telp</th>
					<th>Kode Polli</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM dokter");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->KdDok; ?></td>
						<td><?php echo $data->NamaDok; ?></td>
						<td><?php echo $data->AlmDok; ?></td>
						<td><?php echo $data->TelpDok; ?></td>
						<td><?php echo $data->KdPoli; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('dokter'); ?>&action=edit&kd=<?php echo $data->KdDok; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('dokter'); ?>&action=hapus&kd=<?php echo $data->KdDok; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<!-- Tabel -->
		<br>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Kode Poli</th>
					<th>Nama Poli</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM poliklinik");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $data->KodePoli; ?></td>
						<td><?php echo $data->NamaPoli; ?></td>
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
						$tampil = $db->query("SELECT SUBSTR(MAX(KdDok),4,6)AS max_id FROM dokter");
						$tampil->execute();
						$data =$tampil->fetch(PDO::FETCH_LAZY);
						$id_max =$data->max_id;
						$sort_num = (int) substr($id_max, 0, 8);
						$sort_num++;
						$new_code = sprintf("%03s", $sort_num);
						$angkaformat="DKR".$new_code;
					?>
					<div class="form-group">
						<label for="">Kode Dokter</label>
						<input type="text" class="form-control" value="<?php echo $angkaformat; ?>" readonly name="kode">
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
		$ins = $db->prepare("INSERT INTO dokter (KdDok, NamaDok, AlmDok, TelpDok, KdPoli) VALUES (?,?,?,?,?)");
		$array = array($kode, $nama, $alamat, $telepon, $poli);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('dokter'); ?>";
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

<!-- MODAL EDIT -->

<div class="modal fade" id="modal-id1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Poliklinik</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					
					<div class="form-group">
						<label for="">Kode Poli</label>
						<input type="text" class="form-control"  name="kodep">
					</div>
					<div class="form-group">
						<label for="">Nama Poli</label>
						<input type="text" class="form-control"  name="namap">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahp" class="btn btn-primary" value="submit">Save changes</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php  
$kodep = @$_POST['kodep'];
$namap = @$_POST['namap'];

try {
	if (@$_POST['tambahp']) {
		$insp = $db->prepare("INSERT INTO poliklinik (KodePoli, NamaPoli) VALUES (?,?)");
		$arrayp = array($kodep, $namap);
		$insp->execute($arrayp);
		if ($insp->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('dokter'); ?>";
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