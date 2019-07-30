<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Tambah Data Barang</strong></blockquote>
  </button>
</h5>
<?php  
    $tampil = $db->query("SELECT SUBSTR(MAX(kode_barang),4,6)AS max_id FROM data_barang");
    $tampil->execute();
    $data =$tampil->fetch(PDO::FETCH_LAZY);
    $id_max =$data->max_id;
    $sort_num = (int) substr($id_max, 0, 8);
    $sort_num++;
    $new_code = sprintf("%04s", $sort_num);
    $angkaformat=$new_code.'.01';

    $kode = @$_GET['kd'];
    $tampil = $db->query("SELECT * FROM data_barang WHERE kode_barang = '$kode'");
    $tampil->execute();
    $data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="nama" required type="text" name="nama" value="<?php echo $data->nama_barang; ?>" class="validate">
          <label for="nama">Nama Barang</label>
        </div>
        <div class="input-field col s3">
          <input id="sn" required type="number"  value="<?php echo $data->serial_number; ?>" name="sn" class="validate" min="0">
          <label for="sn">Serial Number</label>
        </div>
        <div class="input-field col s3">
          <input id="kode" required readonly="readonly" type="text" name="kode" value="<?php echo $data->kode_barang; ?>" class="validate">
          <label for="kode">Kode Barang</label>
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
        <div class="input-field col s6">
          <label for="date">Tanggal</label>
          <input required type="date"  value="<?php echo $data->tanggal; ?>" id="date" name="tanggal" class="datepicker">
        </div>
      <script>
        $(document).ready(function() {
            $('select').material_select();
        });
      </script>
      <div class="input-field col s6">
        <select required name="jenis_barang">
          <option value="Printer NGK58">Printer NGK58</option>
          <option value="Printer Epson">Printer Epson</option>
          <option value="Printer Canon">Printer Canon</option>
        </select>
        <label>Jenis Barang</label>
      </div>
      </div>
      <div class="row">
        <blockquote style="margin-left:10px;">
            <button class="btn waves-effect waves-light" value="simpan" name="simpan">Simpan<i class="material-icons left">save</i></button>&nbsp;&nbsp;&nbsp;
            <input type="reset" name="reset" value="loop" class="btn waves-effect waves-light center s1 material-icons blue small">&nbsp;&nbsp;&nbsp;
            <button class="btn waves-effect waves-light red" value="batal" name="batal">Batal<i class="material-icons right">cancel</i></button>
        </blockquote>
      </div>
    </form>
  </div>
  <?php  
    $nama = @$_POST['nama'];
    $tanggal = @$_POST['tanggal'];
    $kode = @$_POST['kode'];
    $sn = @$_POST['sn'];
    $jenis_barang = @$_POST['jenis_barang'];

    try {
        if (@$_POST['simpan']) {
            $update = $db->prepare("UPDATE data_barang SET kode_barang = ?, nama_barang = ?, jenis_barang = ?, serial_number = ?, tanggal = ? WHERE kode_barang = '$kode'");
            $update->execute(array($kode, $nama, $jenis_barang, $sn, $tanggal));
            if ($update->rowCount()>0) {
                ?>
                    <script>
                        alert("SUKSES Update Data Barang");
                        window.location.href="?page=barang";
                    </script>
                <?php
            }
        } else if (@$_POST['batal']) {
            ?>
                <script>
                    window.location.href="?page=barang";
                </script>
            <?php
        }
    } catch (Exception $e) {
        echo "Gagal Tambah Data".$e->getMessage();
    }
  ?>