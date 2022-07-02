<div class="bg-white p-3 shadow-sm mx-3">
	<?= $this->session->flashdata('message'); ?>
	<div class="d-block">
		<h5 class="d-inline">Form</h5>
	</div>
	<br>
	<!-- <div class="table-responsive mt-3"> -->
	<form action="<?= base_url() ?>setting/insertdata" method="post" enctype="multipart/form-data">
		<div class="mb-3 row">
			<label class="col-sm-2 col-form-label">App Name</label>
			<div class="col-sm-10">
				<input type="text" name="app_name" class="form-control" required>
			</div>
		</div>
		<div class="mb-3 row">
			<label class="col-sm-2 col-form-label">Logo</label>
			<div class="col-sm-10">
				<input type="file" name="fotopost" class="form-control" required>
			</div>
		</div>
		<!-- <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Favicon</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="formfile">
    </div>
  </div> -->
		<input type="reset" name="reset" class="btn btn-secondary"></input>
		<input type="submit" name="submit" class="btn btn-primary"></input>

</div>