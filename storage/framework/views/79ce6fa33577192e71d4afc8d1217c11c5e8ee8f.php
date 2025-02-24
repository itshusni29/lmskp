<!-- resources/views/pages/attendance/create.blade.php -->



<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Attendance</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create Attendance Record</h6>
        <form method="POST" action="<?php echo e(route('attendance.store')); ?>">
          <?php echo csrf_field(); ?>

          <!-- Student Selection -->
          <div class="form-group">
            <label for="user_id">Student</label>
            <select class="form-control" id="user_id" name="user_id" required>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- Training Stage -->
          <div class="form-group">
            <label for="training_stage_id">Training Stage</label>
            <select class="form-control" id="training_stage_id" name="training_stage_id" required>
              <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainingStage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($trainingStage->id); ?>"><?php echo e($trainingStage->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- Attendance Date -->
          <div class="form-group">
            <label for="attendance_date">Attendance Date</label>
            <input type="date" class="form-control" id="attendance_date" name="attendance_date" required>
          </div>

          <!-- Start Time -->
          <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
          </div>

          <!-- End Time -->
          <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
          </div>

          <!-- Remarks -->
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Save Attendance</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/attendance/create.blade.php ENDPATH**/ ?>