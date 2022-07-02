<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Administrator</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlogin/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlogin/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlogin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlogin/css/style.css">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/adminlogin/images/logo.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">

            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">

              </div>
              <!-- <img src="<?php echo base_url('assets/picture/' . $get_setting->gambar); ?>"> -->
              <img src="<?= base_url() ?>assets/adminlogin/images/logo.png" width="90" height="60" /></img>
              <h4>Administrator Fit to Work</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <?= $this->session->flashdata('notif') ?>
              <form action="<?php echo base_url('admin/login'); ?>" method="post">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" required="" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" required="" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-primary btn-block">LOGIN <i class="fa fa-sign-in"></i></button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                  </div>
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <div class="mb-2">
                </div>
                <div class="text-center  mt-4 font-weight-light">&copy; <?= date('Y'); ?> <a href="#" class="text-primary">System Information</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url() ?>assets/adminlogin/vendors/js/vendor.bundle.base.js"></script>

  <script src="<?= base_url() ?>assets/adminlogin/js/off-canvas.js"></script>
  <script src="<?= base_url() ?>assets/adminlogin/js/misc.js"></script>
  <?php if ($this->session->flashdata('error')) { ?>
    <script>

    </script>
  <?php } ?>

  <!-- endinject -->
</body>

</html>