<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Obat</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Obat</a>
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
					<th>Kode Obat</th>
					<th>Nama Obat</th>
					<th>Merk</th>
					<th>Satuan</th>
					<th>Harga Jual</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM obat");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->KdObat; ?></td>
						<td><?php echo $data->NamaObt; ?></td>
						<td><?php echo $data->Merk; ?></td>
						<td><?php echo $data->Satuan; ?></td>
						<td>Rp. <?php echo $data->HargaJual; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('obat'); ?>&action=edit&kd=<?php echo $data->KdObat; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('obat'); ?>&action=hapus&kd=<?php echo $data->KdObat; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
				<h4 class="modal-title">Tambah Obat</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
					$tampil = $db->query("SELECT SUBSTR(MAX(KdObat),4,6)AS max_id FROM obat");
					$tampil->execute();
					$data =$tampil->fetch(PDO::FETCH_LAZY);
					$id_max =$data->max_id;
					$sort_num = (int) substr($id_max, 0, 8);
					$sort_num++;
					$new_code = sprintf("%03s", $sort_num);
					$angkaformat="OBT".$new_code;
					?>
					<div class="form-group">
						<label for="">Kode Obat</label>
						<input type="text" class="form-control" value="<?php echo $angkaformat; ?>" readonly name="id">
					</div>
					<div class="form-group">
						<label for="">Nama Obat</label>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
						<label for="">Merk</label>
						<input type="text" class="form-control"  name="merk">
					</div>
					<div class="form-group">
						<label for="">Satuan</label>
						<input type="text" name="satuan" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Harga Jual</label>
						<input type="text" name="hargajual" class="form-control">
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
$id = @$_POST['id'];
$nama = @$_POST['nama'];
$merk = @$_POST['merk'];
$satuan = @$_POST['satuan'];
$hargajual = @$_POST['hargajual'];

try {
	if (@$_POST['tambah']) {
		$ins = $db->prepare("INSERT INTO obat (KdObat, NamaObt, Merk, Satuan, HargaJual) VALUES (?,?,?,?,?)");
		$array = array($id, $nama, $merk, $satuan, $hargajual);
		$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('obat'); ?>";
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