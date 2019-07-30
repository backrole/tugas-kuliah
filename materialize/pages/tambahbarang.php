<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Tambah Data Barang</strong>
            <a href="?page=barang"><button class="btn-floating waves-effect waves-light right red" style="margin-right:10px;"><i class="mdi-av-fast-rewind right"></i></button></a>
    </blockquote>
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
?>
<div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="nama" required type="text" name="nama" class="validate">
          <label for="nama">Nama Barang</label>
        </div>
        <div class="input-field col s3">
          <input id="sn" required type="number" name="sn" class="validate" min="0">
          <label for="sn">Serial Number</label>
        </div>
        <div class="input-field col s3">
          <input id="kode" required readonly="readonly" type="text" name="kode" value="IDM<?php echo $new_code; ?>" class="validate">
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
          <input required type="date" id="date" name="tanggal" class="datepicker">
        </div>
      <script>
        $(document).ready(function() {
            $('select').material_select();
        });
      </script>
      <div class="input-field col s3">
        <select required name="jenis_barang">
          <option value="" disabled selected>Pilih Jenis Barang</option>
          <option value="Kertas Thermal">Kertas Thermal</option>
          <option value="Printer NGK58">Printer NGK58</option>
          <option value="Charger Printer">Charger Printer</option>
          <option value="Baterai Printer">Baterai Printer</option>
          <option value="Mechanic">Mechanic</option>
          <option value="HP">HP</option>
        </select>
        <label>Jenis Barang</label>
      </div>
      <div class="input-field col s3">
      <?php  
      $tam = $db->query("SELECT * FROM supplier");
      $tam->execute();
      ?>
        <select required name="supplier">
        <?php while ($tam = $da->fetch(PDO::FETCH_LAZY)) {
          ?>
          <option value="<?php echo $da->id; ?>" ><?php echo $da->nama; ?></option>
          <?php
        } ?>
        </select>
        <label>Jenis Barang</label>
      </div>
      </div>
      <div class="row">
        <blockquote style="margin-left:10px;">
            <button class="btn waves-effect waves-light blue" value="simpan" name="simpan">Simpan<i class="mdi-content-save right"></i></button>&nbsp;&nbsp;&nbsp;
        </blockquote>
      </div>
      <?php  
        $tampil = $db->query("SELECT SUBSTR(MAX(id_masuk),4,6)AS max_id FROM data_persediaan");
        $tampil->execute();
        $data =$tampil->fetch(PDO::FETCH_LAZY);
        $id_max =$data->max_id;
        $sort_num = (int) substr($id_max, 0, 8);
        $sort_num++;
        $new_code = sprintf("%04s", $sort_num);
        $nya="IDM".$new_code;
      ?>
      <input type="hidden" value="<?php echo $nya; ?>" name="id_masuk">
    </form>
  </div>
  <?php  
    $nama = @$_POST['nama'];
    $tanggal = @$_POST['tanggal'];
    $kode = @$_POST['kode'];
    $sn = @$_POST['sn'];
    $id_masuk = @$_POST['id_masuk'];
    $jenis_barang = @$_POST['jenis_barang'];

    try {
        if (@$_POST['simpan']) {
            $input = $db->prepare("INSERT INTO data_barang (kode_barang, nama_barang, jenis_barang, serial_number, tanggal) VALUES (?,?,?,?,?)");
            $input->execute(array($kode, $nama, $jenis_barang, $sn, $tanggal));
            if ($input->rowCount()>0) {
              $insert->execute($array);
              if ($insert->rowCount()>0) {
                ?>
                    <script>
                        window.location.href="?page=barang";
                    </script>
                <?php
              }
            }
        }
    } catch (Exception $e) {
        echo "Gagal Tambah Data".$e->getMessage();
    }
  ?>