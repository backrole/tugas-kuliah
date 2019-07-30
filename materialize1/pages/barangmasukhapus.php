<?php
  $kode = @$_GET['kd'];
  $id = @$_GET['id'];

  $hapus = $db->prepare("DELETE FROM barang_masuk WHERE id_masuk = ?");
  $hapus->execute(array($kode));
  if ($hapus->rowCount()>0) {
      ?>
        <script type="text/javascript">
          window.location.href="?page=barangmasuk";
        </script>
      <?php
  }
?>