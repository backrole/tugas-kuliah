			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<div class="dropdown pull-right">
							<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
								<i class="zmdi zmdi-more-vert"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>

						<a href=".?page=<?php echo encrypt('cetak') ?>&type=kasir"><h4 class="header-title m-t-0 m-b-30">Cetak</h4></a>

						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Telepon</th>
									<th>Username</th>
									<th>Status</th>
									<th>Akses</th>
									<th>Opsi</th>
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
									<td>
									<?php if($query['status'] == 0 ){ ?>
										<a href=".?page=<?php echo encrypt('kasir') ?>&id=<?php echo $query['id_kasir'] ?>&action=aktif">Belum Aktif</a>
									<?php } else { ?>
										<a href=".?page=<?php echo encrypt('kasir') ?>&id=<?php echo $query['id_kasir'] ?>&action=nonaktif">Aktif</a>
									<?php } ?>
									</td>
									<td><?php echo $query['akses'] ?></td>
									<td>
										<a href=".?page=<?php echo encrypt('kasir')?>&id=<?php echo $query['id_kasir'] ?>&action=edit"><i class="fa fa-pencil"></i></a>
										<a href=".?page=<?php echo encrypt('kasir')?>&id=<?php echo $query['id_kasir'] ?>&action=hapus" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div><!-- end col -->
			</div>



			<?php if(@$_GET['action'] == "edit" AND @$_GET['id']) { $ambil = show("kasir where id_kasir = '$_GET[id]'") or die (mysql_error()); $query = fetch($ambil);?>
				<div class="row">
				<div class="col-sm-12">
					<div class="card-box">

						<h4 class="header-title m-t-0 m-b-30">Edit Kasir</h4>

						<form method="post">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-md-2 control-label" >Nama</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="judul" value="<?php echo $query['nama'] ?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label " >Alamat</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="noisbn" value="<?php echo $query['alamat'] ?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Telepon</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="penulis" value="<?php echo $query['telepon'] ?>">
											</div>
										</div>
									</div>
								</div><!-- end col -->
								<div class="col-lg-6">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-md-2 control-label">Username</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="hj" value="<?php echo $query['username'] ?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label ">Akses</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="hp" value="<?php echo $query['akses'] ?>">
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right" name="perbarui">Simpan</button>
									</div>
								</div><!-- end col -->
							</div><!-- end row -->
						</form>
					</div>
				</div><!-- end col -->
			</div>
			<?php } else { ?>
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box">

						<h4 class="header-title m-t-0 m-b-30">Tambah Kasir</h4>

						<form method="post">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-md-2 control-label" >Nama</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="judul">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label " >Alamat</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="noisbn">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Telepon</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="penulis">
											</div>
										</div>
									</div>
								</div><!-- end col -->
								<div class="col-lg-6">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-md-2 control-label">Username</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="hj">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label" >Password</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="stok">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label ">Akses</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="hp">
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right" name="simpan">Simpan</button>
									</div>
								</div><!-- end col -->
							</div><!-- end row -->
						</form>
					</div>
				</div><!-- end col -->
			</div>
			<?php }
				if(isset($_POST['simpan'])) {
					extract($_POST);
					$id_distributor = "KSR".date("ymdis");
					insert("kasir","'$id_distributor','$judul','$noisbn','$penulis','0','$hj',md5('$stok'),'$hp'") or die (mysql_error());
					redirect(".?page=".encrypt("kasir")."");
				}
				if(isset($_POST['perbarui'])){
					extract($_POST);
					update("kasir","nama = '$judul', alamat = '$noisbn',telepon = '$penulis',username = '$hj', akses = '$hp' where id_kasir = '$_GET[id]'") or die (mysql_error());
					redirect(".?page=".encrypt("kasir")."");
				}
				if(@$_GET['action'] == "hapus" AND @$_GET['id']){
					delete("kasir where id_kasir = '$_GET[id]'") or die (mysql_error());
					redirect(".?page=".encrypt("kasir")."");
				}
				if(@$_GET['action'] == "aktif" AND @$_GET['id']){
					update("kasir","status ='1' where id_kasir = '$_GET[id]'") or die (mysql_error());
					redirect(".?page=".encrypt("kasir")."");
				}
				if(@$_GET['action'] == "nonaktif" AND @$_GET['id']){
					update("kasir","status ='0' where id_kasir = '$_GET[id]'") or die (mysql_error());
					redirect(".?page=".encrypt("kasir")."");
				}
			?>