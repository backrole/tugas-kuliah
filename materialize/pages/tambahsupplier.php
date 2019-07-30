<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Tambah Data Supplier</strong>
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
?>
<div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="nama" required type="text" name="nama" class="validate">
          <label for="nama">Nama Supplier</label>
        </div>
        <div class="input-field col s3">
          <input id="telp" required type="number" name="telp" class="validate" min="0">
          <label for="telp">Telp</label>
        </div>
        <div class="input-field col s3">
          <input id="kode" required readonly="readonly" type="text" name="kode" value="SP<?php echo $new_code; ?>" class="validate">
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
          <input required type="text" id="an" name="an" class="validate">
        </div>
      <script>
        $(document).ready(function() {
            $('select').material_select();
        });
      </script>
      <div class="input-field col s6">
          <label for="alamat">Alamat</label>
          <input required type="text" id="alamat" name="alamat" class="validate">
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
            $input = $db->prepare("INSERT INTO supplier (id, nama, alamat, telp, atas_nama) VALUES (?,?,?,?,?)");
            $input->execute(array($kode, $nama, $alamat, $telp, $an));
            if ($input->rowCount()>0) {
                ?>
                    <script>
                        window.location.href="?page=supplier";
                    </script>
                <?php
            }
        }
    } catch (Exception $e) {
        echo "Gagal Tambah Data".$e->getMessage();
    }
  ?>