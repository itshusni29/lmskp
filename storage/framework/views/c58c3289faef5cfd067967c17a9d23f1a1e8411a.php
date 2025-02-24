<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Post Test</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create New</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create New Post Test</h6>
        <form action="<?php echo e(route('trainer.postTests.store')); ?>" method="POST" id="post-test-form">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="training_stage_id" class="form-label">Training Stage</label>
                <select name="training_stage_id" id="training_stage_id" class="form-control" required>
                    <?php $__currentLoopData = $trainingStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($stage->id); ?>"><?php echo e($stage->name); ?></option>
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
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control">
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control">
            </div>

            <h3>Questions</h3>
            <div id="questions-container">
                <div class="question-item mb-4" data-index="0">
                    <div class="multiple-choice-options" id="multiple-choice-0">
                        <label for="questions[0][question]" class="form-label mt-2">Question</label>
                        <input type="text" name="questions[0][question]" class="form-control" required>

                        <div class="row mt-2">
                            <div class="col">
                                <label>Option A</label>
                                <input type="text" name="questions[0][option_a]" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Option B</label>
                                <input type="text" name="questions[0][option_b]" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label>Option C</label>
                                <input type="text" name="questions[0][option_c]" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Option D</label>
                                <input type="text" name="questions[0][option_d]" class="form-control" required>
                            </div>
                        </div>
                        <label class="mt-2">Correct Answer</label>
                        <select name="questions[0][correct_answer]" class="form-control" required>
                            <option value="option_a">Option A</option>
                            <option value="option_b">Option B</option>
                            <option value="option_c">Option C</option>
                            <option value="option_d">Option D</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" id="add-question" class="btn btn-secondary mb-3">Add Another Question</button>
            <button type="submit" class="btn btn-primary" id="submit-btn">Create Post Test</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    let questionIndex = 1;

    // Handle Add Question
    document.getElementById('add-question').addEventListener('click', function () {
        const container = document.getElementById('questions-container');
        const questionHtml = `
            <div class="question-item mb-4" data-index="${questionIndex}">
                <div class="multiple-choice-options" id="multiple-choice-${questionIndex}">
                    <label for="questions[${questionIndex}][question]" class="form-label mt-2">Question</label>
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
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', questionHtml);
        questionIndex++;
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/postTest/create.blade.php ENDPATH**/ ?>