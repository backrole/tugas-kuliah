<div class="container">
	<div class="row col-md-12">
		<span class="text-muted"><h3>Pasien Terdaftar</h3></span>
		<hr>
		<div class="row col-md-12">
			<!-- <a data-toggle="modal" href='#modal-id' class="btn btn-primary"><span class="fa fa-plus-circle"></span> Tambah Jenis Biaya</a> -->
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
					<th>No Pendaftaran</th>
					<th>Nama Pasien</th>
					<th>Tgl</th>
					<th>No Urut</th>
					<th>Nip Pegawai</th>
					<th>Kd Jadwal</th>
					<!-- <th>Opsi</th> -->
				</tr>
			</thead>
			<tbody>
				<?php 
				$tampil = $db->query("SELECT * FROM pendaftaran a LEFT JOIN pasien b ON a.NoPasien = b.NoPasien");
				$tampil->execute();
				$no = 1;
				while ($data=$tampil->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data->NoPendaftaran; ?></td>
						<td><?php echo $data->NamaPas; ?></td>
						<td><?php echo $data->TglPendaftaran; ?></td>
						<td><?php echo $data->NoUrut; ?></td>
						<td><?php echo $data->NipPegawai; ?></td>
						<td><?php echo $data->KdJadwal; ?></td>
						<!-- <td>
							<a href=".?page=jadwal&action=edit&kd=<?php echo $data->NoPendaftaran; ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href=".?page=jadwal&action=hapus&kd=<?php echo $data->NoPendaftaran; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
						</td> -->
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- MODAL-->
