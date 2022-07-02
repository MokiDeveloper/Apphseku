<div>
	< <nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!-- Notifications Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<!-- <?= $username; ?> -->
					<?= $this->session->userdata('username'); ?>
					<i class=" ml-2 far fa-user"></i>
					<!-- <span class="badge badge-warning navbar-badge">15</span> -->
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

					<a href="<?= base_url('admin/profile'); ?>" class="dropdown-item p-3">
						<i class="fas fa-user mr-2"></i> Profile
					</a>

					<div class="dropdown-divider"></div>

					<a href="<?= base_url('admin/logout'); ?>" class="dropdown-item p-3">
						<i class="fas fa-sign-out-alt mr-2"></i> Logout
					</a>

					<div class="dropdown-divider"></div>

				</div>
			</li>
		</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?= base_url('') ?>" class="brand-link">
				<img src="<?= base_url('assets/picture/') . $datadep['gambar']; ?>" alt="AdminLTE Logo" class="brand-image
				 img-circle elevation-3" style="opacity: .8">

				<span class="brand-text font-weight-light">Fit to Work</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href="<?= base_url('admin') ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>


						<!-- <li class="nav-item menu-folder">
					<a href="<?= base_url('admin/self_assesment') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																							echo 'active';
																						} ?>">
						<i class="nav-icon fas fa-notes-medical"></i>
						<p>Self Assessment</p>
					</a>
				</li> -->

						<li class="nav-item menu-folder">
							<a href="<?= base_url('admin/to_work') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																							echo 'active';
																						} ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>Fit To Work</p>
							</a>
						</li>
						<li class="nav-item menu-folder">
							<a href="<?= base_url('exportdata/laporan') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																								echo 'active';
																							} ?>">
								<i class="fas fa-chart-bar nav-icon"></i>
								<p>Laporan</p>
							</a>
						<li class="nav-item menu-folder">
							<a href="<?= base_url('user/index') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																						echo 'active';
																					} ?>">
								<i class="nav-icon fas fa-user"></i>
								<p>User</p>
							</a>
						</li>
						<li class="nav-item menu-folder">
							<a href="<?= base_url('admin/history') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																							echo 'active';
																						} ?>">
								<i class="nav-icon fas fa-user"></i>
								<p>LogHistory</p>
							</a>
						</li>
						<li class="nav-item menu-folder">
							<a href="<?= base_url('setting/setting') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																								echo 'active';
																							} ?>">
								<i class="nav-icon fas fa-cogs"></i>
								<p>Setting</p>
							</a>
						</li>

						<li class="nav-item menu-folder">
							<a href="<?= base_url('admin/logout') ?>" class="nav-link <?php if ($this->uri->segment(2) == 'kesehatan') {
																							echo 'active';
																						} ?>">
								<i class="nav-icon fas fa-sign-out-alt"></i>
								<p>Logout</p>
							</a>
						</li>

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h3 class="m-0 text-dark ml-3"><?= $title ?></h3>
						</div><!-- /.col -->

					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->