<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>
</div>


<?php $__env->stopSection(); ?> 

<?php $__env->startPush('plugin-scripts'); ?>
<script src="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/apexcharts/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
<script src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/dashboard.blade.php ENDPATH**/ ?>