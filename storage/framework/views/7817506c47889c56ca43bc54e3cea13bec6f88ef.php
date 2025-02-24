<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Tests</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('student.post_tests.index')); ?>">Post Test List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Test Result</li>
  </ol>
</nav>

<div class="row justify-content-center">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">

        <!-- Status Alert -->
        <div class="alert <?php echo e($statusClass); ?>" role="alert">
          You have <?php echo e($status); ?> the test!
        </div>

        <!-- Test Result Details -->
        <div class="mt-4">
          <div class="row mb-3">
            <div class="col-6 col-md-4">
              <p><strong>Post Test</strong></p>
            </div>
            <div class="col-6 col-md-1">
              <p><strong>:</strong></p>
            </div>
            <div class="col-12 col-md-7">
              <p><?php echo e($postTest->name); ?></p>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-6 col-md-4">
              <p><strong>Correct Answers</strong></p>
            </div>
            <div class="col-6 col-md-1">
              <p><strong>:</strong></p>
            </div>
            <div class="col-12 col-md-7">
              <p><?php echo e($latestResult->score); ?> / <?php echo e($totalQuestions); ?></p>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-6 col-md-4">
              <p><strong>Score</strong></p>
            </div>
            <div class="col-6 col-md-1">
              <p><strong>:</strong></p>
            </div>
            <div class="col-12 col-md-7">
              <p><?php echo e(round($percentage, 2)); ?>%</p>
            </div>
          </div>
        </div>

        <!-- Result Attempts -->
        <div class="mt-4">
          <h5 class="mb-3">Previous Attempts:</h5>
          <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert 
                <?php echo e(($result->score / $totalQuestions) >= 0.7 ? 'alert-success' : 'alert-danger'); ?>" role="alert">
              <strong><?php echo e(ucfirst($result->type)); ?>:</strong> 
              Score: <?php echo e($result->score); ?> / <?php echo e($totalQuestions); ?> 
              (<?php echo e(round(($result->score / $totalQuestions) * 100, 2)); ?>%)
              - 
              <?php if($result->score / $totalQuestions >= 0.7): ?>
                Passed
              <?php else: ?>
                Failed
              <?php endif; ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>


        <!-- Back Button -->
        <div class="mt-4 text-center">
          <a href="<?php echo e(route('student.post_tests.index')); ?>" class="btn btn-primary">Back to Post Test List</a>
        </div>
        
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/postTest/result.blade.php ENDPATH**/ ?>