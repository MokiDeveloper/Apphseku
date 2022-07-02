<div class="bg-white p-3 shadow-sm mx-3">
	<div class="d-block">
		<h5 class="d-inline">Tabel User</h5>
		<div class="float-right">
			<a href="#" class="btn btn-primary btnTambah btn-sm ">
				<span class="text-white">
					<i class="fas fa-fw fa-plus"></i> 
					Tambah Data
				</span>
			</a>
		</div>
	</div>
	<div class="table-responsive mt-3">
		<table class="table table-striped table-bordered table-hover" id="table-active" data-link="<?= base_url('user/ajax'); ?>">
			<thead class="bg-primary text-white">
				<tr>
					<th class="text-center" width="10">No.</th>
					<th>Username</th>
					<!-- <th>Departemen</th> -->
					<th>Role</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="form-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<input type="hidden" name="id_user" id="id_user">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" required="required" name="username" id="username" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" required="required" name="password" id="password" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="confpassword">Konfirmasi Password</label>
						<input type="password" class="form-control" required="required" name="confpassword" id="confpassword" placeholder="Konfirmasi Password">
					</div>

					<div class="form-group">
						<label for="id_role">Role</label>
						<select class="form-control" required="required" name="id_role" id="id_role">
							<option value="">-- Pilih --</option>
							<?php foreach ($role as $rule): ?>
								<option value="<?= $rule->id_role; ?>"><?= $rule->nama_role; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
					<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-paper-plane fa-fw"></i> <span class="text-submit"></span></button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		datatable();
		tambah();
		submit();
		ubah();

		function tambah() {
			$('.btnTambah').on('click',function(e) {
				e.preventDefault();
				$('#form-modal').modal('show');
				$('#form-modal .modal-title').html('Tambah Data');
				$('#form-modal form').attr('action',url+'user/tambah');
				$('#form-modal .text-submit').html('Tambah Data');

				$('#username').val('');
				$('#password').val('');
				$('#confpassword').val('');
				$('#id_role').val('');
				$('#id_departemen').val('');
				$('#id_user').val('');
				$('#username').parent().removeClass('d-none');
				$('#password').parent().removeClass('d-none');
				$('#confpassword').parent().removeClass('d-none');
			});
		}

		function ubah() {
			$('#table-active').on('click','.btnUbah',function(e) {
				e.preventDefault();
				$('#form-modal').modal('show');

				$('#form-modal .modal-title').html('Ubah Data');
				$('#form-modal form').attr('action',url+'user/ubah');
				$('#form-modal .text-submit').html('Ubah Data');

				let id_user 	= $(this).attr('href');
				$.ajax({
					url 		: url + 'user/getById',
					data 		: {
						id_user : id_user
					},
					dataType 	: 'json',
					method		: 'post',
					success		: function(response) {
						$('#username').parent().addClass('d-none');
						$('#password').parent().addClass('d-none');
						$('#confpassword').parent().addClass('d-none');

						$('#username').val(response.username);
						$('#id_user').val(response.id_user);
						$('#password').val('test');
						$('#confpassword').val('test');
						$('#id_role').val(response.id_role).select();
						$('#id_departemen').val(response.id_departemen).select();
					}
				})
			});
		}

		function submit() {
			$('#form-modal button[type=submit]').on('click',function(e) {
				let pass 	= $('#password').val();
				let pass2 	= $('#confpassword').val();

				if (pass != pass2) {
					e.preventDefault();
					let title 	= 'Gagal!';
					let text 	= 'Konfirmasi Password Salah';
					let type 	= 'error';
					showSweetalert(title,text,type);
				}else{
					$('#form-modal form').submit();
				}
			})
		}
	})
</script>