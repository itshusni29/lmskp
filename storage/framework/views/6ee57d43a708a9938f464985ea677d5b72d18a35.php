<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Classes</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Training Classes</h6>
        <p class="text-muted mb-3">Manage training classes in your system below:</p>

        <a href="<?php echo e(route('trainer.trainingClasses.create')); ?>" class="btn btn-primary mb-3">Add New Training Class</a>

        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Stage</th>
                <th>Instructor</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $trainingClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trainingClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($trainingClass->name); ?></td>
                <td><?php echo e($trainingClass->trainingStage->name ?? 'N/A'); ?></td>
                <td><?php echo e($trainingClass->instructor->name ?? 'N/A'); ?></td>
                <td>
                  <?php if($trainingClass->banner_image): ?>
                    <img src="<?php echo e(asset('storage/'.$trainingClass->banner_image)); ?>" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
                  <?php else: ?>
                    N/A
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?php echo e(route('trainer.trainingClasses.show', $trainingClass->id)); ?>" class="btn btn-info btn-sm">View</a>
                  <a href="<?php echo e(route('trainer.trainingClasses.edit', $trainingClass->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                  <!-- Delete Form -->
                  <form action="<?php echo e(route('trainer.trainingClasses.destroy', $trainingClass->id)); ?>" method="POST" id="form-<?php echo e($trainingClass->id); ?>" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_training_class', '<?php echo e($trainingClass->id); ?>')">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="6" class="text-center">No training classes found.</td>
              </tr>
              <?php endif; ?>
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
  function showSwal(action, id) {
    if (action === 'delete_training_class') {
      Swal.fire({
        title: 'Confirmation',
        text: 'Are you sure you want to delete this training class?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('form-' + id).submit();
        }
      });
    }
  }

  $(document).ready(function () {
    $('#dataTableExample').DataTable();
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/TrainingClass/index.blade.php ENDPATH**/ ?>