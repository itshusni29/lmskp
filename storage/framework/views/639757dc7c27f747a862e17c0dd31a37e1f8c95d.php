<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance Schedule</a></li>
    <li class="breadcrumb-item active" aria-current="page">Attendance Schedule Details</li>
  </ol>
</nav>  

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Attendance Schedule Details</h6>
        <p class="text-muted mb-3">Manage and track attendance for the selected attendance schedule:</p>

        <!-- Filter Form -->
        <form method="GET" action="<?php echo e(route('admin.attendanceSchedules.show', $attendanceSchedule->id)); ?>">
            <div class="form-group mb-3">
                <label for="date_of_join">Filter by Date of Join:</label>
                <select name="date_of_join" id="date_of_join" class="form-control">
                    <option value="">Select Date of Join</option>
                    <?php $__currentLoopData = $datesOfJoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($date); ?>" <?php if(request('date_of_join') == $date): ?> selected <?php endif; ?>>
                            <?php echo e(\Carbon\Carbon::parse($date)->format('d-m-Y')); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="attendance_date">Filter by Attendance Date:</label>
                <input type="date" name="attendance_date" id="attendance_date" class="form-control" value="<?php echo e(request('attendance_date')); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div class="table-responsive mt-4">
            <table id="dataTableExample" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Sex</th>
                        <th>Date of Join</th>
                        <th>Attendance Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->section); ?></td>
                            <td><?php echo e(ucfirst($user->sex)); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($user->date_of_join)->format('Y-m-d')); ?></td>
                            <?php
                                $attendance = $user->attendances->firstWhere('attendance_schedule_id', $attendanceSchedule->id);
                            ?>
                            <td><?php echo e($attendance ? \Carbon\Carbon::parse($attendance->attendance_date)->format('Y-m-d') : '-'); ?></td>
                            <td>
                                <?php if($attendance): ?>
                                    <span class="text-success">Recorded</span>
                                <?php else: ?>
                                    <span class="text-warning">No record</span>
                                <?php endif; ?>
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
<script>
  $(document).ready(function() {
    $('#dataTableExample').DataTable();
  });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendanceSchedules/show.blade.php ENDPATH**/ ?>