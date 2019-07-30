<?php  
include 'inc/koneksi.php';
  session_start();
  if (@$_SESSION ['user']) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sistem Inventory</title>
  <script src="js/jquery.js"></script>
  <script src="js/materialize.js"></script>
  <link rel="stylesheet" href="css/materialize.css">
   <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

</head>
<body>
  <!-- Dropdown Structure -->
    <ul id="profile" class="dropdown-content">
      <li><a href=".?page=profile"><i class="material-icons left">perm_identity</i>Profile</a></li>
      <li class="divider"></li>
      <li><a href="logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>
    </ul>
    <ul id="transaksi" class="dropdown-content">
      <li><a href=".?page=barangmasuk"><i class="material-icons left">call_received</i>Barang Masuk</a></li>
      <li class="divider"></li>
      <li><a href=".?page=barangkeluar"><i class="material-icons left">call_made</i>Barang Keluar</a></li>
    </ul>
    <nav>
      <div class="nav-wrapper light-blue darken-3">
        <a href=".?page=" class="brand-logo" style="margin-left:10px;">Sistem Inventory</a>
        <ul class="right hide-on-med-and-down ">
          <li><a class="waves-effect waves-light" href=".?page=barang">Data Barang</a></li>
          <li><a class="waves-effect waves-light" href=".?page=barangmasuk">Barang Masuk</a></li>
          <li><a class="waves-effect waves-light" href=".?page=barangkeluar">Barang Keluar</a></li>
          <li><a class="waves-effect waves-light" href=".?page=supplier">Supplier</a></li>
          <!-- Dropdown Trigger -->
          <li class="red waves-effect waves-light"><a href="logout.php"><i class="mdi-action-settings-power left"></i>Logout</a></li>
        </ul>
      </div>
    </nav>

      <div class="section" style="margin-left:50px;margin-right:50px;">
        <?php 
          $pages = @$_GET['page'];
          $action = @$_GET['action'];
          if ($pages == '') {
            include 'pages/barang.php';
          } else if ($pages == 'barangmasuk') {
            if ($action == '') {
              include 'pages/barangmasuk.php';
            } else if ($action == 'tambah') {
              include 'pages/barangmasukinput.php';
            } else if ($action == 'hapus') {
              include 'pages/barangmasukhapus.php';
            }
          } else if ($pages == 'barangkeluar') {
            if ($action == '') {
              include 'pages/barangkeluar.php';
            } else if ($action == 'tambah') {
              include 'pages/barangkeluartambah.php';
            } else if ($action == 'hapus') {
              include 'pages/barangkeluarhapus.php';
            } else if ($action == 'tambahkeluaran') {
              include 'pages/tambahkeluaran.php';
            }
          } else if ($pages == 'barang') {
            if ($action == '') {
              include 'pages/barang.php';
            } else if ($action == 'tambah') {
              include 'pages/tambahbarang.php';
            } else if ($action == 'edit') {
              include 'pages/editbarang.php';
            } else if ($action == 'hapus') {
              include 'pages/hapusbarang.php';
            }
          } else if ($pages == 'supplier') {
            if ($action == '') {
              include 'pages/supplier.php';
            } else if ($action == 'tambah') {
              include 'pages/tambahsupplier.php';
            } else if ($action == 'edit') {
              include 'pages/editsupplier.php';
            } else if ($action == 'hapus') {
              include 'pages/hapussupplier.php';
            }
          }else if ($pages == 'laporan') {
            include 'pages/laporan.php';
          } else if ($pages == 'profile') {
            include 'pages/profile.php';
          } else {
            include 'pages/404.php';
          }
        ?>
      </div>
</body>
</html>
<?php
} else {
  header("location:login.php");
}
?>