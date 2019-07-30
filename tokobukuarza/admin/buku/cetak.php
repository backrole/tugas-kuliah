<body text-align="center" onload="window.print();">
	<h3 class="text-muted">Data Buku <i class="fa fa-book"></i></h3>
<hr>
<table class="table table-stdiped table-bordered">
	<thead>
		<th>No ISBN</th>
		<th>Judul</th>
		<th>Penulis</th>
		<th>Penerbit</th>
		<th>Tahun</th>
		<th>Stok</th>
		<th>Harga Pokok</th>
		<th>Harga Jual</th>
		<th>PPN</th>
		<th>Diskon</th>
	</thead>
	<tbody>
		<?php  
			$select = $db->prepare("SELECT * FROM buku");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->noisbn; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->penulis; ?></td>
						<td><?php echo $tampil->penerbit; ?></td>
						<td><?php echo $tampil->tahun; ?></td>
						<td><?php echo $tampil->stok; ?></td>
						<td><?php echo $tampil->harga_pokok; ?></td>
						<td><?php echo $tampil->harga_jual; ?></td>
						<td><?php echo $tampil->ppn; ?></td>
						<td><?php echo $tampil->diskon; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</body>