<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users List</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Users List</h6>
        <p class="text-muted mb-3">Manage users in your system below:</p>

        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary mb-3">Add New User</a>

        <!-- Table for displaying users -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-striped">
            <thead>
              <tr>
                <th>No</th> <!-- Kolom nomor urut -->
                <th>NIK</th>
                <th>Name</th>
                <th>Email</th>
                <th>Section</th>
                <th>Department</th>
                <th>Division</th>
                <th>LTC</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td></td> <!-- Kolom nomor urut otomatis -->
                <td><?php echo e($user->username); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->section); ?></td>
                <td><?php echo e($user->department); ?></td>
                <td><?php echo e($user->division); ?></td>
                <td><?php echo e($user->ltc ?? 'N/A'); ?></td>
                <td>
                  <a href="<?php echo e(route('users.show', $user->id)); ?>" class="btn btn-info btn-sm">View</a>
                  <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                  <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display:inline;" id="form-<?php echo e($user->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-danger btn-sm" onclick="showSwal('delete_users', '<?php echo e($user->id); ?>')">Delete</button>
                  </form>
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
  <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script>
    // Initialize DataTable
    $(document).ready(function() {
      $('#dataTableExample').DataTable({
        "paging": true, 
        "searching": true, 
        "ordering": true,
        "columnDefs": [
          {
            "targets": 0, // Kolom pertama untuk nomor urut
            "orderable": false, // Nonaktifkan fitur sorting
            "searchable": false, // Nonaktifkan fitur pencarian
          }
        ],
        "order": [], // Hilangkan sorting default
        "createdRow": function(row, data, dataIndex) {
          // Tambahkan nomor urut pada kolom pertama
          $('td:eq(0)', row).html(dataIndex + 1);
        }
      });
    });


    // SweetAlert for Delete Confirmation
    function showSwal(action, id) {
      if (action === 'delete_users') {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('form-' + id).submit();
          }
        });
      }
    }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/users/index.blade.php ENDPATH**/ ?>