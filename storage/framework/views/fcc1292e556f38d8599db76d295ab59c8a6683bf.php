<?php $__env->startPush('plugin-styles'); ?>
    <link href="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Training Classes'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Training Classes for <?php echo e($trainingStage->name); ?></h4>
        </div>
    </div>

    <div class="row">
    <?php if($trainingClasses && $trainingClasses->isNotEmpty()): ?>
        <?php $__currentLoopData = $trainingClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainingClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-4 col-xl-3 mb-4">
                <div class="card">
                    <img src="<?php echo e($trainingClass->banner_image ? asset('storage/' . $trainingClass->banner_image) : asset('default-image.jpg')); ?>" 
                         class="card-img-top" 
                         alt="<?php echo e($trainingClass->name ?: 'Training Class Image'); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($trainingClass->name); ?></h5>
                        <p class="card-text" style="min-height: 60px; overflow: hidden;"> 
                            <?php echo e(Str::limit($trainingClass->description, 150, '...')); ?>

                        </p>
                        <a href="<?php echo e(route('student.trainingClasses.show', $trainingClass->id)); ?>" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>No training classes available for this stage.</p>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/trainingStage/show.blade.php ENDPATH**/ ?>