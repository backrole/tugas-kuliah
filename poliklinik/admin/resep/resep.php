<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Daftar Resep</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Resep</a>
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
					<th>Nomer Resep</th>
					<th>Dosis</th>
					<th>Jumlah</th>
					<th>Nama Obat</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM resep a LEFT JOIN obat b ON a.KdObat = b.KdObat");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->NoResep; ?></td>
						<td><?php echo $data->Dosis; ?></td>
						<td><?php echo $data->Jumlah; ?></td>
						<td><?php echo $data->NamaObt; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('resep'); ?>&action=edit&kd=<?php echo $data->NoResep; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('resep'); ?>&action=hapus&kd=<?php echo $data->NoResep; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
				<h4 class="modal-title">Tambah Resep</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
    $tampil = $db->query("SELECT SUBSTR(MAX(NoResep),4,6)AS max_id FROM resep");
    $tampil->execute();
    $data =$tampil->fetch(PDO::FETCH_LAZY);
    $id_max =$data->max_id;
    $sort_num = (int) substr($id_max, 0, 8);
    $sort_num++;
    $new_code = sprintf("%03s", $sort_num);
    $angkaformat="RSP".$new_code;
?>
					<div class="form-group">
						<label for="">Nomer Resep</label>
						<input type="text" class="form-control" readonly value="<?php echo $angkaformat; ?>" name="nomer">
					</div>
					<div class="form-group">
						<label for="">Dosis</label>
						<input type="text" class="form-control" name="dosis">
					</div>
					<div class="form-group">
						<label for="">Jumlah</label>
						<input type="text" class="form-control"  name="jumlah">
					</div>
					<div class="form-group">
						<label for="">Nama Obat</label>
						<select name="namaobat" id="input" class="form-control" required="required">
							<option value="">Pilih Obat</option>
							<?php  
								$ta = $db->query("SELECT * FROM obat");
								$ta->execute();
								while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
									?>
									<option value="<?php echo $da->KdObat; ?>"><?php echo $da->NamaObt; ?></option>
									<?php
								}
							?>
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
$nomer = @$_POST['nomer'];
$dosis = @$_POST['dosis'];
$jumlah = @$_POST['jumlah'];
$namaobat = @$_POST['namaobat'];

try {
	if (@$_POST['tambah']) {
	$ins = $db->prepare("INSERT INTO resep (NoResep, Dosis, Jumlah, KdObat) VALUES (?,?,?,?)");
	$array = array($nomer, $dosis, $jumlah, $namaobat);
	$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('resep'); ?>";
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