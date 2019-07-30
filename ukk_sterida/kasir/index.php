<?php
session_start();
include_once '../inc/connection.inc';
if (@$_SESSION['kasir']) {
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Kasir Toko Buku Banyak Diskon</title>
		<script type="text/javascript" src="../assets/bootstrap/js/jquery-3.1.0.js"></script>
		<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<a class="navbar-brand" href=".">Toko Buku Banyak Diskon</a>
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
			<div class="col-sm-2"></div>
			<div class="col-sm-8" style="text-align: center;">
				<h1 class="text-muted">Kasir Toko Buku</h1>
			</div>
			<form method="POST" role="form">
				<div class="col-sm-2"></div>
				<div class="col-sm-12">
					<div class="col-sm-8">
						<div class="form-group col-sm-12">
							<label for="">Judul Buku</label>
							<select name="judul" id="inputJudul" class="form-control" required="required">
								<option value="" disabled="disabled" selected="selected">==> Pilih Judul Buku <==</option>
								<?php  
								$show = $db->prepare("SELECT * FROM buku");
								$show->execute();
								while ($showed=$show->fetch(PDO::FETCH_LAZY)) {
									?>
									<option value="<?php echo $showed->id_buku; ?>"><?php echo $showed->judul; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label for="Harga">Harga</label>
							<input type="text" onkeyup="sum();" name="harga" id="inputHarga" class="form-control" value="" required="required" pattern="" title="">
						</div>
						<div class="form-group col-sm-6">
							<label for="Jumlah">Jumlah</label>
							<input type="text" onkeyup="sum();" name="jumlah" id="inputJumlah" class="form-control" value="" required="required" pattern="" title="">
						</div>
						<div>
							<div class="col-sm-4">
								<a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambahkan</a>
							</div>
							<div class="col-sm-4">
								<a href="#" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
							</div>
							<div class="col-sm-4">
								<a href="#" class="btn btn-success"><i class="fa fa-check"></i> Proses</a>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group col-sm-6">
							<label for="">Diskon</label>
							<input type="text" onkeyup="sum();" name="diskon" id="inputDiskon" class="form-control" value="" required="required" pattern="" title="">
						</div>
						<div class="form-group col-sm-6">
							<label for="">PPN</label>
							<input type="text" onkeyup="sum();" name="ppn" id="inputPpn" class="form-control" required="required" pattern="" title="">
						</div>
						<div class="form-group col-sm-6">
						<label for="">Stok</label>
						<?php  
						// $show = $db->prepare("SELECT * FROM buku");
						// 		$show->execute();
						// 		$data = $show->fetch(PDO::FETCH_LAZY);
						?>
						<input type="text" name="stok" id="inputStok" class="form-control" value="" required="required" disabled pattern="" title="">
						</div>
						<div class="col-sm-6">
							<label for="total">Total</label>
							<input type="hidden" name="subtotal" id="subtotal">
							<input type="hidden" name="subppn" id="subppn">
							<input type="text" name="total" id="total" class="form-control" readonly="readonly" value="" required="required" pattern="" title="">
						</div>
				</div>
			</div>
			<div class="col-sm-12">
				<br>
			</div>
		</form>
		<script>
			function sum(){
				var harga = document.getElementById('inputHarga').value;
				var jumlah = document.getElementById('inputJumlah').value;
				var diskon = document.getElementById('inputDiskon').value;
				var ppn = document.getElementById('inputPpn').value;

				var subtotal = parseInt(harga) * parseInt(jumlah) * parseInt(diskon)/100;
				var subppn = parseInt(harga) * parseInt(jumlah) * parseInt(ppn)/100;
				var subakhir = parseInt(subtotal) + parseInt(subppn);
				var total = parseInt(harga) * parseInt(jumlah) - parseInt(subtotal) + parseInt(subppn);
			
				if (!isNaN(subtotal)) {
					document.getElementById('subtotal').value = subtotal;
				}
				if (!isNaN(subppn)) {
					document.getElementById('subppn').value = subppn;
				}
				if (!isNaN(total)) {
					document.getElementById('total').value = total;
				}
			}
		</script>
		<div class="col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Panel title</h3>
				</div>
				<div class="panel-body">
					Panel content
				</div>
		</div>
		</div>
	</div>
</body>
</html>
<?php 
} else {
	header('location:../');
}
?>