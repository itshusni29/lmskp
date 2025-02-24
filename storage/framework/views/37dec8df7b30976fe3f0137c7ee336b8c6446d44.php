<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Training Classes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Class</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Training Class</h6>

                <form method="POST" action="<?php echo e(route('trainingClasses.update', $trainingClass->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $trainingClass->name)); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"><?php echo e(old('description', $trainingClass->description)); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="instructor_id">Instructor</label>
                        <select class="form-control" id="instructor_id" name="instructor_id" required>
                            <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($instructor->id); ?>" <?php echo e($instructor->id == old('instructor_id', $trainingClass->instructor_id) ? 'selected' : ''); ?>>
                                    <?php echo e($instructor->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="training_stage_id">Training Stage</label>
                        <select class="form-control" id="training_stage_id" name="training_stage_id" required>
                            <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($stage->id); ?>" <?php echo e($stage->id == old('training_stage_id', $trainingClass->training_stage_id) ? 'selected' : ''); ?>>
                                    <?php echo e($stage->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="banner_image">Class Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image">
                        <?php if($trainingClass->banner_image): ?>
                            <div class="mt-2">
                                <img src="<?php echo e(asset('storage/' . $trainingClass->banner_image)); ?>" alt="Class Image" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/TrainingClass/edit.blade.php ENDPATH**/ ?>