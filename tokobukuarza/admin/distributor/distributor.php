<h3 class="text-muted">Data Distributor <i class="fa fa-shopping-cart"></i></h3>
<hr>
<a class="btn btn-primary" href=".?page=distributor&action=tambah">Tambah Data Distributor <i class="fa fa-plus-circle"></i></a>
<a class="btn btn-success" href=".?page=distributor&action=cetak">Cetak Data Distributor <i class="fa fa-print"></i></a>
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
		<th>ID Distributor</th>
		<th>Nama Distributor</th>
		<th>Alamat</th>
		<th>Telepon</th>
		<th>Opsi</th>
	</thead>
	<tbody>
		<?php  
			$cari = @$_POST['cari'];
			if (@$_POST['carikan']) {
				if ($cari != "") { 
					$select = $db->prepare("SELECT * FROM distributor WHERE nama_distributor LIKE '%$cari%'");
					$select->execute();
					while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
						?>
							<tr>
								<td><?php echo $tampil->id_distributor; ?></td>
								<td><?php echo $tampil->nama_distributor; ?></td>
								<td><?php echo $tampil->alamat; ?></td>
								<td><?php echo $tampil->telepon; ?></td>
								<td>
									<a href=".?page=distributor&action=edit&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
									<a href=".?page=distributor&action=hapus&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
					}
				} else if ($cari == "") {
					$select = $db->prepare("SELECT * FROM distributor");
					$select->execute();
					while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
						?>
							<tr>
								<td><?php echo $tampil->id_distributor; ?></td>
								<td><?php echo $tampil->nama_distributor; ?></td>
								<td><?php echo $tampil->alamat; ?></td>
								<td><?php echo $tampil->telepon; ?></td>
								<td>
									<a href=".?page=distributor&action=edit&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
									<a href=".?page=distributor&action=hapus&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
					}
				}
			} else {
					$select = $db->prepare("SELECT * FROM distributor");
				$select->execute();
					while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
						?>
							<tr>
								<td><?php echo $tampil->id_distributor; ?></td>
								<td><?php echo $tampil->nama_distributor; ?></td>
								<td><?php echo $tampil->alamat; ?></td>
								<td><?php echo $tampil->telepon; ?></td>
								<td>
									<a href=".?page=distributor&action=edit&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
									<a href=".?page=distributor&action=hapus&id=<?php echo $tampil->id_distributor; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
					}
			}
		?>
	</tbody>
</table>