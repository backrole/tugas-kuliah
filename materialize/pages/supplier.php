<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Data Supplier</strong><div class="right "><a href="?page=supplier&action=tambah" class="btn-floating btn-large blue waves-effect waves-light" style="margin-right:0px;"><i class="mdi-content-add"></i></a></div></blockquote>
  </button>
</h5>
<hr class="orange">
  <?php  
  include 'function3.php';
  $batas = 6;
  if(@$_GET['hal'] == '') $hal = 1; else $hal = @$_GET['hal'];
  $lim = ($hal-1)*$batas;
  ?>    
<table class="striped">
    <thead>
        <tr>
            <th data-field="id">#</th>
            <th data-field="kode">Kode Supplier</th>
            <th data-field="name">Nama Supplier</th>
            <th data-field="jenis">Atas Nama</th>
            <th data-field="stok">Telp</th>
            <th data-field="jenis">Alamat</th>
            <th data-field="jumlah">Opsi</th>
        </tr>
    </thead>
    <tbody>
    <?php  
        $show = $db->query("SELECT * FROM supplier LIMIT $lim,$batas");
        $show->execute();
        $no = 1;
            while ($data = $show->fetch(PDO::FETCH_LAZY)) {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->nama; ?></td>
            <td><?php echo $data->atas_nama; ?></td>
            <td><?php echo $data->telp; ?></td>
            <td><?php echo $data->alamat; ?></td>
            <td class="left">
                <a href="?page=supplier&action=edit&kd=<?php echo $data->id; ?>" class="btn-floating btn-small waves-effect waves-light orange"><i class="mdi-editor-mode-edit"></i></a>
                    &nbsp;
                <a onclick="return confirm('Yakin akan Menghapus data.?');" class="btn-floating red modal-trigger" href="?page=supplier&action=hapus&kd=<?php echo $data->id; ?>"><i class="mdi-action-delete"></i></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<br>
<div class="pagination">
<?php  
  $paging = paging("data_barang", $batas, $hal, "?page=supplier&");
  echo $paging;
?>
</div>
  <!-- Modal Structure -->
  <script>
    $(document).ready(function() {
         $('.modal-trigger').leanModal();
    });
  </script>