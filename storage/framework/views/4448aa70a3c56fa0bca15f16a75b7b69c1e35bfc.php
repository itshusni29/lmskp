<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance Schedule</a></li>
    <li class="breadcrumb-item active" aria-current="page">Attendance Schedule List</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Attendance Schedule List</h6>
        <p class="text-muted mb-3">Manage attendance schedules for training sessions below:</p>

        <!-- Button for adding a new attendance schedule -->
        <a href="<?php echo e(route('attendanceSchedules.create')); ?>" class="btn btn-primary mb-3">Add New Attendance Schedule</a>

        <!-- Table for displaying attendance schedule records -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th> <!-- Row Number Column -->
                <th>Training Stage</th>
                <th>Attendance Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Date of Join</th> <!-- Add Date of Join Column -->
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $attendanceSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($index + 1); ?></td> 
                <td><?php echo e($schedule->trainingStage->name); ?></td> 
                <td><?php echo e(\Carbon\Carbon::parse($schedule->attendance_date)->format('Y-m-d')); ?></td> 
                <td><?php echo e($schedule->start_time); ?></td> 
                <td><?php echo e($schedule->end_time); ?></td> 
                <td><?php echo e(\Carbon\Carbon::parse($schedule->date_of_join)->format('Y-m-d')); ?></td> 

                <td>
                  <!-- Admin actions: View and Edit -->
                  <a href="<?php echo e(route('attendanceSchedules.show', $schedule->id)); ?>" class="btn btn-info btn-sm">View</a>
                  <a href="<?php echo e(route('attendanceSchedules.edit', $schedule->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                  <!-- Delete Form -->
                  <form action="<?php echo e(route('attendanceSchedules.destroy', $schedule->id)); ?>" method="POST" style="display:inline;" id="form-<?php echo e($schedule->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_attendance_schedule', '<?php echo e($schedule->id); ?>')">Delete</button>
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
      $('#dataTableExample').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search
        "ordering": true, // Enable sorting
      });
    });

    function showSwal(action, id) {
      if (action === 'delete_attendance_schedule') {
        Swal.fire({
          title: 'Confirmation',
          text: 'Are you sure you want to delete this attendance schedule?',
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
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendanceSchedules/index.blade.php ENDPATH**/ ?>