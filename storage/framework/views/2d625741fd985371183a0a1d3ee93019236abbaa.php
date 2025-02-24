<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
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

        <a href="<?php echo e(route('trainer.postTests.create')); ?>" class="btn btn-primary mb-3">Add New Post Test</a>

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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $postTests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $postTest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($postTest->name); ?></td>
                <td><?php echo e($postTest->trainingStage ? $postTest->trainingStage->name : 'N/A'); ?></td>
                <td><?php echo e($postTest->description); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($postTest->start_time)->format('Y-m-d H:i')); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($postTest->end_time)->format('Y-m-d H:i')); ?></td>
                <td>
                  <a href="<?php echo e(route('trainer.postTests.edit', $postTest->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                  <!-- Delete Button -->
                  <form action="<?php echo e(route('trainer.postTests.destroy', $postTest->id)); ?>" method="POST" class="d-inline" id="form-<?php echo e($postTest->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" data-post-test-id="<?php echo e($postTest->id); ?>" onclick="showSwal(this)">Delete</button>
                  </form>
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
  <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/sweet-alert.js')); ?>"></script>

  <script>
    // Initialize DataTable
    $(document).ready(function() {
      $('#dataTableExample').DataTable({
        paging: true, // Enable pagination
        searching: true, // Enable search
        ordering: true, // Enable sorting
      });
    });

    // SweetAlert delete confirmation
    function showSwal(button) {
      const postTestId = $(button).data('post-test-id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it',
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('form-' + postTestId).submit(); // Submit the form if confirmed
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/postTest/index.blade.php ENDPATH**/ ?>