<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/prismjs/prism.css')); ?>" rel="stylesheet" />
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
        <p class="text-muted mb-3">Manage your attendance for training sessions below:</p>

        <!-- Menampilkan pesan error jika ada -->
        <?php if($errors->has('error')): ?>
          <div class="alert alert-danger">
            <?php echo e($errors->first('error')); ?>

          </div>
        <?php endif; ?>

        <!-- Table for displaying attendance schedule records -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Training Stage</th> 
                <th>Attendance Date</th> 
                <th>Start Time</th> 
                <th>End Time</th> 
                <th>Remarks</th> 
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
                    <td>
                        <?php echo e($schedule->attendanceForUser(auth()->id())?->remarks ?? 'Not filled'); ?>

                    </td>
                    <td>
                    <?php if(!$schedule->attendanceForUser(auth()->id())): ?>
                        <?php if($schedule->locked): ?>
                            <!-- Tombol akan terkunci jika waktu diluar rentang yang ditentukan -->
                            <button class="btn btn-secondary btn-sm" disabled>
                                Mark Attendance
                            </button>
                        <?php else: ?>
                            <!-- Cek apakah waktu sekarang berada di antara start dan end time -->
                            <button class="btn btn-primary btn-sm mark-attendance-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#attendanceModal"
                                    data-id="<?php echo e($schedule->id); ?>"
                                    data-date="<?php echo e($schedule->attendance_date); ?>"
                                    data-start="<?php echo e($schedule->start_time); ?>"
                                    data-end="<?php echo e($schedule->end_time); ?>">
                                Mark Attendance
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Jika sudah menandai kehadiran -->
                        <button class="btn btn-success btn-sm" disabled>
                                Mark Attendance
                            </button>
                    <?php endif; ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
      </div>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="alert alert-danger"><?php echo e($error); ?></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

<!-- Modal for marking attendance -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">Mark Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?php echo e(route('student.attendance.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <!-- Hidden fields for automatic values -->
            <input type="hidden" name="attendance_schedule_id" id="attendance_schedule_id">
            <input type="hidden" name="attendance_date" id="attendance_date">
            <input type="hidden" name="start_time" id="start_time">
            <input type="hidden" name="end_time" id="end_time">

            <!-- Remarks -->
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <select name="remarks" id="remarks" class="form-control" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="saveAttendanceBtn">Save Attendance</button>
        </div>
    </form>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/prismjs/prism.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/clipboard/clipboard.min.js')); ?>"></script>
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

    // Set values in the modal when the button is clicked
    $('#attendanceModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);  // Button that triggered the modal
      var scheduleId = button.data('id');
      var attendanceDate = button.data('date');
      var startTime = button.data('start');
      var endTime = button.data('end');

      var modal = $(this);
      modal.find('#attendance_schedule_id').val(scheduleId);
      modal.find('#attendance_date').val(attendanceDate);
      modal.find('#start_time').val(startTime);
      modal.find('#end_time').val(endTime);

      // Set current date and time as default
      var currentDate = new Date().toISOString().split('T')[0]; // Date in YYYY-MM-DD format
      var currentTime = new Date().toISOString().split('T')[1].split('.')[0]; // Time in HH:MM:SS format

      // Set values in hidden fields for attendance_date, start_time, and end_time
      modal.find('#attendance_date').val(currentDate);
      modal.find('#start_time').val(currentTime);
      modal.find('#end_time').val(currentTime);

      // Disable the input fields to prevent edits
      modal.find('#attendance_date').prop('disabled', true);
      modal.find('#start_time').prop('disabled', true);
      modal.find('#end_time').prop('disabled', true);

      // Lock the "Save Attendance" button if the time doesn't match
      var currentDateTime = new Date(currentDate + ' ' + currentTime);
      var scheduleStartTime = new Date(attendanceDate + ' ' + startTime);
      var scheduleEndTime = new Date(attendanceDate + ' ' + endTime);

      if (currentDateTime < scheduleStartTime || currentDateTime > scheduleEndTime) {
          modal.find('#saveAttendanceBtn').prop('disabled', true);
      } else {
          modal.find('#saveAttendanceBtn').prop('disabled', false);
      }
    });

  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/attendance/index.blade.php ENDPATH**/ ?>