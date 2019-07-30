<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Edit Data Supplier</strong>
            <a href="?page=supplier"><button class="btn-floating waves-effect waves-light right red" style="margin-right:10px;"><i class="mdi-av-fast-rewind right"></i></button></a>
    </blockquote>
  </button>
</h5>
<?php  
    $tampil = $db->query("SELECT SUBSTR(MAX(id),4,6)AS max_id FROM supplier");
    $tampil->execute();
    $data =$tampil->fetch(PDO::FETCH_LAZY);
    $id_max =$data->max_id;
    $sort_num = (int) substr($id_max, 0, 8);
    $sort_num++;
    $new_code = sprintf("%04s", $sort_num);
    $angkaformat=$new_code.'.01';

    $kode = @$_GET['kd'];
    $tampil = $db->query("SELECT * FROM supplier WHERE id = '$kode'");
    $tampil->execute();
    $data = $tampil->fetch(PDO::FETCH_LAZY);
?>
<div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="nama" required type="text" name="nama" value="<?php echo $data->nama; ?>" class="validate">
          <label for="nama">Nama Supplier</label>
        </div>
        <div class="input-field col s3">
          <input id="telp" required type="number" name="telp" value="<?php echo $data->telp; ?>" class="validate" min="0">
          <label for="telp">Telp</label>
        </div>
        <div class="input-field col s3">
          <input id="kode" required readonly="readonly" type="text" value="<?php echo $data->id; ?>" name="kode" class="validate">
          <label for="kode">Kode Supplier</label>
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
          <label for="AN">Atas Nama</label>
          <input required type="text" id="an" name="an" value="<?php echo $data->atas_nama; ?>" class="validate">
        </div>
      <script>
        $(document).ready(function() {
            $('select').material_select();
        });
      </script>
      <div class="input-field col s6">
          <label for="alamat">Alamat</label>
          <input required type="text" id="alamat" name="alamat" value="<?php echo $data->alamat; ?>" class="validate">
      </div>
      </div>
      <div class="row">
        <blockquote style="margin-left:10px;">
            <button class="btn waves-effect waves-light blue" value="simpan" name="simpan">Simpan<i class="mdi-content-save right"></i></button>&nbsp;&nbsp;&nbsp;
        </blockquote>
      </div>
    </form>
  </div>
  <?php  
    $nama = @$_POST['nama'];
    $alamat = @$_POST['alamat'];
    $kode = @$_POST['kode'];
    $telp = @$_POST['telp'];
    $an = @$_POST['an'];
try {
        if (@$_POST['simpan']) {
            $update = $db->prepare("UPDATE supplier SET nama = ?, alamat = ?, telp = ?, atas_nama = ? WHERE id = '$kode'");
            $update->execute(array($nama, $alamat, $telp, $an));
            if ($update->rowCount()>0) {
                ?>
                    <script>
                        alert("SUKSES Update Data Supplier");
                        window.location.href="?page=supplier";
                    </script>
                <?php
            }
        } else if (@$_POST['batal']) {
            ?>
                <script>
                    window.location.href="?page=supplier";
                </script>
            <?php
        }
    } catch (Exception $e) {
        echo "Gagal Edit Data".$e->getMessage();
    }
  ?>