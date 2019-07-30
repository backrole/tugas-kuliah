<h3 class="text-muted">Data Penjualan <i class="fa fa-money"></i></h3>
<hr>
<a class="btn btn-primary" href=".?page=penjualan&action=tambah">Tambah Data Penjualan <i class="fa fa-plus-circle"></i></a>
<a class="btn btn-success" href=".?page=penjualan&action=cetak">Cetak Data Penjualan <i class="fa fa-print"></i></a>
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
		<th>ID Penjualan</th>
		<th>Nama Buku</th>
		<th>Nama Kasir</th>
		<th>Jumlah</th>
		<th>Total</th>
		<th>Tanggal</th>
		<th>Opsi</th>
	</thead>
	<tbody>
	<?php  
		$cari = @$_POST['cari'];
		if (@$_POST['carikan']) {
			if ($cari != "") { 
				$select = $db->prepare("SELECT * FROM penjualan a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN kasir c ON a.id_kasir = c.id_kasir WHERE id_penjualan LIKE '%$cari%'");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_penjualan; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->total; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
						<td>
							<a href=".?page=penjualan&action=edit&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=penjualan&action=hapus&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php
			}
			} else if ($cari == "") {
				$select = $db->prepare("SELECT * FROM penjualan a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN kasir c ON a.id_kasir = c.id_kasir");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_penjualan; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->total; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
						<td>
							<a href=".?page=penjualan&action=edit&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=penjualan&action=hapus&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php
			}
			}
		} else {
			$select = $db->prepare("SELECT * FROM penjualan a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN kasir c ON a.id_kasir = c.id_kasir");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_penjualan; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->total; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
						<td>
							<a href=".?page=penjualan&action=edit&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=penjualan&action=hapus&id=<?php echo $tampil->id_penjualan; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php
			}
		}
		?>

	</tbody>
</table>