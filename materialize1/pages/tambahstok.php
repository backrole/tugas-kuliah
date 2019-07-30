<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Tambah Barang Masuk</strong>
    <a href="?page=barangmasuk"><button class="btn-floating waves-effect waves-light right red" style="margin-right:10px;"><i class="material-icons right">fast_rewind</i></button></a>
    </blockquote>
</button>
</h5>
<?php  
    $id = @$_GET['id'];
    $tampil = $db->query("SELECT * FROM data_persediaan WHERE id_masuk = '$id'");
    $tampil->execute();
    $data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="row">
    <form class="col s12" method="post">
      <div class="row">
          <div class="input-field col s5">
            <label for="stokawal">Stok Awal</label>
            <input type="text" readonly="readonly" name="stokawal" value="<?php echo $data->stok_tersedia; ?>" id="stokawal" class="validate">
          </div>
          <div class="col" style="margin-top:23px;"><i class="material-icons">add</i></div>
          <div class="input-field col s5">
            <label for="tambahan">Barang yang ditambah</label>
            <input type="text" name="tambahan" id="tambahan" class="validate">
          </div>
          <div class="input-field col s1">
            <button class="btn-floating waves-effect waves-light green" name="tambahjumlah" value="tambahjumlah"><i class="material-icons">update</i></button>
          </div>
      </div>
      <?php  
      date_default_timezone_set('Asia/Jakarta');
      $tanggal = date("l, d M Y");
      ?>
      <div class="row ">
        <div class="input-field col s5 ">
            <label for="tanggal">Tanggal DiUbah</label>
            <input type="text" name="tanggal" readonly="readonly" id="tanggal" class="validate" value="<?php echo $tanggal; ?>">
        </div>
      </div>
  </form>
</div>
<?php 
    $tambahan = @$_POST['tambahan'];
    $id = @$_GET['id'];
    try {
        if (@$_POST['tambahjumlah']) {
            $update = $db->prepare("UPDATE data_persediaan SET masuk = masuk + ?, stok_tersedia = stok_tersedia + ? WHERE id_masuk = '$id'");
            $update->execute(array($tambahan, $tambahan));
            if ($update->rowCount()>0) {
                $update1 = $db->prepare("UPDATE barang_masuk SET tgl = ? WHERE id_masuk = '$id'");
                $update1->execute(array($tanggal));
                if ($update1->rowCount()>0) {
                    ?>
                        <script>
                                window.location.href="?page=barangmasuk";
                        </script>
                    <?php
                }
            }
        }
    } catch (Exception $e) {
        echo "Gagal Tambah Barang Masuk ".$e->getMessage()." Kemungkinan data sudah ada!";
    }
?>