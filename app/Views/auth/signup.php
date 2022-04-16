<?= $this->extend('auth/templete_login'); ?>

<?= $this->section('content'); ?>
<div class="register-box">
  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-danger" role="alert">
      <?= session()->getFlashdata('message');  ?>
    </div>
  <?php endif; ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b>E</b>-Sembako</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
      <form action="<?= base_url('Auth/SignupProcess') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" placeholder="Full name" name="username" value="<?= old('username'); ?>" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="valid-feedback d-block">
            <?= $validation->getError('username'); ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" placeholder="Email" name="email" value="<?= old('email'); ?>">
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
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('passwordValidation') ? 'is-invalid' : ''; ?>" placeholder="Retype password" name="passwordValidation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="valid-feedback d-block">
            <?= $validation->getError('passwordValidation'); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary disabled">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger disabled">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="<?= base_url('Auth/SignIn'); ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?= $this->endSection(); ?>