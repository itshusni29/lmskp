<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Tests</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show Post Test</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Post Test Details</h6>
        <p class="text-muted mb-3">Here are the details of the selected post test.</p>

        <div class="row">
          <div class="col-md-6">
            <strong>Module ID:</strong> <?php echo e($postTest->module_id); ?>

          </div>
          <div class="col-md-6">
            <strong>Title:</strong> <?php echo e($postTest->title); ?>

          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <strong>Description:</strong> <p><?php echo e($postTest->description); ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <strong>Start Time:</strong> <?php echo e($postTest->start_time ? \Carbon\Carbon::parse($postTest->start_time)->format('d-m-Y H:i') : 'Not set'); ?>

          </div>
          <div class="col-md-6">
            <strong>End Time:</strong> <?php echo e($postTest->end_time ? \Carbon\Carbon::parse($postTest->end_time)->format('d-m-Y H:i') : 'Not set'); ?>

          </div>
        </div>

        <a href="<?php echo e(route('postTest.index')); ?>" class="btn btn-secondary mt-3">Back to Post Test List</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/postTest/show.blade.php ENDPATH**/ ?>