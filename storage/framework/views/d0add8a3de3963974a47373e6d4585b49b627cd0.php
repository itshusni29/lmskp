<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Stages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Stage Details</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Training Stage Details</h6>

        <p><strong>Stage Name:</strong> <?php echo e($trainingStage->name); ?></p>
        <p><strong>Description:</strong> <?php echo e($trainingStage->description); ?></p>

        <!-- Display Banner Image -->
        <?php if($trainingStage->banner_image): ?>
          <div class="mt-3">
            <strong>Banner Image:</strong><br>
            <img src="<?php echo e(asset('storage/' . $trainingStage->banner_image)); ?>" alt="Banner Image" style="max-width: 100%; height: auto;">
          </div>
        <?php else: ?>
          <p>No banner image available.</p>
        <?php endif; ?>

        <a href="<?php echo e(route('training_stages.index')); ?>" class="btn btn-secondary">Back to List</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/training_stages/show.blade.php ENDPATH**/ ?>