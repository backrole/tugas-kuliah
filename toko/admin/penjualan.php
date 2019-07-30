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

									<a href=".?page=<?php echo encrypt('cetak') ?>&type=penjualan"><h4 class="header-title m-t-0 m-b-30">Cetak</h4></a>

									<table id="datatable" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th width="50px">No</th>
												<th>Buku</th>
												<th>Jumlah</th>
												<th>Total</th>
												<th>Kasir</th>
												<th>Tanggal</th>
												<th>Opsi</th>
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
												<td>
													<a href=".?page=<?php echo encrypt('penjualan')?>&id=<?php echo $query['id_penjualan'] ?>&action=edit"><i class="fa fa-pencil"></i></a>
													<a href=".?page=<?php echo encrypt('penjualan')?>&id=<?php echo $query['id_penjualan'] ?>&action=hapus" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div><!-- end col -->
						</div>



						<?php if(@$_GET['action'] == "edit" AND @$_GET['id']) { $ambil = show("penjualan where id_penjualan = '$_GET[id]'") or die (mysql_error()); $query1 = fetch($ambil);?>
							<div class="row">
							<div class="col-sm-6">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Edit Penjualan</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Buku</label>
														<div class="col-md-10">
															<select name="buku" class="form-control">
																<option value="">--Pilih Buku--</option>
																<?php $ambil = show("buku order by judul asc"); while($query = fetch($ambil)) { ?>
																<option value="<?php echo $query['id_buku'] ?>" <?php if($query['id_buku'] != "") {echo "selected";} ?>><?php echo $query['judul'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >Kasir</label>
														<div class="col-md-10">
															<select name="alamat" class="form-control">
																<option value="">--Pilih Kasir--</option>
																<?php $ambil = show("kasir where status='1' order by nama asc"); while($query = fetch($ambil)) { ?>
																<option value="<?php echo $query['id_kasir'] ?>" <?php if($query['id_kasir'] != "") {echo "selected";} ?>><?php echo $query['nama'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Jumlah</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="telepon"  value="<?php echo $query1['jumlah'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label" >Total</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nama" value="<?php echo $query1['total'] ?>">
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
							<div class="col-sm-6">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Tambah Penjualan</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label" >Buku</label>
														<div class="col-md-10">
															<select name="buku" class="form-control">
																<option value="">--Pilih Buku--</option>
																<?php $ambil = show("buku order by judul asc"); while($query = fetch($ambil)) { ?>
																<option value="<?php echo $query['id_buku'] ?>"><?php echo $query['judul'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label " >Kasir</label>
														<div class="col-md-10">
															<select name="alamat" class="form-control">
																<option value="">--Pilih Kasir--</option>
																<?php $ambil = show("kasir where status='1' order by nama asc"); while($query = fetch($ambil)) { ?>
																<option value="<?php echo $query['id_kasir'] ?>" <?php if($query['id_kasir'] != "") {echo "selected";} ?>><?php echo $query['nama'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Jumlah</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="telepon" maxlength="13">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label" >Total</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nama">
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
								$id_distributor = "JAL".date("ymdis");
								update("buku","stok = stok - '$telepon' where id_buku = '$buku'") or die (mysql_error());
								insert("penjualan","'$id_distributor','$buku','$alamat','$telepon','$nama',now()") or die (mysql_error());
								redirect(".?page=".encrypt("penjualan")."");
							}
							if(isset($_POST['perbarui'])){
								extract($_POST);
								$tanggal = date("ymd");
								update("penjualan","id_buku = '$buku',id_kasir = '$alamat', jumlah = '$telepon', total = '$nama', tanggal = '$tanggal' where id_penjualan = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("penjualan")."");
							}
							if(@$_GET['action'] == "hapus" AND @$_GET['id']){
								delete("penjualan where id_penjualan = '$_GET[id]'") or die (mysql_error());
								redirect(".?page=".encrypt("penjualan")."");
							}
						?>
						