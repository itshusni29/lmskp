<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Class Details</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Training Class Details</h6>

        <div class="row">
          <div class="col-md-2">
              <strong>Name</strong>
          </div>
          <div class="col-md-10 text-left">
              <p>: <span> <?php echo e($trainingClass->name ?? 'N/A'); ?></span></p>
          </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <strong>Description</strong>
            </div>
            <div class="col-md-9 text-left">
                <p>: <span><?php echo e($trainingClass->description ?? 'No description available'); ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <strong>Instructor</strong>
            </div>
            <div class="col-md-9 text-left">
                <p>: <span> <?php echo e($trainingClass->instructor->name ?? 'Instructor not assigned'); ?></span></p>
            </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="module-content">
              <?php if(isset($trainingModule) && !empty($trainingModule->content)): ?>
                <?php echo $trainingModule->content; ?>

              <?php else: ?>
                <p>No module content available.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <a href="<?php echo e(route('trainer.trainingClasses.index')); ?>" class="btn btn-secondary">Back to List</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/TrainingClass/show.blade.php ENDPATH**/ ?>