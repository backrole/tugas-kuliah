<div class="panel panel-primary" style="">
	<div class="panel-body">
		<form method="post">
			<?php  
			$id=@$_GET['id'];
			$tampil = $db->prepare("SELECT * FROM buku WHERE id_buku = $id");
			$tampil->execute();
			$tam = $tampil->fetch(PDO::FETCH_LAZY);
			?>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Harga</label>
					<input type="hidden" name="id" class="form-control" value="<?php echo $tam->id_buku; ?>" readonly>
					<input type="text" name="harga" class="form-control" value="<?php echo $tam->harga_jual; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="text" name="jumlah" class="form-control" >
				</div>
				<div class="form-group">
					<button class="btn btn-primary" name="proses" value="proses">Proses <i class="fa fa-send"></i></button>
					<a class="btn btn-danger" href=".">Reset <i class="fa fa-recycle"></i></a>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>PPN</label>
					<input type="text" name="ppn" class="form-control" value="<?php echo $tam->ppn; ?>" readonly>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diskon</label>
					<input type="text" name="diskon" class="form-control" value="<?php echo $tam->diskon; ?>" readonly>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Stok</label>
					<input type="text" name="stok" class="form-control" value="<?php echo $tam->stok; ?>" readonly>
					<?php  
					if (@$_SESSION['kasir']) {
						$user_login = @$_SESSION['kasir'];
					}

					$user = $db->prepare("SELECT * FROM kasir WHERE id_kasir = $user_login");
					$user->execute();
					$users = $user->fetch(PDO::FETCH_LAZY);
				?>
					<input type="hidden" name="id_kasir" value="<?php echo $users->id_kasir; ?>">
				</div>
			</div>
		</form>
	</div>
	<?php  

		$id = @$_POST['id'];
		$id_kasir = @$_POST['id_kasir'];
		$judul = @$_POST['judul'];
		$jumlah = @$_POST['jumlah'];
		$diskon = @$_POST['diskon'];
		$stok = @$_POST['stok'];
		$ppn = @$_POST['ppn'];
		$harga = @$_POST['harga'];
		$tanggal = date('d-m-y');

		$diskonfix = $jumlah * $harga * ($diskon/100);
		$ppnfix = $jumlah * $harga * ($ppn/100);

		$total = $jumlah * $harga - $diskonfix + $ppnfix;

		if (@$_POST['proses']) {
			$hitung = $db->prepare("INSERT INTO penjualan (id_buku, id_kasir, jumlah, total, tanggal) VALUES (?,?,?,?,?)");
			$array = array($id, $id_kasir, $jumlah, $total, $tanggal);
			$hitung->execute($array);

			if ($hitung->rowCount()>0) {
				if ($stok == "-" OR $stok <= 0) {
					?>
						<div class="alert alert-danger">
								<strong>Failed !!</strong> Stok Buku Sedang Kosong !
							</div>
					<?php
				} else if ($jumlah > $stok) {
					?>
						<div class="alert alert-danger">
								<strong>Failed !!</strong> Pesanan Anda Melebihi Stok !
							</div>
					<?php
				} else {
					$updatebuku = $db->prepare("UPDATE buku SET stok = stok - ? WHERE id_buku = $id");
					$updatebuku->execute(array($jumlah));
					if ($updatebuku->rowCount()>0) {
						?>
							<div class="container" style="text-align: center;">
								<h1>
									Total Bayar : <br>
									<?php echo $total; ?>
									
								</h1>
							</div>
						<?php
					}
				}
			}
		}
		?>
		<br>
		<br>
</div>
</div>