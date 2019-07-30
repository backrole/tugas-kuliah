<h3 class="text-muted">Data Buku <i class="fa fa-book"></i></h3>
<hr>
<a class="btn btn-primary" href=".?page=buku&action=tambah">Tambah Data Buku <i class="fa fa-plus-circle"></i></a>
<a class="btn btn-success" href=".?page=buku&action=cetak">Cetak Data Buku <i class="fa fa-print"></i></a>
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
		<th>No ISBN</th>
		<th>Judul</th>
		<th>Penulis</th>
		<th>Penerbit</th>
		<th>Tahun</th>
		<th>Stok</th>
		<th>Harga Pokok</th>
		<th>Harga Jual</th>
		<th>PPN</th>
		<th>Diskon</th>
		<th>Opsi</th>
	</thead>
	<tbody>
		<?php  
			$cari = @$_POST['cari'];
			if (@$_POST['carikan']) {
				if ($cari != "") {
					$select = $db->prepare("SELECT * FROM buku WHERE judul LIKE '%$cari%' ");
						$select->execute();
						while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
							?>
								<tr>
									<td><?php echo $tampil->noisbn; ?></td>
									<td><?php echo $tampil->judul; ?></td>
									<td><?php echo $tampil->penulis; ?></td>
									<td><?php echo $tampil->penerbit; ?></td>
									<td><?php echo $tampil->tahun; ?></td>
									<td><?php echo $tampil->stok; ?></td>
									<td><?php echo $tampil->harga_pokok; ?></td>
									<td><?php echo $tampil->harga_jual; ?></td>
									<td><?php echo $tampil->ppn; ?></td>
									<td><?php echo $tampil->diskon; ?></td>
									<td>
										<a href=".?page=buku&action=edit&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
										<a href=".?page=buku&action=hapus&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php
						}
				} else if ($cari == "") {
					$select = $db->prepare("SELECT * FROM buku");
						$select->execute(array($cari));
						while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
							?>
								<tr>
									<td><?php echo $tampil->noisbn; ?></td>
									<td><?php echo $tampil->judul; ?></td>
									<td><?php echo $tampil->penulis; ?></td>
									<td><?php echo $tampil->penerbit; ?></td>
									<td><?php echo $tampil->tahun; ?></td>
									<td><?php echo $tampil->stok; ?></td>
									<td><?php echo $tampil->harga_pokok; ?></td>
									<td><?php echo $tampil->harga_jual; ?></td>
									<td><?php echo $tampil->ppn; ?></td>
									<td><?php echo $tampil->diskon; ?></td>
									<td>
										<a href=".?page=buku&action=edit&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
										<a href=".?page=buku&action=hapus&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php
						}
				}
			} else {
				$select = $db->prepare("SELECT * FROM buku");
						$select->execute();
						while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
							?>
								<tr>
									<td><?php echo $tampil->noisbn; ?></td>
									<td><?php echo $tampil->judul; ?></td>
									<td><?php echo $tampil->penulis; ?></td>
									<td><?php echo $tampil->penerbit; ?></td>
									<td><?php echo $tampil->tahun; ?></td>
									<td><?php echo $tampil->stok; ?></td>
									<td><?php echo $tampil->harga_pokok; ?></td>
									<td><?php echo $tampil->harga_jual; ?></td>
									<td><?php echo $tampil->ppn; ?></td>
									<td><?php echo $tampil->diskon; ?></td>
									<td>
										<a href=".?page=buku&action=edit&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
										<a href=".?page=buku&action=hapus&id=<?php echo $tampil->id_buku; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php
						}
			}
		?>
	</tbody>
</table>