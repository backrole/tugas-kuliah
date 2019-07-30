<h3 class="text-muted">Data Pasok <i class="fa fa-laptop"></i></h3>
<hr>
<a class="btn btn-primary" href=".?page=pasok&action=tambah">Tambah Data Pasok <i class="fa fa-plus-circle"></i></a>
<a class="btn btn-success" href=".?page=pasok&action=cetak">Cetak Data Pasok <i class="fa fa-print"></i></a>
<form method="post" class="col-sm-3 pull-right ">
	<div class="form-inline">
		<input type="text" name="cari" class="form-control">
		<input type="submit" name="carikan" class="btn btn-success" value="Cari">
	</div>
</form>
<br>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<th>ID Pasok</th>
		<th>Nama Distributor</th>
		<th>Nama Buku</th>
		<th>Jumlah</th>
		<th>Tanggal</th>
		<th>Opsi</th>
	</thead>
	<tbody>
		<?php  
		$cari = @$_POST['cari'];
		if (@$_POST['carikan']) {
			if ($cari != "") { 
				$select = $db->prepare("SELECT * FROM pasok a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN distributor c ON a.id_distributor = c.id_distributor WHERE id_pasok LIKE '%$cari%'");
				$select->execute();
				while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $tampil->id_pasok; ?></td>
						<td><?php echo $tampil->nama_distributor; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
						<td>
							<a href=".?page=pasok&action=edit&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=pasok&action=hapus&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php
				}
			} else if ($cari == "") {
				$select = $db->prepare("SELECT * FROM pasok a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN distributor c ON a.id_distributor = c.id_distributor");
				$select->execute();
				while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $tampil->id_pasok; ?></td>
						<td><?php echo $tampil->nama_distributor; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
						<td>
							<a href=".?page=pasok&action=edit&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=pasok&action=hapus&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php
				}
			}
		} else {
			$select = $db->prepare("SELECT * FROM pasok a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN distributor c ON a.id_distributor = c.id_distributor");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
				<tr>
					<td><?php echo $tampil->id_pasok; ?></td>
					<td><?php echo $tampil->nama_distributor; ?></td>
					<td><?php echo $tampil->judul; ?></td>
					<td><?php echo $tampil->jumlah; ?></td>
					<td><?php echo $tampil->tanggal; ?></td>
					<td>
						<a href=".?page=pasok&action=edit&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
						<a href=".?page=pasok&action=hapus&id=<?php echo $tampil->id_pasok; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>