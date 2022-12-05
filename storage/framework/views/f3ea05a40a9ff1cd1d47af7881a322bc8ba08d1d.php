<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Dastkar</title>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

    <link href="<?php echo e(asset('assets/vendor/css/adminltev3.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/vendor/css/icheck-bootstrap.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.css')); ?>" rel="stylesheet" />

    <style>
        .form-control,
        .btn,
        a {
            outline: none !important;
            box-shadow: none !important;
        }

        #cover {
            background: url("<?php echo e(asset('frontend/images/loading.gif')); ?>") no-repeat scroll center center #FFF;
            position: absolute;
            height: 100%;
            width: 100%;
        }

    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    <div id="cover"></div>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
    <script>
        $(window).on('load', function(){
                $('#cover').fadeOut(1000);
        });
    </script>
</body>

</html>
<?php /**PATH E:\laragon\www\adaajaipur\resources\views/layouts/app.blade.php ENDPATH**/ ?>