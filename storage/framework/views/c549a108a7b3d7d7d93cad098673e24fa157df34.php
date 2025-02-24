<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('trainingClasses.index')); ?>">Training Classes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e($trainingClass->name); ?></li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <!-- Banner Image -->
                <div class="row mt-3">
                    <div class="col-12">
                        <?php if($trainingClass->banner_image): ?>
                            <img src="<?php echo e(asset('storage/' . $trainingClass->banner_image)); ?>" alt="Class Banner" class="img-fluid w-100 rounded">
                        <?php else: ?>
                            <div class="alert alert-warning">No banner image uploaded.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Class Name and Description -->
                <h2 class="text-center"><?php echo e($trainingClass->name); ?></h2>
                <p class="text-muted text-center"><?php echo e($trainingClass->description); ?></p>

                <!-- Instructor and Training Stage -->
                <div class="row mt-3">
                    <div class="col-md-6 mx-auto d-flex justify-content-center gap-4">
                        <h5><strong>Instructor:</strong> <?php echo e(optional($trainingClass->instructor)->name ?? 'N/A'); ?></h5>
                        <h5><strong>Training Stage:</strong> <?php echo e(optional($trainingClass->trainingStage)->name ?? 'N/A'); ?></h5>
                    </div>
                </div>

                <!-- Training Modules List -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h4>Training Modules</h4>
                        <div class="accordion" id="accordionExample">
                            <?php $__currentLoopData = $trainingModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trainingModule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?php echo e($index); ?>">
                                        <button class="accordion-button <?php echo e($index === 0 ? '' : 'collapsed'); ?>" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapse<?php echo e($index); ?>" 
                                                aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>" 
                                                aria-controls="collapse<?php echo e($index); ?>">
                                            <?php echo e($trainingModule->title); ?>

                                        </button>
                                    </h2>
                                    <div id="collapse<?php echo e($index); ?>" 
                                         class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" 
                                         aria-labelledby="heading<?php echo e($index); ?>" 
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <!-- Module Image -->
                                            <?php if($trainingModule->image_path): ?>
                                                <img src="<?php echo e(asset('storage/' . $trainingModule->image_path)); ?>" 
                                                     alt="Module Image" 
                                                     class="img-fluid w-100 rounded mb-3">
                                            <?php endif; ?>

                                            <!-- Module Details -->
                                            <h5><strong>Training Class:</strong> <?php echo e($trainingModule->trainingClass->name ?? 'N/A'); ?></h5>
                                            <h5><strong>Creator:</strong> <?php echo e($trainingModule->creator->name ?? 'N/A'); ?></h5>
                                            <h5><strong>Created At:</strong> <?php echo e($trainingModule->created_at->format('d M Y, H:i')); ?></h5>
                                            <h5><strong>Updated At:</strong> <?php echo e($trainingModule->updated_at->format('d M Y, H:i')); ?></h5>

                                            <!-- Module Content -->
                                            <div class="module-content mt-3">
                                                <?php echo $trainingModule->content; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <!-- Back to Training Classes Button -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <a href="<?php echo e(route('trainingClasses.index')); ?>" class="btn btn-secondary btn-lg">Back to Classes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Optional: Style the content to ensure images inside content are responsive */
    .module-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 20px 0;
    }

    .module-content p {
        font-size: 1.1em;
        line-height: 1.6;
    }

    .module-content h2, 
    .module-content h3, 
    .module-content h4 {
        font-weight: bold;
        margin-top: 20px;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/TrainingClass/show.blade.php ENDPATH**/ ?>