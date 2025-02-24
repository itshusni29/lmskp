<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Post Tests</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('student.post_tests.index')); ?>">Post Test List</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($postTest->name); ?> Results</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Post Test Results for <?php echo e($postTest->name); ?></h6>

                    <!-- Table for displaying all user results -->
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Corect</th>
                            <th>Score</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($result->user->username); ?></td>
                                    <td><?php echo e($result->user->name); ?></td>
                                    <td><?php echo e($result->user->section); ?></td>
                                    <td><?php echo e($result->score); ?> / <?php echo e($totalQuestions); ?></td>
                                    <td><?php echo e(number_format($result->percentage, 2)); ?></td>
                                    <td>
                                        <?php if($result->isPassed): ?>
                                          <span class="badge bg-success">Passed</span>
                                        <?php else: ?>
                                          <span class="badge bg-danger">Failed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>

                    <a href="<?php echo e(route('student.post_tests.index')); ?>" class="btn btn-primary">Back to Post Test List</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/sweet-alert.js')); ?>"></script>

  <script>
    // Initialize DataTable
    $(document).ready(function() {
      $('#dataTableExample').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search
        "ordering": true, // Enable sorting
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/postTest/show.blade.php ENDPATH**/ ?>