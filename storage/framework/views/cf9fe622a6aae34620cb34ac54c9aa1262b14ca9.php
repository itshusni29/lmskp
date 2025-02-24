<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Stages</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Stages</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Training Stages</h6>

        <a href="<?php echo e(route('training_stages.create')); ?>" class="btn btn-primary mb-3">Add New Stage</a>
        <p class="text-muted mb-3">Manage training stages in your system below:</p>

        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>No</th> <!-- Row number -->
                <th>Stage Name</th>
                <th>Description</th>
                <th>Banner Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trainingStage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td> <!-- Display row number -->
                <td><?php echo e($trainingStage->name); ?></td>
                <td><?php echo e($trainingStage->description); ?></td>
                <td>
                  <?php if($trainingStage->banner_image): ?>
                    <img src="<?php echo e(asset('storage/' . $trainingStage->banner_image)); ?>" alt="Banner Image" style="max-width: 100px;">
                  <?php else: ?>
                    No Image
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?php echo e(route('training_stages.show', $trainingStage->id)); ?>" class="btn btn-info btn-sm">View</a>
                  <a href="<?php echo e(route('training_stages.edit', $trainingStage->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                  
                  <!-- Delete Form -->
                  <form action="<?php echo e(route('training_stages.destroy', $trainingStage->id)); ?>" method="POST" style="display:inline;" id="form-<?php echo e($trainingStage->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_training_stage', '<?php echo e($trainingStage->id); ?>')">Delete</button>
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
  <script>
    // Initialize DataTable
    $(document).ready(function() {
      $('#dataTableExample').DataTable();
    });

    // SweetAlert delete confirmation
    function showSwal(action, id) {
      let message = action === 'delete_training_stage' ? 'Are you sure you want to delete this training stage?' : '';
      let formId = '#form-' + id;

      Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          $(formId).submit(); // Submit the form if confirmed
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/training_stages/index.blade.php ENDPATH**/ ?>