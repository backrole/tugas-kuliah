<body onload="window.print();">
	<h3 class="text-muted">Data Kasir <i class="fa fa-calculator"></i></h3>
<hr>
<table class="table table-stdiped table-bordered">
	<thead>
		<th>ID Kasir</th>
		<th>Nama Kasir</th>
		<th>Alamat</th>
		<th>Telepon</th>
		<th>Status</th>
		<th>Akses Level</th>
	</thead>
	<tbody>
		<?php  
			$select = $db->prepare("SELECT * FROM kasir");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_kasir; ?></td>
						<td><?php echo $tampil->nama; ?></td>
						<td><?php echo $tampil->alamat; ?></td>
						<td><?php echo $tampil->telepon; ?></td>
						<td><?php echo $tampil->status; ?></td>
						<td><?php echo $tampil->akses; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</body>