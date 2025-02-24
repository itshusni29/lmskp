<?php $__env->startPush('plugin-styles'); ?>
    <link href="<?php echo e(asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Assessment</a></li>
            <li class="breadcrumb-item active" aria-current="page">OJT Training Assessments</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">ON THE JOB TRAINING Assessments</h6>
                    <p class="text-muted mb-3">Manage assessments for OJT Training Stage:</p>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($participant->username); ?></td>
                                    <td><?php echo e($participant->name); ?></td>
                                    <td><?php echo e($participant->section); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('trainer.assessments.ojt.create', $participant->id)); ?>" class="btn btn-primary btn-sm">Add</a>

                                        <!-- Check if the participant has an associated assessment -->
                                        <?php if($participant->ojtAssessment): ?>
                                            <a href="<?php echo e(route('trainer.assessments.ojt.edit', $participant->ojtAssessment->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <?php else: ?>
                                            <span class="text-muted">No assessment</span>
                                        <?php endif; ?>
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
    <script src="<?php echo e(asset('assets/js/sweet-alert.js')); ?>"></script>

    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#dataTableExample').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search
                "ordering": true, // Enable sorting
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/assessments/indexojt.blade.php ENDPATH**/ ?>