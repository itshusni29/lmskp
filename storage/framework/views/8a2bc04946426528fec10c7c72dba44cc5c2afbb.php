<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Modules</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Modules</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Training Modules</h6>
        <p class="text-muted mb-3">Manage the training modules in your system below:</p>

        <!-- Button to create a new module -->
        <a href="<?php echo e(route('trainer.trainingModules.create')); ?>" class="btn btn-primary mb-3">Create Module</a>

        <!-- Table for displaying modules -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th> <!-- Row Number Column -->
                <th>Title</th>
                <th>Class</th>
                <th>Creator</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td> <!-- Display row number -->
                <td><?php echo e($module->title); ?></td> <!-- Displaying the title of the module -->
                <td><?php echo e($module->trainingClass->name ?? 'N/A'); ?></td> <!-- Displaying the associated class -->
                <td><?php echo e($module->creator->name ?? 'N/A'); ?></td> <!-- Displaying the creator's name -->
                <td>
                  <!-- View Button -->
                  <a href="<?php echo e(route('trainer.trainingModules.show', $module->id)); ?>" class="btn btn-info btn-sm">View</a>

                  <!-- Edit Button -->
                  <a href="<?php echo e(route('trainer.trainingModules.edit', $module->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                  
                  <!-- Delete Button -->
                  <form action="<?php echo e(route('trainer.trainingModules.destroy', $module->id)); ?>" method="POST" class="d-inline" id="form-<?php echo e($module->id); ?>">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_training_module', '<?php echo e($module->id); ?>')">Delete</button>
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
      $('#dataTableExample').DataTable();
    });

    // SweetAlert delete confirmation
    function showSwal(action, id) {
      let message = action === 'delete_training_module' ? 'Are you sure you want to delete this training module?' : '';
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



<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/Module/index.blade.php ENDPATH**/ ?>