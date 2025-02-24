<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Stages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Stage</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Edit Training Stage</h6>

        <!-- Form for editing an existing training stage -->
        <form method="POST" action="<?php echo e(route('training_stages.update', $trainingStage->id)); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>

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
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $trainingStage->name)); ?>" required>
          </div>

          <!-- Stage Description Field -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"><?php echo e(old('description', $trainingStage->description)); ?></textarea>
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
            <!-- Display existing banner image if it exists -->
            <?php if($trainingStage->banner_image): ?>
              <div class="mt-3">
                <p>Current Banner Image:</p>
                <img src="<?php echo e(asset('storage/' . $trainingStage->banner_image)); ?>" alt="Current Banner" class="img-fluid" style="max-width: 200px;">
              </div>
            <?php endif; ?>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/training_stages/edit.blade.php ENDPATH**/ ?>