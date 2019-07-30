<h3 class="text-muted">Penjualan <i class="fa fa-money"></i></h3> 
<hr>
<a class="btn btn-primary" data-toggle="modal" href='#tambah'><i class="fa fa-plus-circle"></i> Tambah Data Penjualan</a>
<a class="btn btn-success" href=".?page=penjualan&action=cetak">Cetak Laporan <i class="fa fa-print"></i></a>
<br>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Buku</th>
			<th>Nama Kasir</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Tanggal</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$show = $db->query("SELECT * FROM penjualan a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN kasir c ON a.id_kasir = c.id_kasir");
		$show->execute();
		$no = 1;
		while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
			?>
			<tr>
				<td><?php echo $showed->id_penjualan; ?></td>
				<td><?php echo $showed->judul; ?></td>
				<td><?php echo $showed->nama; ?></td>
				<td><?php echo $showed->jumlah; ?></td>
				<td><?php echo $showed->total; ?></td>
				<td><?php echo $showed->tanggal; ?></td>
				<td>
					<a href=".?page=penjualan&action=edit&id=<?php echo $showed->id_penjualan; ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
					<a class="btn-sm btn-danger" data-toggle="modal" href='.?page=penjualan&action=hapus&id=<?php echo $showed->id_penjualan; ?>'><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php		
		}
		?>
		
	</tbody>
</table>

<!-- MODAL TAMBAH -->

<form method="POST" role="form">
	<div class="modal fade" id="tambah">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Data</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<select name="idbuku" id="inputIdbuku" class="form-control" required="required">
							<option value="">Pilh Buku</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM buku");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_buku; ?>"><?php echo $view->judul; ?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<select name="idkasir" id="inputIdKasir" class="form-control" required="required">
							<option value="">Pilh Petugas Kasir</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM kasir");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_kasir; ?>"><?php echo $view->nama; ?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="jumlah" placeholder="Jumlah">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="total" placeholder="Total">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="" name="tanggal" placeholder="Username">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Tambah" name="tambah"></input>
				</div>
				<br>
				<?php  
				$id = @$_POST['id'];
				$idbuku = @$_POST['idbuku'];
				$idkasir = @$_POST['idkasir'];
				$jumlah = @$_POST['jumlah'];
				$total = @$_POST['total'];
				$tanggal = @$_POST['tanggal'];

				try {
					if (@$_POST['tambah']) {
						$insert = $db->prepare("INSERT INTO penjualan (id_buku, id_kasir, jumlah, total, tanggal) VALUES(?,?,?,?,?)");
						$array = array($idbuku,$idkasir,$jumlah,$total, $tanggal);
						$insert->execute($array);
						if ($insert->rowCount()>0) {
							?>
							<script>
								window.location.href=".?page=penjualan";
							</script>
							<?php
						} else {
							?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Gagal!</strong> Data Yang anda masukan kurang benar!
							</div>
							<?php
						}
					}
				} catch (Exception $e) {
					echo "Error" .$e->getMessage();	
				}
				?>
			</div>
		</div>
	</div>
</form>
		</div>
	</div>
</div>

