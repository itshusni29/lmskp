<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Training Modules</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Module</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-light">
            <div class="card-body">

                <!-- Row 1: Module Image -->
                <div class="row mb-4">
                    <div class="col-12">
                        <?php if($trainingModule->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $trainingModule->image_path)); ?>" alt="Module Banner" class="img-fluid w-100 rounded mb-3">
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">No banner image uploaded.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Row 2: Module Title -->
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h2 class="font-weight-bold"><?php echo e($trainingModule->title); ?></h2>
                    </div>
                </div>

                <!-- Row 3: Training Class, Creator, Created At, Updated At -->
                <div class="row mb-4">
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
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="module-content">
                            <!-- Display the content as HTML -->
                            <?php echo $trainingModule->content; ?>

                        </div>
                    </div>
                </div>

                <!-- Row 5: Back Button -->
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="<?php echo e(route('trainingModules.index')); ?>" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">Back to Modules</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* TinyMCE-like styling for content */
    .module-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Optional: Style the content to ensure images inside content are responsive */
    .module-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 20px 0;
    }

    /* Font styling inside the content */
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

    .module-content blockquote {
        background-color: #f9f9f9;
        border-left: 4px solid #dcdcdc;
        padding: 10px 20px;
        font-style: italic;
        margin: 20px 0;
    }

    /* Breadcrumb styling */
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        font-size: 1rem;
    }

    /* Styling the back button */
    .btn-primary {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-primary:hover {
        background-color: #005cbf;
        border-color: #0056b3;
    }

    /* Ensure there’s enough space on the bottom */
    .card-body {
        padding-bottom: 2rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/Module/show.blade.php ENDPATH**/ ?>