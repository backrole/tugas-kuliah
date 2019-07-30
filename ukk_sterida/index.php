<?php  
session_start();
include 'inc/connection.inc';
if (@$_SESSION['admin']) {
	header('location:admin/');
} else if (@$_SESSION['kasir']) {
	header('location:kasir/');
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Login Page Toko Buku
	</title>
	<script type="text/javascript" src="assets/bootstrap/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
</head>
<body>
	<div class="container" style="margin-top: 10%;">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 style="text-align: center;">Login <span style="color: #f39c12">Toko Buku</span></h1>
				</div>
				<div class="panel-body">
					<form role="form" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" name="password">
						</div>
						<div class="form-group">
							<select name="level" id="" class="form-control">
								<option disabled selected value="">Pilih Level</option>
								<option value="admin">Admin</option>
								<option value="kasir">Kasir</option>
							</select>
						</div>
						<input type="submit" name="submit" value="submit" class="btn btn-primary"></input>
					</form> <br>
					<?php  
					$user = htmlspecialchars(@$_POST['username']);
					$pass = base64_encode(htmlspecialchars(@$_POST['password']));
					$level = @$_POST['level'];

					if (@$_POST['submit']) {
						if ($user != "" AND $pass != "" AND $level == "admin") {
							$select = $db->prepare("SELECT * FROM kasir WHERE username = ? AND password = ? AND akses = ?");
							$array = array($user, $pass, $level);
							$select->execute($array);
								if ($select->rowCount()>0) {
									@$_SESSION['admin'] = $user;
									header('location:admin/');
								} else {
									?>
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Failed Login !!!</strong> Tidak ada data yang anda inputkan
									</div>
									<?php
								}
						} else if ($user != "" AND $pass != "" AND $level == "kasir") {
							$select = $db->prepare("SELECT * FROM kasir WHERE username = ? AND password = ? AND akses = ?");
							$array = array($user, $pass, $level);
							$select->execute($array);
								if ($select->rowCount()>0) {
									@$_SESSION['kasir'] = $user;
									header('location:kasir/');
								} else {
									?>
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Failed Login !!!</strong> Tidak ada data yang anda inputkan
									</div>
									<?php
								}
						} else if ($user == "" AND $pass == "") {
							?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Failed Login !!!</strong> Username dan PAssword Kosong !
							</div>
							<?php
						} else if ($user == "") {
							?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Failed Login !!!</strong> Username Kosong !
							</div>
							<?php
						} else if ($pass == "") {
							?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Failed Login !!!</strong> Password Kosong !
							</div>
							<?php
						} else if ($level == "") {
							?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Failed Login !!!</strong> Pilih level login !
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>
</body>
</html>
<?php  
	}
?>