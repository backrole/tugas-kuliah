<body onload="window.print();">
	<h3 class="text-muted">Data Penjualan <i class="fa fa-calculator"></i></h3>
<hr>
<table class="table table-stdiped table-bordered">
	<thead>
		<th>ID Penjualan</th>
		<th>Nama Buku</th>
		<th>Nama Kasir</th>
		<th>Jumlah</th>
		<th>Total</th>
		<th>Tanggal</th>
	</thead>
	<tbody>
		<?php  
			$select = $db->prepare("SELECT * FROM penjualan a LEFT JOIN buku b ON a.id_buku = b.id_buku LEFT JOIN kasir c ON a.id_kasir = c.id_kasir");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_penjualan; ?></td>
						<td><?php echo $tampil->judul; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->jumlah; ?></td>
						<td><?php echo $tampil->total; ?></td>
						<td><?php echo $tampil->tanggal; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</body>