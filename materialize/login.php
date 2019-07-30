<?php  
    session_start();
    include 'inc/koneksi.php';
      if (@$_SESSION ['user']) {
        header("location:index.php");
      } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <script src="js/jquery.js"></script>
  <script src="js/materialize.js"></script>
  <link rel="stylesheet" href="css/materialize.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="row" style="margin-top: 7%;">
        <div class="container">
            <div class="col 6 m6 s6 offset-2 offset-m3">
            <h3 class="center">Halaman <span class="orange-text">Login</span></h3>
            <div class="card z-depth-2" style="height:280px;">
                <div class="card-content">
                    <form method="post" class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input type="text" name="user" required id="username">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-action-lock prefix"></i>
                                <input type="password" name="pass" required id="password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right orange" value="login" name="login">LOGIN<i class="mdi-content-send right"></i></button>
                            </div>
                        </div>
                    </form>
                    <?php  
                        $user = htmlspecialchars(@$_POST['user']);
                        $pass = htmlspecialchars(md5(@$_POST['pass']));

                        if (@$_POST['login']) {
                            $select = $db->prepare("SELECT * FROM user_login WHERE username = ? AND password = ?");
                            $array = array($user, $pass);
                            $select->execute($array);
                            if ($select->rowCount()>0) {
                                        @$_SESSION['user'] = $user;
                                    ?>
                                        <script>
                                            window.location.href="index.php";
                                        </script>
                                    <?php
                                } else {
                                    ?>
                                        <script>
                                            alert("Gagal Login");
                                        </script>
                                    <?php
                            } 
                        }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
<?php
}
?>
