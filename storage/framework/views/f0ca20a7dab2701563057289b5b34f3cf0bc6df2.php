<?php $__env->startPush('plugin-styles'); ?>
<link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Participants</a></li>
    <li class="breadcrumb-item active" aria-current="page">Induction Training</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">INDUCTION TRAINING</h6>
        <p class="text-muted mb-3">Below is the list of participants with static data:</p>

        <!-- Filter DOJ Form -->
        <form method="GET" action="<?php echo e(route('admin.spv.induction_training')); ?>">
          <div class="form-group mb-3">
            <label for="date_of_join">Filter by Date of Join:</label>
            <select name="date_of_join" id="date_of_join" class="form-control">
              <option value="">Select Date of Join</option>
              <?php $__currentLoopData = $dates_of_join; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <th>Approval Status</th> <!-- New column for Approval Status -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <!-- Nomor Iterasi -->
        <td><?php echo e($loop->iteration); ?></td>
        
        <!-- Username -->
        <td><?php echo e($user->username); ?></td>
        
        <!-- Nama -->
        <td><?php echo e($user->name); ?></td>
        
        <!-- Bagian/Divisi -->
        <td><?php echo e($user->section); ?></td>
        
        <!-- Jenis Kelamin -->
        <td><?php echo e(ucfirst($user->sex)); ?></td>
        
        <!-- Tanggal Bergabung -->
        <td>
            <?php echo e($user->date_of_join ? \Carbon\Carbon::parse($user->date_of_join)->format('Y-m-d') : '-'); ?>

        </td>
        
        <!-- Status Approval -->
        <td>
            <?php if($user->spvApproval): ?>
                <?php
                    $status = $user->spvApproval->approval_status;
                    $badgeClass = match ($status) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'pending' => 'warning',
                        default => 'secondary',
                    };
                ?>
                <span class="badge bg-<?php echo e($badgeClass); ?>">
                    <?php echo e(ucfirst($status)); ?>  
                </span>
            <?php else: ?>
                <span class="badge bg-warning">Pending</span>
            <?php endif; ?>
        </td>

        
        <!-- Tombol Lihat Detail -->
        <td>
            <button 
                class="btn btn-primary btn-sm view-btn"
                data-bs-toggle="modal"
                data-bs-target="#attendanceModal"
                data-id="<?php echo e($user->id); ?>"
                data-username="<?php echo e($user->username); ?>"
                data-name="<?php echo e($user->name); ?>"
                data-section="<?php echo e($user->section); ?>"
                data-sex="<?php echo e(ucfirst($user->sex)); ?>"
                data-post-tests='<?php echo json_encode($postTests, 15, 512) ?>'>
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


<!-- Modal for Viewing Participant Details -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">Participant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Participant Details -->
        <p class="mb-2"><strong>Username:</strong> <span id="modal-username"></span></p>
        <p class="mb-2"><strong>Name:</strong> <span id="modal-name"></span></p>
        <p class="mb-2"><strong>Section:</strong> <span id="modal-section"></span></p>
        <p class="mb-3"><strong>Sex:</strong> <span id="modal-sex"></span></p>

        <div class="table-responsive mb-3">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Post Test</th>
                <th>Remedial 1</th>
                <th>Remedial 2</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="modal-post-tests">
              <!-- Data populated dynamically -->
            </tbody>
          </table>
        </div>

        <!-- Approval Form -->
        <form method="POST" action="<?php echo e(route('admin.spv.induction_training.approve_post')); ?>">
            <?php echo csrf_field(); ?>
            <!-- Hidden Input to Store User ID -->
            <input type="hidden" name="user_id" id="modal-user-id" value="<?php echo e(old('user_id')); ?>">

            <div class="form-group mb-3">
                <label for="approval_status" class="form-label">Approval Status:</label>
                <select name="approval_status" id="approval_status" class="form-control <?php $__errorArgs = ['approval_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="pending" <?php echo e(old('approval_status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="approved" <?php echo e(old('approval_status') == 'approved' ? 'selected' : ''); ?>>Approved</option>
                    <option value="rejected" <?php echo e(old('approval_status') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                </select>
                <?php $__errorArgs = ['approval_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group mb-3">
                <label for="remark" class="form-label">Remark (optional):</label>
                <textarea name="remark" id="remark" class="form-control <?php $__errorArgs = ['remark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('remark')); ?></textarea>
                <?php $__errorArgs = ['remark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


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
    $('#dataTableExample').DataTable({
      paging: true,
      searching: true,
      ordering: true,
    });
  });

  $('#attendanceModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button yang memicu modal
    var modal = $(this);

    // Populate static fields
    modal.find('#modal-username').text(button.data('username'));
    modal.find('#modal-name').text(button.data('name'));
    modal.find('#modal-section').text(button.data('section'));
    modal.find('#modal-sex').text(button.data('sex'));  

    // Set user_id dalam hidden field
    modal.find('#modal-user-id').val(button.data('id'));

    // Filter post-test data
    var userId = button.data('id');
    var postTests = button.data('post-tests');
    var filteredData = postTests.filter(test =>
      test.userResults.some(result => result.user.id === userId)
    );

    // Populate table body
    var tableBody = modal.find('#modal-post-tests');
    tableBody.empty();
    filteredData.forEach(data => {
      data.userResults.forEach(result => {
        if (result.user.id === userId) {
          tableBody.append(`
            <tr>
              <td>${data.postTest.name}</td>
              <td>${result.grades.post}</td>
              <td>${result.grades.remed1}</td>
              <td>${result.grades.remed2}</td>
              <td class="${result.status === 'Passed' ? 'text-success' : 'text-danger'}">
                ${result.status}
              </td>
            </tr>
          `);
        }
      });
    });
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/spv/training_stages/induction_training.blade.php ENDPATH**/ ?>