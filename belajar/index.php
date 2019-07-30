<?php  
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<script src="assets/bootstrap/js/jquery-3.1.0.js"></script>
	<script src="assets/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="assets/fonnt-awesome/css/fonnt-awesome.css">
</head>
<body>
	<div class="container">
		<form method="POST" role="form">
			<div class="form-group">
				<label for="">Username</label>
				<input type="text" class="form-control" id="" name="username">
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" class="form-control" id="" name="password">
			</div>
			<input type="submit" name="login" value="Login" class="btn btn-primary">
		</form>
	</div>
	<?php  
		$username = @$_POST['username'];
		$password = @$_POST['password'];

		if (@$_POST['login']) {
			$login = $db->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
			$login->execute(array($username, $password));
			if ($login->rowCount()>0) {
				header("location:admin/index.php");
			}
		}
	?>
</body>
</html>