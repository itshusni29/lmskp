<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">  
      <div class="card-body">
        <h6 class="card-title">User Profile</h6>
        <p class="text-muted mb-3">Below is the information Employee.</p>

        <!-- User Information -->
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>NIK</th>
              <td><?php echo e(auth()->user()->username); ?></td>
            </tr>
            <tr>
              <th>Name</th>
              <td><?php echo e(auth()->user()->name); ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo e(auth()->user()->email); ?></td>
            </tr>
            <tr>
              <th>Section</th>
              <td><?php echo e(auth()->user()->section); ?></td>
            </tr>
            <tr>
              <th>Department</th>
              <td><?php echo e(auth()->user()->department); ?></td>
            </tr>
            <tr>
              <th>Division</th>
              <td><?php echo e(auth()->user()->division); ?></td>
            </tr>
            <tr>
                <th>Date of Join</th>
                <td><?php echo e(\Carbon\Carbon::parse(auth()->user()->date_of_join)->format('d-m-Y')); ?></td>
            </tr>

            <tr>
              <th>Occupation</th>
              <td><?php echo e(auth()->user()->occupation); ?></td>
            </tr>
            <tr>
              <th>Gender</th>
              <td><?php echo e(ucfirst(auth()->user()->sex)); ?></td>
            </tr>
            <tr>
              <th>LTC</th>
              <td><?php echo e(auth()->user()->ltc); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/profile/student_show.blade.php ENDPATH**/ ?>