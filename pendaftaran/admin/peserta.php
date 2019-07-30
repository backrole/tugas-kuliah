<div class="col-md-12">
	<div style="border-left:3px solid blue;" class="well well-sm"><a href=".?page=peserta">Peserta</a></div>
</div>
<!-- panel -->
<div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title">Peserta </span> 
			<div class="pull-right">
				<a href=".?page=peserta&action=insert" title=""><button class="fa fa-plus-circle btn btn-info"></button>
				</a>
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No Identitas</th>
						<th>Nama</th>
						<th>Audisi</th>
						<th>Jenis Kelamin</th>
						<th>Status</th>
						<th>TTL</th>
						<th>Alamat</th>
						<th>Kode Pos</th>
						<th>Provinsi</th>
						<th>Telepon</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$tampil = $db->prepare("SELECT * FROM daftar");
					$tampil->execute();
					while ($data = $tampil->fetch(PDO::FETCH_LAZY)) {
						?>
						<tr>
							<td><?php echo $data->no_identitas; ?></td>
							<td><?php echo $data->nama; ?></td>
							<td><?php echo $data->audisi; ?></td>
							<td><?php echo $data->jk; ?></td>
							<td><?php echo $data->status; ?></td>
							<td><?php echo $data->tempat_lahir; ?>,<?php echo $data->tgl_lahir; ?></td>
							<td><?php echo $data->alamat; ?></td>
							<td><?php echo $data->kode_pos; ?></td>
							<td><?php echo $data->provinsi; ?></td>
							<td><?php echo $data->telepon; ?></td>
							<td>
								<a href=".?page=peserta&action=edit&kd=<?php echo $data->no_pendaftaran; ?>" class="btn btn-primary">Edit</a>
								<a href=".?page=peserta&action=delete&kd=<?php echo $data->no_pendaftaran; ?>" class="btn btn-danger">Delete</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<div class="row container">
				<div class="form-group">
					<form name="myForm" id="myForm" class="col-md-12" onSubmit="return validateForm()"  method ="post" enctype="multipart/form-data">
						<input type="file" id="filepesertaall" class="col-md-3" name="filepesertaall" /> <div class="clearfix">
						<input type="submit" name="submit" value="import" class="col-md-1" />&nbsp;
						<label><input type="checkbox" name="drop" class="" value="1" /><u> Kosongkan tabel sql terlebih dahulu.</u></label>
					</form>
					<?php
					require "../excel_reader.php";
					if(isset($_POST['submit'])){
						$target = basename ($_FILES['filepesertaall']['name']);
						move_uploaded_file($_FILES['filepesertaall']['tmp_name'],$target);
						$data = new Spreadsheet_Excel_Reader($_FILES['filepesertaall']['name'],false);
						$baris = $data->rowCount($sheet_index=0);
						$drop = isset($_POST["drop"])?$_POST["drop"]: 0 ;
						if($drop == 1){
							$truncate = "TRUNCATE TABLE daftar";
							$db->query($truncate);
						};

						for ($i=2; $i <=$baris;$i++)
						{
							$audisi = $data->val($i, 1);
							$nama = $data->val($i, 2);
							$jk = $data->val($i, 3);
							$status = $data->val($i, 4);
							$tempat_lahir = $data->val($i, 5);
							$tanggal_lahir = $data->val($i, 6);
							$no = $data->val($i, 7);
							$alamat = $data->val($i, 8);
							$kota = $data->val($i, 9);
							$provinsi = $data->val($i, 10);
							$kode_pos = $data->val($i, 11);
							$pekerjaan = $data->val($i, 12);
							$telepon = $data->val($i, 12);
							$query = $db->prepare("INSERT into daftar (audisi,nama,jk,status,tempat_lahir,tgl_lahir,no_identitas,alamat,kota,provinsi,kode_pos,pekerjaan,telepon) values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
							$array = array($audisi,$nama,$jk,$status,$tempat_lahir,$tanggal_lahir, $no, $alamat, $kota, $provinsi, $kode_pos, $pekerjaan, $telepon);
							$query->execute($array);
	// $hasil = mysql_query($query);
						}

						if(!$query){
							die(mysql_error());
						} else {
							// echo "Data berhasil diimpor.";
							?>
								<script>
									alert("Sukses Import Data!");
									window.location.href=".?page=peserta";
								</script>
							<?php
						}
						unlink($_FILES['filepesertaall']['name']);
					}
					?>

					<script type="text/javascript">
						function validateForm()
						{
							function hasExtension(inputID, exts){
								var fileName = document.getElementByld(inputID). value;
								return (new RegExp('(+exts.join('|').replace(/\./g,'\\.')+')).test(fileName);
							}
							if(!hasExtension ('filepesertaall',[.xls])){
								alert("Hanya file XLS (Excel 2003) yang diijinkan.");
								return false;
							}
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
