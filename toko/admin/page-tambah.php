						<script type="text/javascript">
							$("#edit").click(function(){
								$("#editform").fadeIn(1000);
							});
						</script>
						<div class="row">
							<div class="col-sm-12">
								<?php include_once "distributor.php"; ?>
							</div><!-- end col -->
						</div>



						<div class="row id="tambah">
							<div class="col-sm-6">
								<div class="card-box">

									<h4 class="header-title m-t-0 m-b-30">Tambah Distributor</h4>

									<form method="post">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-horizontal" role="form">
													<div class="form-group">
														<label class="col-md-2 control-label">Nama</label>
														<div class="col-md-10">
															<input type="text" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Alamat</label>
														<div class="col-md-10">
															<input type="text" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Telepon</label>
														<div class="col-md-10">
															<input type="text" class="form-control">
														</div>
													</div>
													<button type="button" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right">Simpan</button>
												</div>
											</div><!-- end col -->
										</div><!-- end row -->
									</form>
								</div>
							</div><!-- end col -->
						</div>
						<div class="row id="editform" hidden="hidden">
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
															<input type="text" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Alamat</label>
														<div class="col-md-10">
															<input type="text" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Telepon</label>
														<div class="col-md-10">
															<input type="text" class="form-control">
														</div>
													</div>
													<button type="button" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5 pull-right">Simpan</button>
												</div>
											</div><!-- end col -->
										</div><!-- end row -->
									</form>
								</div>
							</div><!-- end col -->
						</div>