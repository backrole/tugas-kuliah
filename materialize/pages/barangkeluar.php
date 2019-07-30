<h5 class="blue-text margin-left:10px;">
    <blockquote><strong>Data Barang Keluar</strong><div class="right "><a href="?page=barangkeluar&action=tambah" class="btn-floating btn-large blue waves-effect waves-light" style="margin-right:0px;"><i class="mdi-content-add"></i></a></div></blockquote>
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
            <th data-field="kode">Kode</th>
            <th data-field="name">Nama Barang</th>
            <th data-field="tanggal">Terakhir Diubah</th>
            <th data-field="jumlah">Jumlah</th>
            <th data-field="tujuan">Tujuan</th>
            <th data-field="harga">Harga</th>
            <th data-field="opsi">Opsi</th>
        </tr>
    </thead>
    <tbody>
    <?php  
        $show = $db->query("SELECT * FROM barang_keluar ORDER BY tgl ASC LIMIT $lim,$batas");
        $show->execute();
        $no = 1;
            while ($data = $show->fetch(PDO::FETCH_LAZY)) {
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->id_keluar; ?></td>
            <td><?php echo $data->nama_barang; ?></td>
            <td><?php echo $data->tgl; ?></td>
            <td><?php echo $data->jumlah; ?></td>
            <td><?php echo $data->tujuan; ?></td>
            <td><?php echo $data->harga; ?></td>
            <td class="center">
                <a onclick="return confirm('Yakin akan Menghapus data.?');" class="left btn-floating red modal-trigger" href="?page=barangkeluar&action=hapus&id=<?php echo $data->id_keluar; ?>"><i class="mdi-action-delete"></i></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</tbody>
</table>
<br>
  <!-- Modal Structure -->
<div class="pagination">
<?php  
  $paging = paging("barang_keluar", $batas, $hal, "?page=barangkeluar&");
  echo $paging;
?>
</div>
  <script>
  $(document).ready(function() {
    $('.modal-trigger').leanModal();
  });
  </script>
