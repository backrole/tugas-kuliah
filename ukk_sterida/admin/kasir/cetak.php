<body onload="window.print();">
	<h3 class="text-muted">Laporan Data Kasir</i></h3> 
<hr>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Status</th>
			<th>Hak Akses</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$show = $db->query("SELECT * FROM kasir");
		$show->execute();
		$no = 1;
		while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
			?>
			<tr>
				<td><?php echo $showed->id_kasir; ?></td>
				<td><?php echo $showed->nama; ?></td>
				<td><?php echo $showed->alamat; ?></td>
				<td><?php echo $showed->telepon; ?></td>
				<td><?php echo $showed->status; ?></td>
				<td><?php echo $showed->akses; ?></td>
				
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
						<input type="text" class="form-control" id="" name="nama" placeholder="Nama">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="alamat" placeholder="Alamat">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="telepon" placeholder="Telepon">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="status" placeholder="Status">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="" name="password" placeholder="Password">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="akses" placeholder="Akses">
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
				$status = @$_POST['status'];
				$username = @$_POST['username'];
				$password = @$_POST['password'];
				$akses = @$_POST['akses'];

				try {
					if (@$_POST['tambah']) {
						$insert = $db->prepare("INSERT INTO kasir (id_kasir, nama, alamat, telepon, status, username, password, akses) VALUES(?,?,?,?,?,?,?,?)");
						$array = array($id,$nama,$alamat,$telepon,$status,$username,$password,$akses);
						$insert->execute($array);
						if ($insert->rowCount()>0) {
							?>
							<script>
								window.location.href=".?page=kasir";
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


</body>