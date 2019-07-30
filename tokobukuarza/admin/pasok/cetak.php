<body onload="window.print();">
	<h3 class="text-muted">Data Pasok <i class="fa fa-laptop"></i></h3>
<hr>
<table class="table table-stdiped table-bordered">
	<thead>
		<th>ID Pasok</th>
		<th>Nama Distributor</th>
		<th>Nama Buku</th>
		<th>Jumlah</th>
		<th>Tanggal</th>
	</thead>
	<tbody>
		<?php  
			$select = $db->prepare("SELECT * FROM pasok a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN distributor c ON a.id_distributor = c.id_distributor");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_pasok; ?></td>
						<td><?php echo $tampil->nama_distributor; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</body>