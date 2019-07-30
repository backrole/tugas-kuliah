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

									<a href=".?page=<?php echo encrypt('cetak') ?>&type=buku"><h4 class="header-title m-t-0 m-b-30">Cetak</h4></a>

									<table id="datatable" class="table table-striped table-bordered">
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
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
										<?php $no = 1; $ambil = show("buku a left join pemasok b on a.id_buku = b.id_buku"); while($query = fetch($ambil)) { ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $query['judul'] ?></td>
												<td><?php echo $query['noisbn'] ?></td>
												<td><?php echo $query['penulis'] ?></td>
												<td><?php echo $query['penerbit'] ?></td>
												<td><?php echo $query['tahun'] ?></td>
												<td><?php echo $query['stok'] ?></td>
												<td><?php echo "Rp. "; echo number_format($query['harga_pokok'],2,",","."); ?></td>
												<td><?php echo "Rp. "; echo number_format($query['harga_jual'],2,",","."); ?></td>
												<td><?php echo $query['ppn']."%" ?></td>
												<td><?php echo $query['diskon']."%" ?></td>
												<td>
													<a href=".?page=<?php echo encrypt('buku')?>&id=<?php echo $query['id_buku'] ?>&action=edit"><i class="fa fa-pencil"></i></a>
													<a href=".?page=<?php echo encrypt('buku')?>&id=<?php echo $query['id_buku'] ?>&action=hapus" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div><!-- end col -->
						</div>



						<?php if(@$_GET['action'] == "edit" AND @$_GET['id']) { $ambil = show("buku where id_buku = '$_GET[id]'") or die (mysql_error()); $query = fetch($ambil);?>
							<div class="row">
							<div class="col-sm-12">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Edit Buku</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Judul</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="judul" value="<?php echo $query['judul'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >NOISBN</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="noisbn" value="<?php echo $query['noisbn'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Penulis</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="penulis" value="<?php echo $query['penulis'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Penerbit</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="penerbit" value="<?php echo $query['penerbit'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Tahun</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="tahun" value="<?php echo $query['tahun'] ?>">
														</div>
													</div>
												</div>
											</div><!-- end col -->
											<div class="col-lg-6">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Stok</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="stok" value="<?php echo $query['stok'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >Harga Pokok</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="hp" value="<?php echo $query['harga_pokok'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Harga Jual</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="hj" value="<?php echo $query['harga_jual'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">PPN</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="ppn" value="<?php echo $query['ppn'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Diskon</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="diskon" value="<?php echo $query['diskon'] ?>">
														</div>
													</div>
													<button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right" name="perbarui">Simpan</button>
												</div>
											</div><!-- end col -->
										</div><!-- end row -->
								</div>
							</div><!-- end col -->
						</div>
						<?php } else { ?>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Tambah Buku</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Judul</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="judul">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >NOISBN</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="noisbn">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Penulis</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="penulis">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Penerbit</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="penerbit">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Tahun</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="tahun">
														</div>
													</div>
												</div>
											</div><!-- end col -->
											<div class="col-lg-6">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Stok</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="stok">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >Harga Pokok</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="hp">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Harga Jual</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="hj">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">PPN</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="ppn">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Diskon</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="diskon">
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
								$id_distributor = "BKU".date("ymdis");
								insert("buku","'$id_distributor','$judul','$noisbn','$penulis','$penerbit','$tahun','$stok','$hp','$hj','$ppn','$diskon'") or die (mysql_error());
								redirect(".?page=".encrypt("buku")."");
							}
							if(isset($_POST['perbarui'])){
								extract($_POST);
								update("buku","judul = '$judul',noisbn = '$noisbn', penulis = '$penulis', penerbit = '$penerbit',tahun =  '$tahun', stok = '$stok', harga_pokok = '$hp',harga_jual = '$hj', ppn = '$ppn', diskon = '$diskon' where id_buku = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("buku")."");
							}
							if(@$_GET['action'] == "hapus" AND @$_GET['id']){
								delete("buku where id_buku = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("buku")."");
							}
						?>
						