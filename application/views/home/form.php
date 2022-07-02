<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="Fit to Work" />
	<meta name="description" content="Fit to Work" />
	<title>Aplikasi Fit to Work</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<!-- Font Awesome -->
	<link rel="icon" href="<?php echo base_url('assets'); ?>/adminlogin/images/logo.png">
	<!-- Bootstrap core CSS -->
	<link href="https://covid19.bangka.go.id/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="https://covid19.bangka.go.id/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="https://covid19.bangka.go.id/assets/bower_components/select2/dist/css/select2.min.css">

</head>
<style type="text/css">
	.responsived {
		max-width: 100%;
		border-radius: 10px;
		height: auto;
	}
</style>

<body class="bg-light">

	<div class="container">

		<div class="row">
			<div class="col-md-1 order-md-1">
			</div>
			<div class="col-md-1 order-md-3">
			</div>

			<div class="col-md-10 order-md-2">
				<br>
				<div class="">
					<img src="<?php echo base_url(); ?>assets/img/hader.jpg" class="responsived" width="950"></a></center>
					<!-- <img src="<?php echo base_url(); ?>assets/img/header.jpg" class="responsived" width="600" height="950"></a></center> -->
					<br>

				</div>
				<div class="card">
					<div class="card-body">


						<form action="<?= base_url('homeview/insertdata') ?>" method="POST">

							<h5>Data Diri</h5>
							<hr class="mb-4">
							<div class="form-group">
								<p>Nama Lengkap <span class="text-danger">*</span></p>
								<input type="text" class="form-control" required name="name" placeholder="Nama Lengkap">
							</div>
							<div class="form-group">
								<p>NRP <span class="text-danger">*</span></p>
								<input type="text" class="form-control" required name="nrp_pegawai" placeholder="NRP">
							</div>
							<div class="form-group">
								<p>Jabatan <span class="text-danger">*</span></p>

								<input type="text" class="form-control" required name="jabatan" placeholder="Jabatan">
							</div>


							<br>
							<!-- ==== Fit To Work ====-->
							<h6><b>Fit To Work</b></h6>
							<hr class="mb-4">
							<div class="form-group">
								<p>Berapa jam anda tidur hari ini (24 jam terakhir)?</p>
								<select class="form-control" required name="tidur_24_jam">
									<option value="">Pilih</option>
									<option value=" < 2 ">
										<=2 Jam</option>
									<option value="3">3 Jam</option>
									<option value="4">4 Jam</option>
									<option value="> 5">>= 5 Jam</option>
								</select>
							</div>
							<div class="form-group">
								<p>Berapa jam anda tidur kemarin (48 jam terakhir)?</p>
								<select class="form-control" required name="tidur_48_jam">
									<option value="">Pilih</option>
									<option value="< 8">
										<= 8 Jam</option>
									<option value="9">9 Jam</option>
									<option value="10">10 Jam</option>
									<option value="11">11 Jam</option>
									<option value="> 12">>= 12 Jam</option>
								</select>
							</div>
							<div class="form-group">
								<p>Berapa jam anda terjaga setelah bangun tidur terakhir hari ini?</p>
								<input type="text" class="form-control" required name="terjaga" placeholder="Jawaban">
							</div>
							<div class="form-group">
								<p>Apakah Anda Mengkonsumsi Obat Penyebab Ngantuk?</p>
								<select class="form-control" required name="konsumsi_obat">
									<option value="">Pilih</option>
									<option value="Ya">Ya</option>
									<option value="Tidak">Tidak</option>
								</select>
							</div>
							<div class="form-group">
								<p>Apakah Anda Memiliki Masalah Pribadi?</p>
								<select class="form-control" required name="masalah_pribadi">
									<option value="">Pilih</option>
									<option value="Ya">Ya</option>
									<option value="TIdak">Tidak</option>
								</select>
							</div>
							<!--=== End Fit To Work ====-->
							<div class="row" style="padding-top: 50px;">
								<div class="col-md-6 mb-2">
									<button class="btn btn-primary btn-lg btn-block" type="submit">Kirim</button>
								</div>
								<div class="col-md-6 mb-2">
									<a class="btn btn-danger btn-lg btn-block" href="<?php echo base_url('home'); ?>">Atur Ulang</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<footer class="my-2 pt-2 text-muted text-center text-small">
			<div class="container">

				<div class="row">
					<div class="col-md-1 order-md-1">
					</div>
					<div class="col-md-1 order-md-3">
					</div>
					<div class="col-md-10 order-md-2">
						<!-- <div class="jumbotron p-2 p-md-3 text-white rounded bg-info text-center"> -->
						<p class="mb-0">&copy; <?= date('Y'); ?></p>Design By System Information
						<!-- </div> -->
		</footer>
	</div>

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://covid19.bangka.go.id/assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- bootstrap datepicker -->
	<script src="https://covid19.bangka.go.id/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
	</script>
	<!-- Select2 -->
	<script src="https://covid19.bangka.go.id/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

	<?php if ($this->session->flashdata('success')) { ?>
		<script>
			Swal.fire({
				type: 'success',
				title: 'Berhasil !!',
				text: '<?= $this->session->userdata('success'); ?>',
			})
		</script>
	<?php } ?>
	<?php if ($this->session->flashdata('error')) { ?>
		<script>
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: '<?= $this->session->userdata('error'); ?>',
			})
		</script>
	<?php } ?>
	<script>
		$(function() {
			//Date picker
			var FromEndDate = new Date();
			$('#datepicker').datepicker({
					format: 'yyyy-mm-dd',
					endDate: FromEndDate,
					autoclose: true
				}),

				$('#datepicker2').datepicker({
					format: 'yyyy-mm-dd',
					endDate: FromEndDate,
					autoclose: true
				}),
				$('#datepicker3').datepicker({
					format: 'yyyy-mm-dd',
					endDate: FromEndDate,
					autoclose: true
				})

		})
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#negara").select2({
				placeholder: '-Pilih Kabupaten/Kota-',
				minimumInputLength: 3,
				allowClear: true,
				ajax: {
					url: "",
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function(params) {
						return {
							_token: $('meta[name="csrf-token"]').attr('content'),
							searchTerm: params.term
						};
					},
					processResults: function(response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});

			$("#kota").select2({
				placeholder: '-Pilih Kabupaten/Kota-',
				minimumInputLength: 3,
				allowClear: true,
				ajax: {
					url: "",
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function(params) {
						return {
							_token: $('meta[name="csrf-token"]').attr('content'),
							searchTerm: params.term
						};
					},
					processResults: function(response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
		});
	</script>

</body>

</html>