<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Local Training Center</a></li>
    <li class="breadcrumb-item active" aria-current="page">Training Participants</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">LOCAL TRAINING CENTER</h6>
        <p class="text-muted mb-3">Manage and track participants for the local training center below:</p>

        <!-- Filter Form -->
        <form method="GET" action="<?php echo e(route('admin.rekap.local_training_center')); ?>">
            <div class="form-group mb-3">
                <label for="date_of_join">Filter by Date of Join:</label>
                <select name="date_of_join" id="date_of_join" class="form-control">
                    <option value="">Select Date of Join</option>
                    <?php $__currentLoopData = $datesOfJoin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($date); ?>" <?php if(request('date_of_join') == $date): ?> selected <?php endif; ?>>
                            <?php echo e(\Carbon\Carbon::parse($date)->format('d-m-Y')); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div class="table-responsive mt-4">
            <table id="dataTableExample" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Sex</th>
                        <th>Date of Join</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->section); ?></td>
                            <td><?php echo e(ucfirst($user->sex)); ?></td>
                            <td><?php echo e($user->date_of_join ? \Carbon\Carbon::parse($user->date_of_join)->format('Y-m-d') : '-'); ?></td>
                            <td>
                            <button class="btn btn-primary btn-sm view-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#attendanceModal"
                                    data-id="<?php echo e($user->id); ?>"
                                    data-username="<?php echo e($user->username); ?>"
                                    data-name="<?php echo e($user->name); ?>"
                                    data-section="<?php echo e($user->section); ?>"
                                    data-sex="<?php echo e($user->sex); ?>"
                                    data-post-tests='<?php echo json_encode($postTestsData->where('user.id', $user->id)->first()['postTests'] ?? [], 512) ?>'>
                                <i class="fas fa-eye"></i> View
                            </button>
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


<!-- Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">Participant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Username:</strong> <span id="modal-username"></span></p>
        <p><strong>Name:</strong> <span id="modal-name"></span></p>
        <p><strong>Section:</strong> <span id="modal-section"></span></p>
        <p><strong>Sex:</strong> <span id="modal-sex"></span></p>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Post Test</th>
              <th>Post</th>
              <th>Remedial 1</th>
              <th>Remedial 2</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="modal-post-tests">
            <!-- Data will be dynamically populated -->
          </tbody>
        </table>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
<script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
<script>
  $(document).ready(function() {
  $('#dataTableExample').DataTable();

  $('#attendanceModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var modal = $(this);

    // Set user details
    modal.find('#modal-username').text(button.data('username'));
    modal.find('#modal-name').text(button.data('name'));
    modal.find('#modal-section').text(button.data('section'));
    modal.find('#modal-sex').text(button.data('sex'));

    // Set user ID in the approval form
    modal.find('#modal-user-id').val(button.data('id'));

    // Clear and populate post test results
    var postTestsData = button.data('post-tests');
    var tableBody = modal.find('#modal-post-tests');
    tableBody.empty();

    postTestsData.forEach(function(result) {
      tableBody.append(`
        <tr>
          <td>${result.postTest.name}</td>
          <td>${result.grades.post}</td>
          <td>${result.grades.remed1}</td>
          <td>${result.grades.remed2}</td>
          <td class="${result.status === 'Passed' ? 'text-success' : 'text-danger'}">
            ${result.status}
          </td>
        </tr>
      `);
    });
  });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/rekap_training_stages/local_training_center.blade.php ENDPATH**/ ?>