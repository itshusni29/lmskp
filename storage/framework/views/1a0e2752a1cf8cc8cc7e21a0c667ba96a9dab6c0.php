<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">User Details</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">User Details</h6>
        <p class="text-muted mb-3">Below are the details of the selected user.</p>

        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <td><?php echo e($user->id); ?></td>
          </tr>
          <tr>
            <th>Username</th>
            <td><?php echo e($user->username); ?></td>
          </tr>
          <tr>
            <th>Name</th>
            <td><?php echo e($user->name); ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo e($user->email); ?></td>
          </tr>
          <tr>
            <th>Section</th>
            <td><?php echo e($user->section); ?></td>
          </tr>
          <tr>
            <th>Department</th>
            <td><?php echo e($user->department); ?></td>
          </tr>
          <tr>
            <th>Division</th>
            <td><?php echo e($user->division); ?></td>
          </tr>
          <tr>
            <th>Role</th>
            <td><?php echo e($user->role); ?></td>
          </tr>
          <tr>
            <th>Date of Join</th>
            <td><?php echo e(\Carbon\Carbon::parse($user->date_of_join)->translatedFormat('d F Y')); ?></td>
          </tr>
          <tr>
            <th>Date of Birth</th>
            <td><?php echo e(\Carbon\Carbon::parse($user->date_of_birth)->translatedFormat('d F Y')); ?></td>
          </tr>
          <tr>
            <th>Sex</th>
            <td><?php echo e($user->sex); ?></td>
          </tr>
        </table>

        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary mt-3">Back to Users</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/users/show.blade.php ENDPATH**/ ?>