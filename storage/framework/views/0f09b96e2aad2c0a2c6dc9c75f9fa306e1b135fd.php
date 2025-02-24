<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">INITIAL CONTROL</a></li>
    <li class="breadcrumb-item active" aria-current="page">Training Participants</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">INITIAL CONTROL</h6>
        <p class="text-muted mb-3">Manage and track participants for the Initial Control below:</p>

        <!-- Filter Form -->
        <form method="GET" action="<?php echo e(route('admin.rekap.initial_control')); ?>">
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

        <!-- Table -->
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
            <?php $__currentLoopData = $assessmentsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $data['userResults']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userResult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->parent->iteration); ?></td>
                <td><?php echo e($userResult['user']->username); ?></td>
                <td><?php echo e($userResult['user']->name); ?></td>
                <td><?php echo e($userResult['user']->section); ?></td>
                <td><?php echo e(ucfirst($userResult['user']->sex)); ?></td>
                <td><?php echo e($userResult['user']->date_of_join ? \Carbon\Carbon::parse($userResult['user']->date_of_join)->format('Y-m-d') : '-'); ?></td>
                <td>
                <button class="btn btn-primary btn-sm view-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#assessmentModal"
                        data-id="<?php echo e($userResult['user']->id); ?>"
                        data-username="<?php echo e($userResult['user']->username); ?>"
                        data-name="<?php echo e($userResult['user']->name); ?>"
                        data-section="<?php echo e($userResult['user']->section); ?>"
                        data-sex="<?php echo e($userResult['user']->sex); ?>"
                        data-assessments="<?php echo e(json_encode($userResult['subjects'])); ?>">
                    <i class="fas fa-eye"></i> View
                </button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Assessment Modal -->
<div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="assessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assessmentModalLabel">Participant Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Modal Content -->
              <div class="row">
                <div class="col-md-2">
                    <strong>Username</strong>
                </div>
                <div class="col-md-10 text-left">
                    <p>: <span id="modal-username"></span></p>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-2">
                      <strong>Name</strong>
                  </div>
                  <div class="col-md-9 text-left">
                      <p>: <span id="modal-name"></span></p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-2">
                      <strong>Section</strong>
                  </div>
                  <div class="col-md-9 text-left">
                      <p>: <span id="modal-section"></span></p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-2">
                      <strong>Sex</strong>
                  </div>
                  <div class="col-md-9 text-left">
                      <p>: <span id="modal-sex"></span></p>
                  </div>
              </div>

              <!-- Assessments Table -->
              <table class="table table-bordered my-4">
                  <thead>
                      <tr>
                          <th>Assessment Name</th>
                          <th>Score</th>
                      </tr>
                  </thead>
                  <tbody id="modal-assessments">

                  </tbody>
              </table>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
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
      $('#dataTableExample').DataTable();

  $('#assessmentModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var userId = button.data('id');
    var username = button.data('username');
    var name = button.data('name');
    var section = button.data('section');
    var sex = button.data('sex');
    var assessments = button.data('assessments');

    // Set the user_id in the hidden input
    $('#modal-user-id').val(userId);

    // Update modal content
    $('#modal-username').text(username);
    $('#modal-name').text(name);
    $('#modal-section').text(section);
    $('#modal-sex').text(sex);

    var assessmentHtml = '';
    assessments.forEach(function(assessment) {
        assessmentHtml += '<tr>';
        assessmentHtml += '<td>' + assessment.subject + '</td>';
        assessmentHtml += '<td>' + assessment.score + '</td>';
        assessmentHtml += '</tr>';
    });

    $('#modal-assessments').html(assessmentHtml);
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/rekap_training_stages/initial_control.blade.php ENDPATH**/ ?>