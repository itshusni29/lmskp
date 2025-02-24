<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Stages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New Stage</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Add New Training Stage</h6>

        <!-- Form for creating a new training stage -->
        <form method="POST" action="<?php echo e(route('training_stages.store')); ?>" enctype="multipart/form-data">
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

          <!-- Stage Name Field -->
          <div class="form-group">
            <label for="name">Stage Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
          </div>

          <!-- Stage Description Field -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"><?php echo e(old('description')); ?></textarea>
          </div>

          <!-- Banner Image Upload Field -->
          <div class="form-group">
            <label for="banner_image">Banner Image</label>
            <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
            <?php if($errors->has('banner_image')): ?>
              <div class="text-danger mt-2">
                <?php echo e($errors->first('banner_image')); ?>

              </div>
            <?php endif; ?>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/training_stages/create.blade.php ENDPATH**/ ?>