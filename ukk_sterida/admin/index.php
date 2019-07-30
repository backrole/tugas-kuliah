<?php
session_start();
include_once '../inc/connection.inc';
if (@$_SESSION['admin']) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Toko Buku</title>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<a class="navbar-brand" href=".">Toko Buku</a>
			<ul class="nav navbar-nav">
				<li>
					<a href=".?page=buku">Buku</a>
				</li>
				<li>
					<a href=".?page=distributor">Distributor</a>
				</li>
				<li>
					<a href=".?page=penjualan">Penjualan</a>
				</li>
				<li>
					<a href=".?page=pasok">Pasok</a>
				</li>
				<li>
					<a href=".?page=kasir">Kasir</a>
				</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#"><i class="fa fa-lock"></i> Ganti Password</a></li>
										<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
									</ul>
								</li>
							</ul>
			</div>
		</nav>
		<div class="container">
			<?php  
				$page = @$_GET['page'];
				$action = @$_GET['action'];
				$id = @$_GET['id'];

				if ($page == ".") {
					header('location:admin/');
				} else if ($page == "buku") {
					if ($action == "") {
						include 'buku/buku.php';
					} else if ($action == "edit") {
						include 'buku/edit.php';
					} else if ($action == "hapus") {
						$hapus = $db->prepare("DELETE FROM buku WHERE id_buku = ? ");
						$hapus->execute(array($id));
						if ($hapus->rowCount()>0) {
							?>
								<script>
									alert("Sukses Hapus Data!");
									window.location.href=".?page=buku";
								</script>
							<?php
						}
					} else if ($action == "cetak") {
						include 'buku/cetak.php';
					}
				} else if ($page == "kasir") {
					if ($action == "") {
						include 'kasir/kasir.php';
					} else if ($action == "edit") {
						include 'kasir/edit.php';
					} else if ($action == "hapus") {
						$hapus = $db->prepare("DELETE FROM kasir WHERE id_kasir = ? ");
						$hapus->execute(array($id));
						if ($hapus->rowCount()>0) {
							?>
								<script>
									alert("Sukses Hapus Data!");
									window.location.href=".?page=kasir";
								</script>
							<?php
						}
					}else if ($action == "cetak") {
						include 'kasir/cetak.php';
					}
				} else if ($page == "penjualan") {
					if ($action == "") {
						include 'penjualan/penjualan.php';
					} else if ($action == "edit") {
						include 'penjualan/edit.php';
					} else if ($action == "hapus") {
						$hapus = $db->prepare("DELETE FROM penjualan WHERE id_penjualan = ? ");
						$hapus->execute(array($id));
						if ($hapus->rowCount()>0) {
							?>
								<script>
									alert("Sukses Hapus Data!");
									window.location.href=".?page=penjualan";
								</script>
							<?php
						}
					}else if ($action == "cetak") {
						include 'penjualan/cetak.php';
					}
				} else if ($page == "pasok") {
					if ($action == "") {
						include 'pasok/pasok.php';
					} else if ($action == "edit") {
						include 'pasok/edit.php';
					} else if ($action == "hapus") {
						$hapus = $db->prepare("DELETE FROM pasok WHERE id_pasok = ? ");
						$hapus->execute(array($id));
						if ($hapus->rowCount()>0) {
							?>
								<script>
									alert("Sukses Hapus Data!");
									window.location.href=".?page=pasok";
								</script>
							<?php
						}
					}else if ($action == "cetak") {
						include 'pasok/cetak.php';
					}
				} else if ($page == "distributor") {
					if ($action == "") {
						include 'distributor/distributor.php';
					} else if ($action == "edit") {
						include 'distributor/edit.php';
					} else if ($action == "hapus") {
						$hapus = $db->prepare("DELETE FROM distributor WHERE id_distributor = ? ");
						$hapus->execute(array($id));
						if ($hapus->rowCount()>0) {
							?>
								<script>
									alert("Sukses Hapus Data!");
									window.location.href=".?page=distributor";
								</script>
							<?php
						}
					}else if ($action == "cetak") {
						include 'distributor/cetak.php';
					}
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