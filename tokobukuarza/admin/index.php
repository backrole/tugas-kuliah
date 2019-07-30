<?php  
	session_start();
	include "../inc/connection.php";
	if (@$_SESSION['admin']) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Buku STERIDA</title>
	<script type="text/javascript" src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-brand">Toko Buku STERIDA</div>
			<ul class="nav navbar-nav">
				<li>
					<a href=".?page=buku">Buku</a>
				</li>
				<li>
					<a href=".?page=distributor">Distributor</a>
				</li>
				<li>
					<a href=".?page=pasok">Pasok</a>
				</li>
				<li>
					<a href=".?page=penjualan">Penjualan</a>
				</li>
				<li>
					<a href=".?page=kasir">kasir</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="logout.php">Logout <i class="fa fa-sign-out"></i></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<?php  
			$page = @$_GET['page'];
			$action = @$_GET['action'];
			$id = @$_GET['id'];

			if ($page == ".") {
				header('location:index.php');
			} else if ($page == "buku") {
				if ($action == "") {
					include "buku/buku.php";
				} else if ($action == "edit") {
					include "buku/edit.php";
				} else if ($action == "tambah") {
					include "buku/tambah.php";
				} else if ($action == "cetak") {
					include "buku/cetak.php";
				} else if ($action == "hapus") {
					$del = $db->prepare("DELETE FROM buku WHERE id_buku = $id");
					$del->execute();
					if ($del->rowCount()>0) {
						header('location:.?page=buku');
					}
				}
			} else if ($page == "distributor") {
				if ($action == "") {
					include "distributor/distributor.php";
				} else if ($action == "edit") {
					include "distributor/edit.php";
				} else if ($action == "tambah") {
					include "distributor/tambah.php";
				} else if ($action == "cetak") {
					include "distributor/cetak.php";
				} else if ($action == "hapus") {
					$del = $db->prepare("DELETE FROM distributor WHERE id_distributor = $id");
					$del->execute();
					if ($del->rowCount()>0) {
						header('location:.?page=distributor');
					}
				}
			} else if ($page == "kasir") {
				if ($action == "") {
					include "kasir/kasir.php";
				} else if ($action == "edit") {
					include "kasir/edit.php";
				} else if ($action == "tambah") {
					include "kasir/tambah.php";
				} else if ($action == "cetak") {
					include "kasir/cetak.php";
				} else if ($action == "hapus") {
					$del = $db->prepare("DELETE FROM kasir WHERE id_kasir = $id");
					$del->execute();
					if ($del->rowCount()>0) {
						header('location:.?page=kasir');
					}
				}
			} else if ($page == "penjualan") {
				if ($action == "") {
					include "penjualan/penjualan.php";
				} else if ($action == "edit") {
					include "penjualan/edit.php";
				} else if ($action == "tambah") {
					include "penjualan/tambah.php";
				} else if ($action == "cetak") {
					include "penjualan/cetak.php";
				} else if ($action == "hapus") {
					$del = $db->prepare("DELETE FROM penjualan WHERE id_penjualan = $id");
					$del->execute();
					if ($del->rowCount()>0) {
						header('location:.?page=penjualan');
					}
				}
			} else if ($page == "pasok") {
				if ($action == "") {
					include "pasok/pasok.php";
				} else if ($action == "edit") {
					include "pasok/edit.php";
				} else if ($action == "tambah") {
					include "pasok/tambah.php";
				} else if ($action == "cetak") {
					include "pasok/cetak.php";
				} else if ($action == "hapus") {
					$del = $db->prepare("DELETE FROM pasok WHERE id_pasok = $id");
					$del->execute();
					if ($del->rowCount()>0) {
						header('location:.?page=pasok');
					}
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