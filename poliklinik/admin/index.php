<?php
session_start();
	// header("location:?page=pasien");
if (@$_SESSION['user']) {
	include_once '../assets/inc/connect.inc';
	include '../assets/pagination.php';
	include '../assets/encrypt.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<script src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/dataTable/media/js/dataTables.bootstrap.js"></script>
		<script src="../assets/dataTable/media/js/jquery.dataTables.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="../assets/dataTable/media/css/dataTables.uikit.css">
		<title>Poliklinik</title>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href=".">Admin Poliklinik</a>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-left">
						<li><a href=".?page=<?php echo encrypt('pasien'); ?>">Pasien</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Informasi <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href=".?page=<?php echo encrypt('kepemeriksaan'); ?>">Pemeriksaan</a></li>
								<li><a href=".?page=<?php echo encrypt('resep'); ?>">Resep Obat</a></li>
								<li><a href=".?page=<?php echo encrypt('obat'); ?>">Obat</a></li>
								<li><a href=".?page=<?php echo encrypt('biaya'); ?>">Biaya</a></li>
							</ul>
						</li>
						<li><a href=".?page=<?php echo encrypt('dokter'); ?>">Dokter</a></li>
						<li><a href=".?page=<?php echo encrypt('jadwal'); ?>">Jadwal Praktek</a></li>
						<li><a href=".?page=<?php echo encrypt('pegawai'); ?>">Pegawai</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
			<?php
			$page = @$_GET['page'];
			$action = @$_GET['action'];
			$kd = @$_GET['kd'];
			if ($page == encrypt('pasien')) {
				if ($action == '') {
					include 'pasien/pasien.php';
				} else if ($action == encrypt('edit')) {
					include 'pasien/edit_pasien.php';
				} else if ($action == encrypt('lihatpendaftar')) {
					include 'pasien/pasien_terdaftar.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM pasien WHERE NoPasien = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('pasien'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('dokter')) {
				if ($action == '') {
					include 'dokter/dokter.php';
				} else if ($action == encrypt('edit')) {
					include 'dokter/edit_dokter.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM dokter WHERE KdDok = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
					?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('dokter'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('pegawai')) {
				if ($action == '') {
					include 'pegawai/pegawai.php';
				} else if ($action == encrypt('edit')) {
					include 'pegawai/edit_pegawai.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM pegawai WHERE KdDok = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('pegawai'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('jadwal')) {
				if ($action == '') {
					include 'jadwal/jadwal.php';
				} else if ($action == encrypt('edit')) {
					include 'jadwal/edit_jadwal.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM jadwalpraktek WHERE KdJadwal = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('jadwal'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('biaya')) {
				if ($action == '') {
					include 'biaya/biaya.php';
				} else if ($action == encrypt('edit')) {
					include 'biaya/edit_biaya.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM jenisbiaya WHERE IdJenisBiaya = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
							?>
								<script type="text/javascript">
									window.location.href=".?page=<?php echo encrypt('biaya'); ?>";
								</script>
							<?php
						}
				}
			} else if ($page == encrypt('obat')) {
				if ($action == '') {
					include 'obat/obat.php';
				} else if ($action == encrypt('edit')) {
					include 'obat/edit_obat.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM obat WHERE KdObat = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('obat'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('resep')) {
				if ($action == '') {
					include 'resep/resep.php';
				} else if ($action == encrypt('edit')) {
					include 'resep/edit_resep.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM resep WHERE NoResep = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('resep'); ?>";
							</script>
						<?php
					}
				}
			} else if ($page == encrypt('kepemeriksaan')) {
				if ($action == '') {
					include 'pemeriksaan/pemeriksaan.php';
				} else if ($action == encrypt('edit')) {
					include 'pemeriksaan/edit_pemeriksaan.php';
				} else if ($action == encrypt('hapus')) {
					$hapus = $db->prepare("DELETE FROM pemeriksaan WHERE NoPemeriksaan = ?");
					$hapus->execute(array($kd));
					if ($hapus->rowCount()>0) {
						?>
							<script type="text/javascript">
								window.location.href=".?page=<?php echo encrypt('pemeriksaan'); ?>";
							</script>
						<?php
					}
				}
			}
			?>
			<footer>
				<br>
			</footer>
		</body>
	</html>
	<?php } else {
	?>
	<script>
		window.location.href="../login.php"
	</script>
	<?php
	} ?>