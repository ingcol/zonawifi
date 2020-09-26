<?php $__env->startSection('content'); ?>
<div style="height: 70px; box-shadow: 0 0 12px #ccc" class="bg-white p-4">
<h6><i class="fa fa-wifi"></i> Zonas wifi Kalu</h6>

</div>
<div class="wrapper" >
  <form method="POST" action="<?php echo e(route('login')); ?>" class="form-signin pb-4">
    <?php echo csrf_field(); ?>
    <h4 class="form-signin-heading text-center mt-4">Acceder al sistema </h4>
    <input id="login" type="text" class="form-control mb-4" placeholder="Usuario / Email" name="login" value="<?php echo e(old('login')); ?>" required>
    <?php if($errors->has('login')): ?>
    <span class="help-block">
      <strong><?php echo e($errors->first('login')); ?></strong>
  </span>
  <?php endif; ?>
  <input id="password" type="password" class="form-control mb-4 <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password" placeholder="Contraseña">
  <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
<button type="submit" class="btn form-control form-bg-success btn-lg  mb-4 "> <i class="ik ik-arrow-up-circle"></i> Ingresar</button>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\wifi\resources\views\auth\login.blade.php ENDPATH**/ ?>