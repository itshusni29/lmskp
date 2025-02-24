<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Tests</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post Test List</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Post Test List</h6>
        <p class="text-muted mb-3">Manage post tests in your system below:</p>

        <!-- Table for displaying post tests -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Post Test Name</th>
                <th>Training Stage</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Result</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $postTests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $postTest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($postTest->name); ?></td>
                <td><?php echo e($postTest->trainingStage->name ?? 'N/A'); ?></td>
                <td><?php echo e($postTest->description); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($postTest->start_time)->format('Y-m-d H:i')); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($postTest->end_time)->format('Y-m-d H:i')); ?></td>
                <td>
                    <?php echo e($postTest->resultLabel); ?> <!-- Format result with label and percentage -->
                </td>
                <td>
                <?php if($postTest->isValidTime): ?>
                    <a href="<?php echo e(route('student.post_tests.take', $postTest->id)); ?>" class="btn btn-info btn-sm take-btn">
                        Take
                    </a>
                <?php else: ?>
                    <button class="btn btn-info btn-sm" disabled>Take</button>
                <?php endif; ?>
                    <a href="<?php echo e(route('student.post_tests.result', $postTest->id)); ?>" class="btn btn-info btn-sm">Result</a>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/sweet-alert.js')); ?>"></script>

  <script>
    $(document).ready(function() {
      $('#dataTableExample').DataTable();
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/postTest/index.blade.php ENDPATH**/ ?>