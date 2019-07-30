<body onload="window.print();">
	<h3 class="text-muted">Laporan Data Buku</h3> 
<hr>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Judul</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Tahun</th>
			<th>Stok</th>
			<th>Harga Pokok</th>
			<th>Harga Jual</th>
			<th>PPN</th>
			<th>Diskon</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$show = $db->query("SELECT * FROM buku");
		$show->execute();
		$no = 1;
		while ($showed = $show->fetch(PDO::FETCH_LAZY)) {
			?>
			<tr>
				<td><?php echo $showed->id_buku; ?></td>
				<td><?php echo $showed->judul; ?></td>
				<td><?php echo $showed->penulis; ?></td>
				<td><?php echo $showed->penerbit; ?></td>
				<td><?php echo $showed->tahun; ?></td>
				<td><?php echo $showed->stok; ?></td>
				<td><?php echo $showed->harga_pokok; ?></td>
				<td><?php echo $showed->harga_jual; ?></td>
				<td><?php echo $showed->ppn; ?></td>
				<td><?php echo $showed->diskon; ?></td>
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
						<input type="text" class="form-control" id="" name="noisbn" placeholder="No ISBN">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="judul" placeholder="Judul">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="penulis" placeholder="Penulis">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="penerbit" placeholder="Penerbit">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="tahun" placeholder="Tahun">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="stok" placeholder="Stok">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="hargapokok" placeholder="Harga Pokok">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="hargajual" placeholder="Harga Jual">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="ppn" placeholder="PPN">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="" name="diskon" placeholder="Diskon">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Tambah" name="tambah"></input>
				</div>
				<br>
				<?php  
				$id = @$_POST['id'];
				$noisbn = @$_POST['noisbn'];
				$judul = @$_POST['judul'];
				$penulis = @$_POST['penulis'];
				$penerbit = @$_POST['penerbit'];
				$tahun = @$_POST['tahun'];
				$stok = @$_POST['stok'];
				$hargapokok = @$_POST['hargapokok'];
				$hargajual = @$_POST['hargajual'];
				$ppn = @$_POST['ppn'];
				$diskon = @$_POST['diskon'];

				try {
					if (@$_POST['tambah']) {
						$insert = $db->prepare("INSERT INTO buku (id_buku, judul, noisbn, penulis, penerbit, tahun, stok, harga_pokok, harga_jual, ppn,diskon) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
						$array = array($id,$noisbn,$judul,$penulis,$penerbit,$tahun,$stok,$hargapokok,$hargajual,$ppn,$diskon);
						$insert->execute($array);
						if ($insert->rowCount()>0) {
							?>
							<script>
								window.location.href=".?page=buku";
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