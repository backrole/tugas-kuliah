<script type="text/javascript">
window.print();
</script>
<?php if(@$_GET['type'] == "buku"){ ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Judul</th>
			<th>NOISBN</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Tahun</th>
			<th>Stok</th>
			<th>Harga Pokok</th>
			<th>Harga Jual</th>
			<th>PPN</th>
			<th>DISKON</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; $ambil = show("buku"); while($query = fetch($ambil)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $query['judul'] ?></td>
			<td><?php echo $query['noisbn'] ?></td>
			<td><?php echo $query['penulis'] ?></td>
			<td><?php echo $query['penerbit'] ?></td>
			<td><?php echo $query['tahun'] ?></td>
			<td><?php echo $query['stok'] ?></td>
			<td><?php echo $query['harga_pokok'] ?></td>
			<td><?php echo $query['harga_jual'] ?></td>
			<td><?php echo $query['ppn'] ?></td>
			<td><?php echo $query['diskon']."%" ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } if(@$_GET['type'] == "distributor") { ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>ID Distributor</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telepon</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; $ambil = show("distributor"); while($query = fetch($ambil)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $query['id_distributor'] ?></td>
			<td><?php echo $query['nama_distributor'] ?></td>
			<td><?php echo $query['alamat'] ?></td>
			<td><?php echo $query['telepon'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } if(@$_GET['type'] == "kasir") { ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Username</th>
			<th>Akses</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; $ambil = show("kasir"); while($query = fetch($ambil)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $query['nama'] ?></td>
			<td><?php echo $query['alamat'] ?></td>
			<td><?php echo $query['telepon'] ?></td>
			<td><?php echo $query['username'] ?></td>
			<td><?php echo $query['akses'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } if(@$_GET['type'] == "pemasok") { ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>ID Pasok</th>
			<th>Nama Distributor</th>
			<th>Judul Buku</th>
			<th>Jumlah</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; $ambil = show("pemasok a left join distributor b on a.id_distributor = b.id_distributor left join buku c on a.id_buku = c.id_buku"); while($query = fetch($ambil)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $query['id_pasok'] ?></td>
			<td><?php echo $query['nama_distributor'] ?></td>
			<td><?php echo $query['judul'] ?></td>
			<td><?php echo $query['jumlah'] ?></td>
			<td><?php echo $query['tanggal'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } if(@$_GET['type'] == "penjualan") { ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>Buku</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Kasir</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; $ambil = show("penjualan a left join buku b on a.id_buku = b.id_buku left join kasir c on a.id_kasir = c.id_kasir order by tanggal asc"); while($query = fetch($ambil)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $query['judul'] ?></td>
			<td><?php echo $query['jumlah'] ?></td>
			<td><?php echo $query['total'] ?></td>
			<td><?php echo $query['nama'] ?></td>
			<td><?php echo $query['tanggal'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } ?>