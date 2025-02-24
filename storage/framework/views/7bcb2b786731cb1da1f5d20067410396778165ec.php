<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance Schedules</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Attendance Schedule</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Update Attendance Schedule</h6>

        <!-- Form for updating an attendance schedule -->
        <form method="POST" action="<?php echo e(route('attendanceSchedules.update', $attendanceSchedule->id)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?> <!-- Use PUT for update -->

          <!-- Display Validation Errors -->
          <?php if($errors->any()): ?>
            <div class="alert alert-danger">
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>

          <!-- Training Stage Field -->
          <div class="form-group mb-3">
            <label for="training_stage_id">Training Stage</label>
            <select class="form-control" id="training_stage_id" name="training_stage_id" required>
              <option value="">Select Training Stage</option>
              <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($stage->id); ?>" <?php echo e(old('training_stage_id', $attendanceSchedule->training_stage_id) == $stage->id ? 'selected' : ''); ?>><?php echo e($stage->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- Attendance Date Field -->
          <div class="mb-3">
              <label for="attendance_date" class="form-label">Attendance Date</label>
              <input type="date" name="attendance_date" id="attendance_date" class="form-control"
                  value="<?php echo e(old('attendance_date', \Carbon\Carbon::parse($attendanceSchedule->attendance_date)->format('Y-m-d') ?? '')); ?>">
                </div>
                
                
                <!-- Attendance Date Field -->
          <div class="mb-3">
              <label for="date_of_join" class="form-label">Attendance Date</label>
              <input type="date" name="date_of_join" id="date_of_join" class="form-control"
                  value="<?php echo e(old('date_of_join', \Carbon\Carbon::parse($attendanceSchedule->date_of_join)->format('Y-m-d') ?? '')); ?>">
          </div>

          <!-- Start Time Field -->
          <div class="form-group mb-3">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time', $attendanceSchedule->start_time)); ?>" required>
          </div>

          <!-- End Time Field -->
          <div class="form-group mb-3">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time', $attendanceSchedule->end_time)); ?>" required>
          </div>

          <!-- Submit Button -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendanceSchedules/edit.blade.php ENDPATH**/ ?>