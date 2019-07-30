<body onload="window.print();">
	<h3 class="text-muted">Data Distributor <i class="fa fa-user"></i></h3>
<hr>
<table class="table table-stdiped table-bordered">
	<thead>
		<th>ID Distributor</th>
		<th>Nama Distributor</th>
		<th>Alamat</th>
		<th>Telepon</th>
	</thead>
	<tbody>
		<?php  
			$select = $db->prepare("SELECT * FROM distributor");
			$select->execute();
			while ($tampil = $select->fetch(PDO::FETCH_LAZY)) {
				?>
					<tr>
						<td><?php echo $tampil->id_distributor; ?></td>
						<td><?php echo $tampil->nama_distributor; ?></td>
						<td><?php echo $tampil->alamat; ?></td>
						<td><?php echo $tampil->telepon; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</body>