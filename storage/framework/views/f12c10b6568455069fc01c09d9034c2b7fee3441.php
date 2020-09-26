<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Turnotec</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/iconkit.min.css')); ?>" rel="stylesheet">
    
    <link href="<?php echo e(asset('css/toastr.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/toast.min.css')); ?>" rel="stylesheet">
    
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/virtual-key.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    

</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH C:\laragon\www\wifi\resources\views\layouts\app_screen.blade.php ENDPATH**/ ?>