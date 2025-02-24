<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance</a></li>
    <li class="breadcrumb-item active" aria-current="page">Attendance List</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Attendance List</h6>
        <p class="text-muted mb-3">Manage attendance records for training below:</p>

        <a href="<?php echo e(route('attendance.create')); ?>" class="btn btn-primary mb-3">Add New Attendance</a> <!-- Add New Attendance Button -->

        <!-- Table for displaying attendance records -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th> <!-- Row Number Column -->
                <th>User Name</th> <!-- Moved User Name to the left -->
                <th>Training Stage</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Add index to loop for row number -->
              <tr>
                <td><?php echo e($index + 1); ?></td> <!-- Display row number starting from 1 -->
                <td><?php echo e($attendance->user->name); ?></td> <!-- Assuming attendance has a relation with user -->
                <td><?php echo e($attendance->trainingStage->name); ?></td> <!-- Assuming attendance has a relation with trainingStages -->
                <td><?php echo e($attendance->date); ?></td>
                <td><?php echo e($attendance->time_in); ?></td>
                <td><?php echo e($attendance->time_out); ?></td>
                <td><?php echo e($attendance->status); ?></td> <!-- Assuming status is a field in the attendance table -->
                <td>
                  <a href="<?php echo e(route('attendance.show', $attendance->id)); ?>" class="btn btn-info btn-sm">View</a>
                  <a href="<?php echo e(route('attendance.edit', $attendance->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                  <!-- Delete Form -->
                  <form action="<?php echo e(route('attendance.destroy', $attendance->id)); ?>" method="POST" style="display:inline;" id="form-<?php echo e($attendance->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_attendance', '<?php echo e($attendance->id); ?>')">Delete</button>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendance/index.blade.php ENDPATH**/ ?>