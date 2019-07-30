<?php
  $id = @$_GET['id'];

  $hapus = $db->prepare("DELETE FROM barang_keluar WHERE id_keluar = ?");
  $hapus->execute(array($id));
  if ($hapus->rowCount()>0) {
      ?>
        <script type="text/javascript">
          window.location.href="?page=barangkeluar";
        </script>
      <?php
  }
?>