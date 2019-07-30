<?php
  $kode = @$_GET['kd'];
  $id = @$_GET['id'];

  $hapus = $db->prepare("DELETE FROM supplier WHERE id = ?");
  $hapus->execute(array($kode));
  if ($hapus->rowCount()>0) {
      ?>
        <script type="text/javascript">
          window.location.href="?page=supplier";
        </script>
      <?php
  }
?>