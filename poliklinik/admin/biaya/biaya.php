<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Jenis Biaya</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Jenis Biaya</a>
			<!-- <a data-toggle="modal" href='#modal-id1' class="btn btn-info"><span class="fa fa-plus-circle"></span> Tambah Dokter</a> -->
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
					<th>Kode Jenis Biaya</th>
					<th>Nama</th>
					<th>Tarif</th>
					<th>No Pendaftaran</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM jenisbiaya");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->IDJenisBiaya; ?></td>
						<td><?php echo $data->NamaBiaya; ?></td>
						<td>Rp. <?php echo $data->Tarif; ?></td>
						<td><?php echo $data->NoPendaftaran; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('biaya') ?>&action=edit&kd=<?php echo $data->IDJenisBiaya; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('biaya') ?>&action=hapus&kd=<?php echo $data->IDJenisBiaya; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
				<h4 class="modal-title">Tambah Jenis Biaya</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
					$tampil = $db->query("SELECT SUBSTR(MAX(IDJenisBiaya),4,6)AS max_id FROM jenisbiaya");
					$tampil->execute();
					$data =$tampil->fetch(PDO::FETCH_LAZY);
					$id_max =$data->max_id;
					$sort_num = (int) substr($id_max, 0, 8);
					$sort_num++;
					$new_code = sprintf("%03s", $sort_num);
					$angkaformat="JBA".$new_code;
					?>
					<div class="form-group">
						<label for="">ID Biaya</label>
						<input type="text" class="form-control" readonly value="<?php echo $angkaformat; ?>" name="id">
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
						<label for="">Tarif</label>
						<input type="text" class="form-control"  name="tarif">
					</div>
					<div class="form-group">
						<label for="">Nama Pendaftar</label>
						<select name="namapen" id="input" class="form-control" required="required">
							<option value="">Pilih Pendafatar</option>
							<?php  
							$ta = $db->query("SELECT * FROM pendaftaran a LEFT JOIN pasien b ON a.NoPasien = b.NoPasien");
							$ta->execute();
							while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
								?>
								<option value="<?php echo $da->NoPendaftaran; ?>"><?php echo $da->NamaPas; ?></option>
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
$id = @$_POST['id'];
$nama = @$_POST['nama'];
$tarif = @$_POST['tarif'];
$namapen = @$_POST['namapen'];

try {
	if (@$_POST['tambahj']) {
		$ins = $db->prepare("INSERT INTO jenisbiaya (IDJenisBiaya, NamaBiaya, Tarif, NoPendaftaran) VALUES (?,?,?,?)");
		$array = array($id, $nama, $tarif, $namapen);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('biaya') ?>";
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
	echo "Gagal Tambah Jenis Biaya! ".$e->getMessage();
}
?>