<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Modules</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Module</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create Training Module</h6>
        <form method="POST" action="<?php echo e(route('trainingModules.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          
          <!-- Module Title Field -->
          <div class="form-group">
            <label for="title">Module Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <!-- TinyMCE Editor -->
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10"></textarea>
          </div>

          <!-- Module Image Upload -->
          <div class="form-group">
            <label for="image_path">Module Image</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
          </div>

          <!-- Training Class -->
          <div class="form-group">
            <label for="training_class_id">Training Class</label>
            <select class="form-control" id="training_class_id" name="training_class_id" required>
              <?php $__currentLoopData = $trainingClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- Creator -->
          <div class="form-group">
            <label for="creator_id">Creator</label>
            <select class="form-control" id="creator_id" name="creator_id" required>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Save Module</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/Module/create.blade.php ENDPATH**/ ?>