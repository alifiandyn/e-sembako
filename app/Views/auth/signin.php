<?= $this->extend('auth/templete_login'); ?>

<?= $this->section('content'); ?>
<div class="login-box">
  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-danger" role="alert">
      <?= session()->getFlashdata('message');  ?>
    </div>
  <?php endif; ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b>E</b>-Sembako</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="<?= base_url('Auth/SigninProcess') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" placeholder="Email" name="email" value="<?= old('email'); ?>" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <div class="valid-feedback d-block">
            <?= $validation->getError('email'); ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="valid-feedback d-block">
            <?= $validation->getError('password'); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary disabled">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger disabled">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?= base_url('Auth/ForgotPassword'); ?>">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('Auth/SignUp'); ?>" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection(); ?>