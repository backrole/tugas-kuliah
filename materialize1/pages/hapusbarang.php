<?php
  $kode = @$_GET['kd'];

  $hapus = $db->prepare("DELETE FROM data_barang WHERE kode_barang = ?");
  $hapus->execute(array($kode));
  if ($hapus->rowCount()>0) {
    ?>
      <script type="text/javascript">
        window.location.href="?page=barang";
      </script>
    <?php
  }
?>