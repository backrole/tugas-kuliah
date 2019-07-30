<h5 class="blue-text margin-left:10px;">
  <blockquote><strong>Transaksi Barang Keluar</strong>
    <a href="?page=barangkeluar"><button class="btn-floating waves-effect waves-light right red" style="margin-right:10px;"><i class="mdi-av-fast-rewind right"></i></button></a>
    </blockquote>
</button>
</h5>
<?php  
    $tampil = $db->query("SELECT SUBSTR(MAX(id_keluar),4,6)AS max_id FROM barang_keluar");
    $tampil->execute();
    $data =$tampil->fetch(PDO::FETCH_LAZY);
    $id_max =$data->max_id;
    $sort_num = (int) substr($id_max, 0, 8);
    $sort_num++;
    $new_code = sprintf("%04s", $sort_num);
    $angkaformat="IDK".$new_code;
?>
<div class="row">
  <form class="col s12" method="post">
    <div class="row">
      <div class="input-field col s6">
        <select required name="nama_barang">
          <option value="" disabled selected>Pilih Barang</option>
          <?php  
          $tampil = $db->query("SELECT * FROM barang_masuk GROUP BY nama_barang");
          $tampil->execute();
          while ($data = $tampil->fetch(PDO::FETCH_LAZY)) {
           ?>
           <option value="<?php echo $data->nama_barang; ?>"><?php echo $data->nama_barang; ?></option>
           <?php  
           }
           ?>
       </select>
       <label>Nama Barang</label>
     </div>
        <div class="input-field col s3">
          <label for="jumlah">Jumlah Barang</label>
          <input required type="number" id="jumlah" name="jumlah" class="validate">
        </div>
        <div class="input-field col s3">
          <label for="id_keluar">ID_Keluar</label>
          <input required type="text" id="id_keluar" readonly="readonly" name="id_keluar" value="<?php echo $angkaformat; ?>" class="validate">
        </div>
   </div>
   <script>
    $(document).ready(function() {
      $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    }); 
  </script>
  <div class="row">
    <div class="input-field col s3">
      <label for="date">Tanggal</label>
      <input required type="date" id="date" name="tanggal" class="datepicker">
    </div>
    <div class="input-field col s3">
      <label for="harga">Harga(Rp)</label>
      <input required type="text" id="harga" name="harga" class="validate">
    </div>
    <div class="input-field col s6">
      <label for="tujuan">Tujuan</label>
      <input required type="text" id="tujuan" name="tujuan" class="validate">
    </div>
    <script>
      $(document).ready(function() {
        $('select').material_select();
      });
    </script>
    
  </div>
  <div class="row">
    <blockquote style="margin-left:10px;">
      <button class="btn waves-effect waves-light" value="simpan" name="simpan">Simpan<i class="mdi-content-save right"></i></button>&nbsp;&nbsp;&nbsp;
    </blockquote>
  </div>
</form>
</div>
<?php  
$nama = @$_POST['nama_barang'];
$tanggal = @$_POST['tanggal'];
$jumlah = @$_POST['jumlah'];
$tujuan = @$_POST['tujuan'];
$id_keluar = @$_POST['id_keluar'];
$harga = @$_POST['harga'];

try {
  if (@$_POST['simpan']) {
      $in = $db->prepare("INSERT INTO barang_keluar (id_keluar, nama_barang, tgl, jumlah, tujuan, harga) VALUES (?,?,?,?,?,?) ");
      $ins = array($id_keluar, $nama, $tanggal, $jumlah, $tujuan, $harga);
      $in->execute($ins);
      if ($in->rowCount()>0) {
        $insert = $db->prepare("UPDATE data_persediaan SET keluar = keluar + ?, stok_tersedia = stok_tersedia - ? WHERE nama_barang = '$nama'");
        $insert->execute(array($jumlah, $jumlah));
        if ($insert->rowCount()>0) {
          ?>
            <script>
                window.location.href="?page=barangkeluar";
            </script>
          <?php
        }
        ?>
            <script>
                window.location.href="?page=barangkeluar";
            </script>
          <?php
      }
    }
} catch (Exception $e) {
  echo "Gagal Tambah Data ".$e->getMessage();
}
?>