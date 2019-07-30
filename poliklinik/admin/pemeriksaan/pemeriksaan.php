<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Pemeriksaan</h3></span>
		<hr>
		<div class="row col-md-12">
			<a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Data Pemeriksaan</a>
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
					<!-- <th>No</th> -->
					<th>No Pemeriksaan</th>
					<th>Keluhan</th>
					<th>Diagnosa</th>
					<th>Perawatan</th>
					<th>Tindakan</th>
					<th>Berat Badan</th>
					<th>Tensi Diastolik</th>
					<th>Tensi Sistolik</th>
					<th>No pendaftar</th>
					<th>No Resep</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM pemeriksaan");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<!-- <td><?php echo $no++; ?></td> -->
						<td><?php echo $data->NoPemeriksaan; ?></td>
						<td><?php echo $data->Keluhan; ?></td>
						<td><?php echo $data->Diagnosa; ?></td>
						<td><?php echo $data->Perawatan; ?></td>
						<td><?php echo $data->Tindakan; ?></td>
						<td><?php echo $data->BeratBadan; ?></td>
						<td><?php echo $data->TensiDiastolik; ?></td>
						<td><?php echo $data->TensiSistolik; ?></td>
						<td><?php echo $data->NoPendaftaran; ?></td>
						<td><?php echo $data->NoResep; ?></td>
						<td>
							<a href=".?page=<?php echo encrypt('kepemeriksaan'); ?>&action=edit&kd=<?php echo $data->NoPemeriksaan; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=<?php echo encrypt('kepemeriksaan'); ?>&action=hapus&kd=<?php echo $data->NoPemeriksaan; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
				<h4 class="modal-title">Tambah Pemeriksaan</h4>
			</div>
			<div class="modal-body">
				<form method="POST" role="form">
					<?php  
					    $tampil = $db->query("SELECT SUBSTR(MAX(NoPemeriksaan),4,6)AS max_id FROM pemeriksaan");
					    $tampil->execute();
					    $data =$tampil->fetch(PDO::FETCH_LAZY);
					    $id_max =$data->max_id;
					    $sort_num = (int) substr($id_max, 0, 8);
					    $sort_num++;
					    $new_code = sprintf("%03s", $sort_num);
					    $angkaformat="PMR".$new_code;
					?>
					<!-- <div class="form-group"> -->
						<!-- <label for="">Nomer Pemeriksasan</label> -->
						<input type="hidden" class="form-control" value="<?php echo $angkaformat; ?>" readonly name="nomer">
					<!-- </div> -->
					<div class="form-group">
						<label for="">Keluhan</label>
						<input type="text" class="form-control" name="keluhan">
					</div>
					<div class="form-group">
						<label for="">Diagnosa</label>
						<input type="text" class="form-control"  name="diagnosa">
					</div><div class="form-group">
						<label for="">Perawatan</label>
						<input type="text" class="form-control"  name="perawatan">
					</div>
					<div class="form-group">
						<label for="">Tindakan</label>
						<input type="text" class="form-control"  name="tindakan">
					</div>
					<div class="form-group">
						<label for="">Berat Badan</label>
						<input type="text" class="form-control"  name="bb">
					</div>
					<div class="form-group">
						<label for="">Tensi Diastolik</label>
						<input type="text" class="form-control"  name="td">
					</div>
					<div class="form-group">
						<label for="">Tensi Sistolik</label>
						<input type="text" class="form-control"  name="ts">
					</div>
					<div class="form-group">
						<label for="inpuqt">Resep</label>
						<select name="resep" id="inpuqt" class="form-control" required="required">
							<option value="">Pilih Resep</option>
							<?php  
								$ta = $db->query("SELECT * FROM resep a LEFT JOIN obat b ON a.KdObat = b.KdObat");
								$ta->execute();
								while ($da = $ta->fetch(PDO::FETCH_LAZY)) {
									?>
									<option value="<?php echo $da->NoResep; ?>"><?php echo $da->NamaObt; ?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Nama Pendaftaran</label>
						<select name="namaobat" id="input" class="form-control" required="required">
							<option value="">Pilih Pendaftar</option>
							<?php  
								$ta = $db->query("SELECT * FROM pendaftaran a LEFT JOIN pasien b ON a.NoPasien = b.NoPasien ");
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
					<button type="submit" name="tambah" class="btn btn-primary" value="submit">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php  
$nomer = @$_POST['nomer'];
$keluhan = @$_POST['keluhan'];
$diagnosa = @$_POST['diagnosa'];
$perawatan = @$_POST['perawatan'];
$tindakan = @$_POST['tindakan'];
$bb = @$_POST['bb'];
$td = @$_POST['td'];
$ts = @$_POST['ts'];
$resep = @$_POST['resep'];
$namaobat = @$_POST['namaobat'];

try {
	if (@$_POST['tambah']) {
	$ins = $db->prepare("INSERT INTO pemeriksaan (NoPemeriksaan, Keluhan, Diagnosa, Perawatan,Tindakan,BeratBadan,TensiDiastolik,TensiSistolik,NoPendaftaran,NoResep) VALUES (?,?,?,?,?,?,?,?,?,?)");
	$array = array($nomer, $keluhan, $diagnosa, $perawatan, $tindakan, $bb, $td, $ts, $namaobat, $resep);
	$ins->execute($array);
		if ($ins->rowCount()>0) {
			?>
			<script>
				window.location.href=".?page=<?php echo encrypt('kepemeriksaan'); ?>";
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