<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Data Barang</strong><div class="right "><a href="?page=barang&action=tambah" class="btn-floating btn-large blue waves-effect waves-light" style="margin-right:0px;"><i class="material-icons">add</i></a></div></blockquote>
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
            <th data-field="kode">Kode Barang</th>
            <th data-field="name">Nama Barang</th>
            <th data-field="price">Serial Number</th>
            <th data-field="tanggal">Tanggal</th>
            <th data-field="stok">Stok</th>
            <th data-field="jenis">Jenis Barang</th>
            <th data-field="jumlah">Opsi</th>
        </tr>
    </thead>
    <tbody>
    <?php  
        $show = $db->query("SELECT * FROM data_barang a LEFT JOIN data_persediaan b ON a.nama_barang = b.nama_barang GROUP BY a.nama_barang ORDER BY tanggal ASC LIMIT $lim,$batas");
        $show->execute();
        $no = 1;
            while ($data = $show->fetch(PDO::FETCH_LAZY)) {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->kode_barang; ?></td>
            <td><?php echo $data->nama_barang; ?></td>
            <td><?php echo $data->serial_number; ?></td>
            <td><?php echo $data->tanggal; ?></td>
            <td><?php echo $data->stok_tersedia; ?></td>
            <td><?php echo $data->jenis_barang; ?></td>
            <td class="left">
                <a href="?page=barang&action=edit&kd=<?php echo $data->kode_barang; ?>" class="btn-floating btn-small waves-effect waves-light orange"><i class="material-icons">edit</i></a>
                    &nbsp;
                <a onclick="return confirm('Yakin akan Menghapus data.?');" class="btn-floating red modal-trigger" href="?page=barang&action=hapus&kd=<?php echo $data->kode_barang; ?>"><i class="material-icons">delete</i></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="pagination">
<?php  
  $paging = paging("data_barang", $batas, $hal, "?page=barang&");
  echo $paging;
?>
</div>
  <!-- Modal Structure -->
  <script>
    $(document).ready(function() {
         $('.modal-trigger').leanModal();
    });
  </script>