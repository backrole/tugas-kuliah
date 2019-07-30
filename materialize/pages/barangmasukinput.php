<h5 class="blue-text margin-left:10px;">
  <blockquote><strong>Transaksi Barang Masuk</strong>
    <a href="?page=barangmasuk"><button class="btn-floating waves-effect waves-light right red" style="margin-right:10px;"><i class="mdi-av-fast-rewind right"></i></button></a>
    </blockquote>
</button>
</h5>
      <?php  
        $tampil = $db->query("SELECT SUBSTR(MAX(id_masuk),4,6)AS max_id FROM barang_masuk");
        $tampil->execute();
        $data =$tampil->fetch(PDO::FETCH_LAZY);
        $id_max =$data->max_id;
        $sort_num = (int) substr($id_max, 0, 8);
        $sort_num++;
        $new_code = sprintf("%04s", $sort_num);
        $nya="IDM".$new_code;
      ?>
<div class="row">
  <form class="col s12" method="post">
    <div class="row">
      <input type="hidden" value="<?php echo $nya; ?>" name="id_masuk">
      <div class="input-field col s4">
        <select required name="nama">
          <option value="" disabled selected>Pilih Barang</option>
          <?php  
          $tampil = $db->query("SELECT * FROM data_barang");
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
      <div class="input-field col s2">
          <label for="harga">Harga Barang(Rp)</label>
          <input required type="number" id="harga" name="harga" class="validate">
        </div>
        <div class="input-field col s3">
          <label for="jumlah">Jumlah Barang</label>
          <input required type="number" id="jumlah" name="jumlah" class="validate">
        </div>
   <script>
    $(document).ready(function() {
      $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    }); 
  </script>
    <div class="input-field col s3">
      <label for="date">Tanggal</label>
      <input required type="date" id="date" name="tanggal" class="datepicker">
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
date_default_timezone_set("Asia/Jakarta");
$jam =  date('h:i');
$nama = @$_POST['nama'];
$tanggal = @$_POST['tanggal'];
$lengkap = $jam."&nbsp;/".$tanggal;
$kode = @$_POST['kodemasuk'];
$jumlah = @$_POST['jumlah'];
$id_masuk = @$_POST['id_masuk'];
$harga = @$_POST['harga'];

try {
  if (@$_POST['simpan']) {
      $in = $db->prepare("UPDATE data_persediaan SET stok_awal = stok_awal + ?, masuk = masuk + ?, stok_tersedia = stok_tersedia + ? WHERE nama_barang = '$nama' ");
      $ins = array($jumlah, $jumlah, $jumlah);
      $in->execute($ins);
      if ($in->rowCount()>0) {
        $insert = $db->prepare("INSERT INTO barang_masuk (id_masuk, tgl, nama_barang, jumlah, harga) VALUES (?,?,?,?,?) ");
        $insert->execute(array($id_masuk, $lengkap, $nama, $jumlah, $harga));
        if ($insert->rowCount()>0) {
          ?>
            <script>
                window.location.href="?page=barangmasuk";
            </script>
          <?php
        }
      }
    }
} catch (Exception $e) {
  echo "Gagal Tambah Data ".$e->getMessage();
}
?>