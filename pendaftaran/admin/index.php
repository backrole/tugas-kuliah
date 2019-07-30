<?php 
session_start();
if (@$_SESSION ['id']) {
include '../assets/connect.inc'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equip="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">
	<title>Admin</title>
	<script src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
</head>
<body data-target="#menu" data-spy="scroll">
	<header>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="."><span>Admin</span></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li><a href="#">Link</a></li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-lg fa-user"></span>  Menu  <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#!"><span class="fa fa-gear"></span>  Manage Account</a></li>
								<li><a href="logout.php"><span class="fa fa-sign-out"></span>  Logout</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</header>

	<div>
		<div id="sidebar">
		<div class="col-md-1" style="border-right:1px solid #E7E7E7;background:#F8F8F8;margin-top:50px; min-height:614px;position:fixed;">
			<div class="nav row" id="menu">
				<a href=".?page=peserta" class="list-group-item" style="border-right:none;"><span class="fa fa-list fa-md "></span>&nbsp;&nbsp;Peserta</a>
				<a href="logout.php" class="list-group-item" style="border-right:none;"><span class="fa fa-sign-out fa-md"></span>&nbsp;&nbsp;Logout</a>
			
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-lg-11" style="margin-top:70px;margin-left:110px;">

		<!-- Halaman Dinamis Disini -->
			<?php  
				$pages = @$_GET['page'];
				$actions = @$_GET['action'];

				if ($pages == 'peserta') {
					if ($actions == "") {
						include 'peserta.php';
					} else if ($actions == 'delete') {
						  	$kd = @$_GET['kd'];
							$hapus = $db->prepare("DELETE FROM daftar WHERE no_pendaftaran = ?");
							$hapus->execute(array($kd));
							if ($hapus->rowCount()>0) {
								?>
								<script type="text/javascript">
									window.location.href=".?page=peserta";
								</script>
								<?php
							}
					} else if ($actions == 'edit') {
						include 'edit.php';
					} else if ($actions == 'insert') {
						include 'insert.php';
					}
				}
			?>

			<!-- Halaman dinamis diatas -->
	</div>
</div>



<!-- <div class="row">

	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
		<h4><a href="#col2Content" data-toggle="collapse">Column2</a></h4>
		<div id="col2Content" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam quod libero! Reprehenderit excepturi fugit ut expedita dolore ea debitis, ducimus incidunt voluptatum, corporis ipsam enim repellendus, sed laudantium repudiandae.</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4><a href="#col3Content" data-toggle="collapse">Column3</a></h4>
		<div id="col3Content" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam quod libero! Reprehenderit excepturi fugit ut expedita dolore ea debitis, ducimus incidunt voluptatum, corporis ipsam enim repellendus, sed laudantium repudiandae.</div>
	</div>
</div> -->

</body>
</html>
  <?php
} else {
  header("location:../index.php");
}
?>
