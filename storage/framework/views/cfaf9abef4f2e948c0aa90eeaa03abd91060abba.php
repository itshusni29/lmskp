<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Create IC Assessment for <?php echo e($participant->name); ?></h6>

        <form action="<?php echo e(route('trainer.assessments.ic.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>

          <!-- Trainer (Read-only but included in request as hidden input) -->
          <div class="form-group mb-4">
              <label for="trainer">Trainer</label>
              <input type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" readonly>
              <input type="hidden" name="trainer_id" value="<?php echo e(auth()->user()->id); ?>">
          </div>

          <!-- Participant (Read-only but included in request as hidden input) -->
          <div class="form-group mb-4">
              <label for="participant">Participant</label>
              <input type="text" class="form-control" value="<?php echo e($participant->name); ?>" readonly>
              <input type="hidden" name="participant_id" value="<?php echo e($participant->id); ?>">
          </div>

          <!-- LTC (Read-only but included in request as hidden input) -->
          <div class="form-group mb-4">
              <label for="ltc">LTC</label>
              <input type="text" class="form-control" value="<?php echo e(ucfirst($ltc)); ?>" readonly>
              <input type="hidden" name="ltc" value="<?php echo e($ltc); ?>">
          </div>

          <!-- Assessment Subjects -->
          <div class="form-group mb-4">
              <label for="subjects">Assessment Subjects</label>
              <div id="subjects-container">
                  <div class="subject-row" id="subject-row-0">
                      <div class="row mb-3">
                          <div class="col-md-8">
                              <input type="text" name="subjects[0][subject]" class="form-control" placeholder="Subject" required>
                          </div>
                          <div class="col-md-2">
                              <input type="number" name="subjects[0][score]" class="form-control" placeholder="Score" min="1" max="5" required>
                          </div>
                          <div class="col-md-2">
                              <button type="button" class="btn btn-danger remove-subject" onclick="removeSubject(0)">Remove</button>
                          </div>
                      </div>
                  </div>
              </div>
              <button type="button" class="btn btn-secondary mt-2" onclick="addSubject()">Add Subject</button>
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
<script>
  let subjectIndex = 1; // Start index for new subjects

  // Function to add a new subject row
  function addSubject() {
    const subjectContainer = document.getElementById('subjects-container');
    
    const newRow = document.createElement('div');
    newRow.classList.add('subject-row');
    newRow.id = `subject-row-${subjectIndex}`;

    newRow.innerHTML = ` 
      <div class="row mb-3">
        <div class="col-md-8">
          <input type="text" name="subjects[${subjectIndex}][subject]" class="form-control" placeholder="Subject" required>
        </div>
        <div class="col-md-2">
          <input type="number" name="subjects[${subjectIndex}][score]" class="form-control" placeholder="Score" min="1" max="5" required>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-danger remove-subject" onclick="removeSubject(${subjectIndex})">Remove</button>
        </div>
      </div>
    `;

    subjectContainer.appendChild(newRow);
    subjectIndex++;
  }

  // Function to remove a subject row
  function removeSubject(index) {
    const row = document.getElementById(`subject-row-${index}`);
    if (row) {
      row.remove();
    }
  }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.trainer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/trainer/assessments/createic.blade.php ENDPATH**/ ?>