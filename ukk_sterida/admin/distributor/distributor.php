<h3 class="text-muted">Distributor <i class="fa fa-list"></i></h3> 
<hr>
<a class="btn btn-primary" data-toggle="modal" href='#tambah'><i class="fa fa-plus-circle"></i> Tambah Data Distributor</a>
<!-- <div class="btn btn-success"><i class="fa fa-list"></i> Lihat Semua Data</div> -->
<a class="btn btn-success" href=".?page=distributor&action=cetak">Cetak Laporan <i class="fa fa-print"></i></a>
<br>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Distributor</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$show = $db->query("SELECT * FROM distributor");
		$show->execute();
		$no = 1;
		while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
			?>
			<tr>
				<td><?php echo $showed->id_distributor; ?></td>
				<td><?php echo $showed->nama_distributor; ?></td>
				<td><?php echo $showed->alamat; ?></td>
				<td><?php echo $showed->telepon; ?></td>
				<td>
					<a href=".?page=distributor&action=edit&id=<?php echo $showed->id_distributor; ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
					<a class="btn-sm btn-danger" data-toggle="modal" href='.?page=distributor&action=hapus&id=<?php echo $showed->id_distributor; ?>'><i class="fa fa-trash"></i></a>
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
						<input type="text" class="form-control" id="" name="nama" placeholder="Nama Distributor">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="alamat" placeholder="Alamat">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="telepon" placeholder="Telepon">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Tambah" name="tambah"></input>
				</div>
				<br>
				<?php  
				$id = @$_POST['id'];
				$nama = @$_POST['nama'];
				$alamat = @$_POST['alamat'];
				$telepon = @$_POST['telepon'];
				try {
					if (@$_POST['tambah']) {
						$insert = $db->prepare("INSERT INTO distributor (nama_distributor, alamat, telepon) VALUES(?,?,?)");
						$array = array($nama,$alamat,$telepon);
						$insert->execute($array);
						if ($insert->rowCount()>0) {
							?>
							<script>
								window.location.href=".?page=distributor";
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

