<?php  
session_start();
include "../inc/connection.php";
if (@$_SESSION['kasir']) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Kasir Toko Buku</title>
		<script type="text/javascript" src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
		<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
	</head>
	<body>
		<div class="navbar navbar-default">
			<div class="container">
				<div class="navbar-brand">Toko Buku Sterida</div>
				<ul class="nav navbar-nav navbar-right">
				<?php  
					if (@$_SESSION['kasir']) {
						$user_login = @$_SESSION['kasir'];
					}

					$user = $db->prepare("SELECT * FROM kasir WHERE id_kasir = $user_login");
					$user->execute();
					$users = $user->fetch(PDO::FETCH_LAZY);
				?>
				<li><a href="#">Selemat Datang, <?php echo ucfirst($users->nama); ?></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-key"></i> Ganti Password</a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
			</div>
		</div>
		<div class="container">
			<div class="col-sm-2"></div>
			<div class="col-sm-8" style="text-align: center;">
				<h1>Kasir Toko Buku</h1>
			</div>
			<div class="col-sm-2"></div>
			<form method="post">
				<div class="form-inline">
					<input type="text" name="cari" class="form-control">
					<input type="submit" name="carikan" class="btn btn-success" value="Cari">
				</div>
				
			</form>
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
										<a class="btn btn-primary" href=".?page=hitung&id=<?php echo $tampil->id_buku; ?>"><i class="fa fa-send"></i></a>
									</td>
								</tr>
								<?php
							}
						} else if ($cari == "") {
							?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Isikan Data Yang Dicari !
							</div>
							<?php
						} 
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="container">
			<?php  
				$page = @$_GET['page'];

				if ($page == "hitung") {
					include "pilih.php";
				}
			?>
		</div>
	</body>
	</html>
	<?php  
} else {
	header('location:../');
}
?>