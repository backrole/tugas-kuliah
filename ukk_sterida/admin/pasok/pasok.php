<h3 class="text-muted">Pasok <i class="fa fa-laptop"></i></h3> 
<hr>
<a class="btn btn-primary" data-toggle="modal" href='#tambah'><i class="fa fa-plus-circle"></i> Tambah Data Pasok</a>
<a href=".?page=pasok&action=cetak" class="btn btn-success">Cetak Laporan <i class="fa fa-print"></i></a>
<br>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Distributor</th>
			<th>Nama Buku</th>
			<th>Jumlah</th>
			<th>Tanggal</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$show = $db->query("SELECT * FROM pasok a LEFT JOIN distributor b ON a.id_distributor = b.id_distributor LEFT JOIN buku c ON a.id_buku = c.id_buku");
		$show->execute();
		$no = 1;
		while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
			?>
			<tr>
				<td><?php echo $showed->id_pasok; ?></td>
				<td><?php echo $showed->nama_distributor; ?></td>
				<td><?php echo $showed->judul; ?></td>
				<td><?php echo $showed->jumlah; ?></td>
				<td><?php echo $showed->tanggal; ?></td>
				<td>
					<a href=".?page=pasok&action=edit&id=<?php echo $showed->id_pasok; ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
					<a class="btn-sm btn-danger" data-toggle="modal" href='.?page=pasok&action=hapus&id=<?php echo $showed->id_pasok; ?>'><i class="fa fa-trash"></i></a>
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
						<input type="text" class="form-control" id="" name="id" placeholder="ID">
					</div>	
					<div class="form-group">
						<select name="iddistributor" id="inputIdbuku" class="form-control" required="required">
							<option value="">Pilh Distributor</option>
							<?php  
								$tampil = $db->prepare("SELECT * FROM distributor");
								$tampil->execute();
								while ($view = $tampil->fetch(PDO::FETCH_LAZY)) {
									?>
										<option value="<?php echo $view->id_distributor; ?>"><?php echo $view->nama_distributor; ?></option>
									<?php
								}
							?>
						</select>
					</div>
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
						<input type="text" class="form-control" id="" name="jumlah" placeholder="Jumlah">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="" name="tanggal" placeholder="Tanggal">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Tambah" name="tambah"></input>
				</div>
				<br>
				<?php  
				$id = @$_POST['id'];
				$iddistributor = @$_POST['iddistributor'];
				$idbuku = @$_POST['idbuku'];
				$jumlah = @$_POST['jumlah'];
				$tanggal = @$_POST['tanggal'];
				try {
					if (@$_POST['tambah']) {
						$insert = $db->prepare("INSERT INTO pasok (id_pasok, id_distributor, id_buku, jumlah, tanggal) VALUES(?,?,?,?,?)");
						$array = array($id,$iddistributor,$idbuku, $jumlah,$tanggal);
						$insert->execute($array);
						if ($insert->rowCount()>0) {
							$plus = $db->prepare("UPDATE buku SET stok = stok + ? WHERE id_buku = '$idbuku' ");
							$plus->execute(array($jumlah));
							if ($plus->rowCount()>0) {
								?>
							<script>
								window.location.href=".?page=pasok";
							</script>
							<?php
							}
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

