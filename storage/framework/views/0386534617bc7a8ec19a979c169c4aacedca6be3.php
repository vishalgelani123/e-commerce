
<?php $__env->startSection('content'); ?>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <div class="login-logo">
        </div>
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="margin-top:150px;">
        <form action="<?php echo e(route('login')); ?>" method="POST">
            
        <?php echo csrf_field(); ?>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input id="email" type="email"
                   class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" required
                   autocomplete="email" autofocus placeholder="<?php echo e(trans('global.login_email')); ?>" name="email"
                   value="<?php echo e(old('email', null)); ?>">

            <label class="form-label" for="form3Example3">Email address</label>
            <?php if($errors->has('email')): ?>
                <div class="invalid-feedback">
                    <?php echo e($errors->first('email')); ?>

                </div>
            <?php endif; ?>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input id="password" type="password"
                   class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password"
                   required placeholder="<?php echo e(trans('global.login_password')); ?>">
            <label class="form-label" for="form3Example4">Password</label>
                <?php if($errors->has('password')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errrs->first('password')); ?>

                    </div>
                <?php endif; ?>
            </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for=for="remember"><?php echo e(trans('global.remember_me')); ?></label>
            </div>

            <?php if(Route::has('password.request')): ?>
            <a href="<?php echo e(route('password.request')); ?>">
               <?php echo e(trans('global.forgot_password')); ?></a>
            <?php endif; ?>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;"><?php echo e(trans('global.login')); ?></button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\adaajaipur\resources\views/auth/login.blade.php ENDPATH**/ ?>