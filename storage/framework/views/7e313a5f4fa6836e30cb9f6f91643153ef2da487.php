<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      YPMI<span>OL</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
        <li class="nav-item <?php echo e(active_class(['/trainer/dashboard'])); ?>">
          <a href="<?php echo e(route('trainer.dashboard')); ?>" class="nav-link">
            <i class="link-icon" data-feather="box" style="color: #4CAF50;"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>

      <li class="nav-item nav-category">Web Apps</li>


      <!-- Trainer Training Modules Section -->
      <li class="nav-item <?php echo e(request()->is('trainer/trainingModules*') ? 'active' : ''); ?>">
          <a class="nav-link" data-bs-toggle="collapse" href="#trainerTrainingModules" role="button" aria-expanded="<?php echo e(request()->is('trainer/trainingModules*') ? 'true' : 'false'); ?>" aria-controls="trainerTrainingModules">
              <i class="link-icon" data-feather="book" style="color: #2196F3;"></i>
              <span class="link-title">Training Modules</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse <?php echo e(request()->is('trainer/trainingModules*') ? 'show' : ''); ?>" id="trainerTrainingModules">
              <ul class="nav sub-menu">
                  <li class="nav-item">
                      <a href="<?php echo e(route('trainer.trainingModules.index')); ?>" class="nav-link <?php echo e(request()->routeIs('trainer.trainingModules.index') ? 'active' : ''); ?>">All Modules</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('trainer.trainingModules.create')); ?>" class="nav-link <?php echo e(request()->routeIs('trainer.trainingModules.create') ? 'active' : ''); ?>">Add Module</a>
                  </li>
              </ul>
          </div>
      </li>


      <!-- Training Classes Section for Trainer -->
      <li class="nav-item <?php echo e(active_class(['trainer/trainingClasses/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#trainingClasses" role="button" aria-expanded="<?php echo e(is_active_route(['trainer/trainingClasses/*'])); ?>" aria-controls="trainingClasses">
          <i class="link-icon" data-feather="book-open" style="color: #8BC34A;"></i>
          <span class="link-title">Training Classes</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['trainer/trainingClasses/*'])); ?>" id="trainingClasses">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('trainer.trainingClasses.index')); ?>" class="nav-link <?php echo e(active_class(['trainer/trainingClasses'])); ?>">All Classes</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('trainer.trainingClasses.create')); ?>" class="nav-link <?php echo e(active_class(['trainer/trainingClasses/create'])); ?>">Add Class</a>
            </li>
          </ul>
        </div>
      </li>


      <!-- Trainer Post Tests Section -->
      <li class="nav-item <?php echo e(active_class(['trainer/postTests/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#trainerPostTests" role="button" aria-expanded="<?php echo e(is_active_route(['trainer/postTests/*'])); ?>" aria-controls="trainerPostTests">
          <i class="link-icon" data-feather="edit" style="color: #FF5722;"></i>
          <span class="link-title">Post Tests</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['trainer/postTests/*'])); ?>" id="trainerPostTests">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('trainer.postTests.index')); ?>" class="nav-link <?php echo e(active_class(['trainer/postTests'])); ?>">All Post Tests</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('trainer.postTests.create')); ?>" class="nav-link <?php echo e(active_class(['trainer/postTests/create'])); ?>">Add Post Test</a>
            </li>
            
          </ul>
        </div>
      </li>

      <li class="nav-item <?php echo e(active_class(['trainer/assessments/*'])); ?>">
          <a class="nav-link" data-bs-toggle="collapse" href="#trainerAssessments" role="button" 
            aria-expanded="<?php echo e(is_active_route(['trainer/assessments/*'])); ?>" 
            aria-controls="trainerAssessments">
            <i class="link-icon" data-feather="edit" style="color: #FF5722;"></i>
            <span class="link-title">Assessments</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse <?php echo e(show_class(['trainer/assessments/*'])); ?>" id="trainerAssessments">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="<?php echo e(route('trainer.assessments.ojt')); ?>" 
                  class="nav-link <?php echo e(active_class(['trainer/assessments/ojt'])); ?>">
                  OJT Participants
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('trainer.assessments.ic')); ?>" 
                  class="nav-link <?php echo e(active_class(['trainer/assessments/ic'])); ?>">
                  IC Participants
                </a>
              </li>
            </ul>
          </div>
        </li>

        
    </ul>
  </div>
</nav>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/trainer_sidebar.blade.php ENDPATH**/ ?>