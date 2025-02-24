<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance Schedules</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New Schedule</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Add New Attendance Schedule</h6>

        <!-- Form for creating a new attendance schedule -->
        <form method="POST" action="<?php echo e(route('attendanceSchedules.store')); ?>">
          <?php echo csrf_field(); ?>

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
                <option value="<?php echo e($stage->id); ?>" <?php echo e(old('training_stage_id') == $stage->id ? 'selected' : ''); ?>><?php echo e($stage->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- Attendance Date Field -->
          <div class="form-group mb-3">
            <label for="attendance_date">Attendance Date</label>
            <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?php echo e(old('attendance_date')); ?>" required>
          </div>

          <!-- Date of Join Field -->
          <div class="form-group mb-3">
            <label for="date_of_join">Date Of Join</label>
            <input type="date" class="form-control" id="date_of_join" name="date_of_join" value="<?php echo e(old('date_of_join')); ?>" required>
          </div>

          <!-- Start Time Field -->
          <div class="form-group mb-3">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time')); ?>" required>
          </div>

          <!-- End Time Field -->
          <div class="form-group mb-3">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time')); ?>" required>
          </div>

          <!-- Submit Button -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendanceSchedules/create.blade.php ENDPATH**/ ?>