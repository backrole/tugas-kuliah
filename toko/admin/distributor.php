						</script>
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

									<a href=".?page=<?php echo encrypt('cetak') ?>&type=distributor"><h4 class="header-title m-t-0 m-b-30">Cetak</h4></a>

									<table id="datatable" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th width="50px">No</th>
												<th>ID Distributor</th>
												<th>Nama</th>
												<th>Alamat</th>
												<th>Telepon</th>
												<th>Opsi</th>
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
												<td>
													<a href=".?page=<?php echo encrypt('distributor')?>&id=<?php echo $query['id_distributor'] ?>&action=edit"><i class="fa fa-pencil"></i></a>
													<a href=".?page=<?php echo encrypt('distributor')?>&id=<?php echo $query['id_distributor'] ?>&action=hapus" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div><!-- end col -->
						</div>



						<?php if(@$_GET['action'] == "edit" AND @$_GET['id']) { $ambil = show("distributor where id_distributor = '$_GET[id]'") or die (mysql_error()); $query = fetch($ambil);?>
							<div class="row">
							<div class="col-sm-6">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Edit Distributor</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label">Nama</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nama" value="<?php echo $query['nama_distributor'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Alamat</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="alamat" value="<?php echo $query['alamat'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Telepon</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="telepon" maxlength="13" value="<?php echo $query['telepon'] ?>">
														</div>
													</div>
													<button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right" name="perbarui">Perbarui</button>
												</div>
											</div><!-- end col -->
										</div><!-- end row -->
									</form>
								</div>
							</div><!-- end col -->
						</div>
						<?php } else { ?>
						<div class="row">
							<div class="col-sm-6">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Tambah Distributor</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Nama</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nama">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >Alamat</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="alamat">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Telepon</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="telepon" maxlength="13">
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
								$id_distributor = "DTR".date("ymdis");
								insert("distributor","'$id_distributor','$nama','$alamat','$telepon'") or die (mysql_error());
								redirect(".?page=".encrypt("distributor")."");
							}
							if(isset($_POST['perbarui'])){
								extract($_POST);
								update("distributor","nama_distributor = '$nama',alamat = '$alamat' where id_distributor = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("distributor")."");
							}
							if(@$_GET['action'] == "hapus" AND @$_GET['id']){
								delete("distributor where id_distributor = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("distributor")."");
							}
						?>
						