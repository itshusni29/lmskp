<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Test</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Post Test</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Edit Post Test</h6>
        <form action="<?php echo e(route('post_tests.update', $postTest->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="training_stage_id" class="form-label">Training Stage</label>
                <select name="training_stage_id" id="training_stage_id" class="form-control">
                    <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($stage->id); ?>" <?php echo e($postTest->training_stage_id == $stage->id ? 'selected' : ''); ?>>
                            <?php echo e($stage->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ltc" class="form-label">LTC</label>
                <select name="ltc" id="ltc" class="form-control" required>
                    <option value="aluminium" <?php echo e(old('ltc') == 'aluminium' ? 'selected' : ''); ?>>Aluminium</option>
                    <option value="steel" <?php echo e(old('ltc') == 'steel' ? 'selected' : ''); ?>>Steel</option>
                    <option value="common" <?php echo e(old('ltc') == 'common' ? 'selected' : ''); ?>>Common</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Post Test Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $postTest->name)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"><?php echo e(old('description', $postTest->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control"
                    value="<?php echo e(old('start_time', \Carbon\Carbon::parse($postTest->start_time)->format('Y-m-d\TH:i') ?? '')); ?>">
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control"
                    value="<?php echo e(old('end_time', \Carbon\Carbon::parse($postTest->end_time)->format('Y-m-d\TH:i') ?? '')); ?>">
            </div>

            <h3>Questions</h3>
            <div id="questions-container">
            <?php $__currentLoopData = $postTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="question-item mb-4" data-index="<?php echo e($index); ?>">
                    <label for="questions[<?php echo e($question->id); ?>][question]" class="form-label">Question</label>
                    <input type="text" name="questions[<?php echo e($question->id); ?>][question]" class="form-control" value="<?php echo e(old('questions.' . $question->id . '.question', $question->question)); ?>" required>
                    
                    <div class="row mt-2">
                        <div class="col">
                            <label>Option A</label>
                            <input type="text" name="questions[<?php echo e($question->id); ?>][option_a]" class="form-control" value="<?php echo e(old('questions.' . $question->id . '.option_a', $question->option_a)); ?>" required>
                        </div>
                        <div class="col">
                            <label>Option B</label>
                            <input type="text" name="questions[<?php echo e($question->id); ?>][option_b]" class="form-control" value="<?php echo e(old('questions.' . $question->id . '.option_b', $question->option_b)); ?>" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label>Option C</label>
                            <input type="text" name="questions[<?php echo e($question->id); ?>][option_c]" class="form-control" value="<?php echo e(old('questions.' . $question->id . '.option_c', $question->option_c)); ?>" required>
                        </div>
                        <div class="col">
                            <label>Option D</label>
                            <input type="text" name="questions[<?php echo e($question->id); ?>][option_d]" class="form-control" value="<?php echo e(old('questions.' . $question->id . '.option_d', $question->option_d)); ?>" required>
                        </div>
                    </div>

                    <label class="mt-2">Correct Answer</label>
                    <select name="questions[<?php echo e($question->id); ?>][correct_answer]" class="form-control" required>
                        <option value="option_a" <?php echo e($question->correct_answer == 'option_a' ? 'selected' : ''); ?>>Option A</option>
                        <option value="option_b" <?php echo e($question->correct_answer == 'option_b' ? 'selected' : ''); ?>>Option B</option>
                        <option value="option_c" <?php echo e($question->correct_answer == 'option_c' ? 'selected' : ''); ?>>Option C</option>
                        <option value="option_d" <?php echo e($question->correct_answer == 'option_d' ? 'selected' : ''); ?>>Option D</option>
                    </select>

                    <button type="button" class="btn btn-danger mt-3 remove-question">Remove Question</button>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <button type="button" id="add-question" class="btn btn-primary mb-3">Add New Question</button>
            <button type="submit" class="btn btn-success">Update Post Test</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    let questionIndex = <?php echo e(count($postTest->questions)); ?>;
    
    document.getElementById('add-question').addEventListener('click', function () {
        const container = document.getElementById('questions-container');
        const questionHtml = `
            <div class="question-item mb-4" data-index="${questionIndex}">
                <label for="questions[${questionIndex}][question]" class="form-label">Question</label>
                <input type="text" name="questions[${questionIndex}][question]" class="form-control" required>
                
                <div class="row mt-2">
                    <div class="col">
                        <label>Option A</label>
                        <input type="text" name="questions[${questionIndex}][option_a]" class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Option B</label>
                        <input type="text" name="questions[${questionIndex}][option_b]" class="form-control" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <label>Option C</label>
                        <input type="text" name="questions[${questionIndex}][option_c]" class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Option D</label>
                        <input type="text" name="questions[${questionIndex}][option_d]" class="form-control" required>
                    </div>
                </div>

                <label class="mt-2">Correct Answer</label>
                <select name="questions[${questionIndex}][correct_answer]" class="form-control" required>
                    <option value="option_a">Option A</option>
                    <option value="option_b">Option B</option>
                    <option value="option_c">Option C</option>
                    <option value="option_d">Option D</option>
                </select>

                <button type="button" class="btn btn-danger mt-3 remove-question">Remove Question</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', questionHtml);
        questionIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-question')) {
            e.target.closest('.question-item').remove();
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/admin/postTest/edit.blade.php ENDPATH**/ ?>