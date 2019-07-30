<?php  
	session_start();
	include "inc/connection.php";
	if (@$_SESSION['admin']) {
		header('location:admin/.?page=buku');
	} else if (@$_SESSION['kasir']) {
		header('location:kasir/');
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Toko Buku</title>
	<script type="text/javascript" src="assets/bootstrap/js/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
</head>
<body background="assets/background/31.jpg">
<div class="col-sm-4"></div>
<div class="col-sm-4" style="margin-top:14.5%;">
	<div class="panel panel-primary" style="">
		<div class="panel-heading" style="text-align: center;">
			<h4 style="font-size: 20pt;"><i class="fa fa-lock"></i> Login <b style="color:orange;">Toko Buku</b> <i class="fa fa-lock"></i></h4>
		</div>
		<div class="panel-body">
			<form method="post">
				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<div class="form-group">
					<select name="level" class="form-control">
						<option value=""> ==> Pilih Hak Akses <== </option>
						<option value="admin">Admin</option>
						<option value="kasir">Kasir</option>
					</select>
				</div>
				<div class="form-group">
				<button class="btn btn-primary" name="login" value="login">Login <i class="fa fa-unlock"></i></button>
				</div>
			</form>
			<?php  
				$username = htmlspecialchars(@$_POST['username']);
				$password = base64_encode(htmlspecialchars(@$_POST['password']));
				$level = htmlspecialchars(@$_POST['level']);

				if (@$_POST['login']) {
					if ($username != "" AND $password != "" AND $level == "admin") {
						$action = $db->prepare("SELECT * FROM kasir WHERE username = ? AND password = ?  AND akses = ?");
						$array = array($username, $password, $level);
						$action->execute($array);
						$fetch = $action->fetch(PDO::FETCH_LAZY);
						if ($action->rowCount()>0) {
							if ($fetch->akses == "admin") {
								@$_SESSION['admin'] = $fetch->id_kasir;
								header('location:admin/.?page=buku');
							}
						}
					} else if ($username != "" AND $password != "" AND $level == "kasir") {
						
						$action = $db->prepare("SELECT * FROM kasir WHERE username = ? AND password = ?  AND akses = ?");
						$array = array($username, $password, $level);
						$action->execute($array);
						$fetch = $action->fetch(PDO::FETCH_LAZY);
						if ($action->rowCount()>0) {
							if ($fetch->akses == "kasir") {
								@$_SESSION['kasir'] = $fetch->id_kasir;
								header('location:kasir/');
							}
						}
					} else if ($username == "" AND $password == "") {
						?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Username dan Password Anda Kosong !
							</div>
						<?php
					} else if ($username == "" AND $password == "" AND $level == "") {
						?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Isi Semua Form !
							</div>
						<?php
					} else if ($username == "" ) {
						?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Username Anda Kosong !
							</div>
						<?php
					} else if ($password == "" ) {
						?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Password Anda Kosong !
							</div>
						<?php
					} else if ($level == "" ) {
						?>
							<div class="alert alert-danger">
								<strong>Failed !!</strong> Level Anda Kosong !
							</div>
						<?php
					} 
				}
			?>
		</div>
	</div>
</div>
<div class="col-sm-4"></div>
</body>
</html>
<?php } ?>