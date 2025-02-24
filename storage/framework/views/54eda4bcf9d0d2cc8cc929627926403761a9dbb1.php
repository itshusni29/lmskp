<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Training Modules</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Module</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-10 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">

                <!-- Row 1: Module Image -->
                <div class="row">
                    <div class="col-12">
                        <?php if($trainingModule->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $trainingModule->image_path)); ?>" alt="Module Banner" class="img-fluid w-100 rounded">
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">No banner image uploaded.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Row 2: Module Title -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <h2><?php echo e($trainingModule->title); ?></h2>
                    </div>
                </div>

                <!-- Row 3: Training Class, Creator, Created At, Updated At -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <h5><strong>Training Class:</strong> <?php echo e($trainingModule->trainingClass->name); ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><strong>Creator:</strong> <?php echo e($trainingModule->creator->name); ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><strong>Created At:</strong> <?php echo e($trainingModule->created_at->format('d M Y, H:i')); ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><strong>Updated At:</strong> <?php echo e($trainingModule->updated_at->format('d M Y, H:i')); ?></h5>
                    </div>
                </div>

                <!-- Row 4: Content -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="module-content">
                            <!-- Display the content as HTML -->
                            <?php echo $trainingModule->content; ?>

                        </div>
                    </div>
                </div>

                <!-- Row 5: Back Button -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <a href="<?php echo e(route('trainingModules.index')); ?>" class="btn btn-secondary btn-lg">Back to Modules</a>
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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/Module/show.blade.php ENDPATH**/ ?>