<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Student Dashboard'); ?></title>

    <!-- Plugin Styles -->
    <link href="<?php echo e(asset('assets/fonts/feather-font/css/iconfont.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('plugin-styles'); ?>

    <!-- Common CSS -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body data-base-url="<?php echo e(url('/')); ?>">
    <div class="main-wrapper" id="app">
        <?php echo $__env->make('layout.student_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-wrapper">
            <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <!-- Base Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('plugin-scripts'); ?>

    <!-- Common Scripts -->
    <script src="<?php echo e(asset('assets/js/template.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('custom-scripts'); ?>
</body>
</html>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/student_master.blade.php ENDPATH**/ ?>