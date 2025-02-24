<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/jquery-steps/jquery.steps.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Tests</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('student.post_tests.index')); ?>">Post Test List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Take Post Test</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"><?php echo e($postTest->name); ?></h6> 
        <p class="text-muted mb-3"><?php echo e($postTest->description); ?></p>

        <!-- Post Test Questions -->
        <form action="<?php echo e(route('student.post_tests.submit', $postTest->id)); ?>" method="POST" id="postTestForm">
          <?php echo csrf_field(); ?>
          
          <!-- Vertical Wizard for Post Test -->
          <div id="wizardVertical">
            <?php $__currentLoopData = $postTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <h2><?php echo e($question->question); ?></h2>
              <section>
                <h4 class="mb-5"><?php echo e($question->question); ?></h4>

                <div class="form-check">
                  <input type="radio" class="form-check-input" name="answers[<?php echo e($question->id); ?>]" value="option_a" id="optionA<?php echo e($question->id); ?>">
                  <label class="form-check-label" for="optionA<?php echo e($question->id); ?>">
                    A. <?php echo e($question->option_a); ?>

                  </label>
                </div>

                <div class="form-check">
                  <input type="radio" class="form-check-input" name="answers[<?php echo e($question->id); ?>]" value="option_b" id="optionB<?php echo e($question->id); ?>">
                  <label class="form-check-label" for="optionB<?php echo e($question->id); ?>">
                    B. <?php echo e($question->option_b); ?>

                  </label>
                </div>

                <div class="form-check">
                  <input type="radio" class="form-check-input" name="answers[<?php echo e($question->id); ?>]" value="option_c" id="optionC<?php echo e($question->id); ?>">
                  <label class="form-check-label" for="optionC<?php echo e($question->id); ?>">
                    C. <?php echo e($question->option_c); ?>

                  </label>
                </div>

                <div class="form-check">
                  <input type="radio" class="form-check-input" name="answers[<?php echo e($question->id); ?>]" value="option_d" id="optionD<?php echo e($question->id); ?>">
                  <label class="form-check-label" for="optionD<?php echo e($question->id); ?>">
                    D. <?php echo e($question->option_d); ?>

                  </label>
                </div>
              </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <button type="submit" class="btn btn-success mt-4" id="submitTestButton">Submit Test</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/jquery-steps/jquery.steps.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script>
    $(document).ready(function() {
      // Inisialisasi wizard vertikal
      $('#wizardVertical').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'fade',
        enableAllSteps: true, // Mengaktifkan navigasi untuk semua langkah
        autoFocus: true
      });

      // Menangani klik tombol submit
      $('#submitTestButton').click(function(e) {
        e.preventDefault(); // Mencegah form langsung disubmit

        // Periksa apakah semua soal telah dijawab
        let allAnswered = true;

        // Loop untuk memeriksa setiap soal
        $('input[type="radio"]').each(function() {
          const questionId = $(this).attr('name'); // Mendapatkan nama (answers[question_id])
          const selectedAnswer = $(`input[name="${questionId}"]:checked`);

          if (selectedAnswer.length === 0) {
            allAnswered = false; // Jika ada soal yang belum dijawab
            return false; // Keluar dari loop jika ditemukan soal yang belum dijawab
          }
        });

        if (allAnswered) {
          // Tampilkan SweetAlert jika semua soal sudah dijawab
          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda telah menjawab semua soal. Apakah Anda yakin ingin mengirimkan jawaban Anda?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirimkan',
            cancelButtonText: 'Tidak, kembali'
          }).then((result) => {
            if (result.isConfirmed) {
              // Jika yakin, kirimkan form
              $('#postTestForm').submit();
            }
          });
        } else {
          // Tampilkan SweetAlert jika ada soal yang belum dijawab
          Swal.fire({
            title: 'Jawaban belum lengkap',
            text: 'Ada soal yang belum dijawab. Apakah Anda tetap ingin mengirimkan jawaban?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirimkan saja',
            cancelButtonText: 'Tidak, kembali'
          }).then((result) => {
            if (result.isConfirmed) {
              // Jika yakin, kirimkan form
              $('#postTestForm').submit();
            }
          });
        }
      });
    });

  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/postTest/take.blade.php ENDPATH**/ ?>