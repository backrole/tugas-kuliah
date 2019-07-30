<h3 class="text-muted">Data Kasir <i class="fa fa-calculator"></i></h3>
<hr>
<a class="btn btn-primary" href=".?page=kasir&action=tambah">Tambah Data Kasir <i class="fa fa-plus-circle"></i></a>
<a class="btn btn-success" href=".?page=kasir&action=cetak">Cetak Data Kasir <i class="fa fa-print"></i></a>
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
		<th>ID Kasir</th>
		<th>Nama Kasir</th>
		<th>Alamat</th>
		<th>Telepon</th>
		<th>Status</th>
		<th>Akses Level</th>
		<th>Opsi</th>
	</thead>
	<tbody>
		<?php  
		$cari = @$_POST['cari'];
		if (@$_POST['carikan']) {
			if ($cari != "") { 
				$select = $db->prepare("SELECT * FROM kasir WHERE nama LIKE '%$cari%'");
				$select->execute();
				while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $tampil->id_kasir; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->alamat; ?></td>
						<td><?php echo $tampil->telepon; ?></td>
						<td><?php echo $tampil->status; ?></td>
						<td><?php echo $tampil->akses; ?></td>
						<td>
							<a href=".?page=kasir&action=edit&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=kasir&action=hapus&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php
				}
			} else if ($cari == "") {
				$select = $db->prepare("SELECT * FROM kasir");
				$select->execute();
				while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
					?>
					<tr>
						<td><?php echo $tampil->id_kasir; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->alamat; ?></td>
						<td><?php echo $tampil->telepon; ?></td>
						<td><?php echo $tampil->status; ?></td>
						<td><?php echo $tampil->akses; ?></td>
						<td>
							<a href=".?page=kasir&action=edit&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href=".?page=kasir&action=hapus&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php
				}
			}
		} else {
			$select = $db->prepare("SELECT * FROM kasir");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
				<tr>
					<td><?php echo $tampil->id_kasir; ?></td>
					<td><?php echo $tampil->nama; ?></td>
					<td><?php echo $tampil->alamat; ?></td>
					<td><?php echo $tampil->telepon; ?></td>
					<td><?php echo $tampil->status; ?></td>
					<td><?php echo $tampil->akses; ?></td>
					<td>
						<a href=".?page=kasir&action=edit&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
						<a href=".?page=kasir&action=hapus&id=<?php echo $tampil->id_kasir; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
		
	</tbody>
</table>