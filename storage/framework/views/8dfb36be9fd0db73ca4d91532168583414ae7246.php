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

<div class="row">
    <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainingStage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-md-4 col-xl-3 mb-4">
            <div class="card h-100"> <!-- Menambahkan h-100 agar kartu memiliki tinggi yang sama -->
                <?php if($trainingStage->banner_image): ?>
                    <img src="<?php echo e(asset('storage/' . $trainingStage->banner_image)); ?>" class="card-img-top" alt="<?php echo e($trainingStage->name); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('default-image.jpg')); ?>" class="card-img-top" alt="<?php echo e($trainingStage->name); ?>">
                <?php endif; ?>
                <div class="card-body d-flex flex-column"> <!-- Menggunakan flex-column untuk memastikan tombol di bawah -->
                    <h5 class="card-title"><strong><?php echo e($trainingStage->name); ?></strong></h5>
                    <p class="card-text" style="min-height: 60px;"><?php echo e(Str::limit($trainingStage->description, 100)); ?></p>
                    <a href="<?php echo e(route('student.trainingStages.show', $trainingStage->id)); ?>" class="btn btn-primary mt-auto">Learn More</a> <!-- Tombol di bawah -->
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/apexcharts/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/dashboard.blade.php ENDPATH**/ ?>