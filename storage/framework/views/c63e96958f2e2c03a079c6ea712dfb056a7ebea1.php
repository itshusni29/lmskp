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
      <li class="nav-item <?php echo e(active_class(['/'])); ?>">
        <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link">
          <i class="link-icon" data-feather="box" style="color: #4CAF50;"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Web Apps</li>

      <!-- Users Section -->
      <li class="nav-item <?php echo e(active_class(['users*'])); ?>">
          <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="<?php echo e(is_active_route(['users*'])); ?>" aria-controls="users">
              <i class="link-icon" data-feather="users" style="color: #FF9800;"></i>
              <span class="link-title">Users</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse <?php echo e(show_class(['users*'])); ?>" id="users">
              <ul class="nav sub-menu">
                  <li class="nav-item">
                      <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(active_class(['users'])); ?>">All Users</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('users.create')); ?>" class="nav-link <?php echo e(active_class(['users/create'])); ?>">Add User</a>
                  </li>
              </ul>
          </div>
      </li>

      <!-- Training Modules Section -->
      <li class="nav-item <?php echo e(active_class(['trainingModules/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#trainingModules" role="button" aria-expanded="<?php echo e(is_active_route(['trainingModules/*'])); ?>" aria-controls="trainingModules">
          <i class="link-icon" data-feather="book" style="color: #2196F3;"></i>
          <span class="link-title">Modules</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['trainingModules/*'])); ?>" id="trainingModules">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('trainingModules.index')); ?>" class="nav-link <?php echo e(active_class(['trainingModules'])); ?>">All Modules</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('trainingModules.create')); ?>" class="nav-link <?php echo e(active_class(['trainingModules/create'])); ?>">Add Module</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Training Classes Section -->
      <li class="nav-item <?php echo e(active_class(['trainingClasses/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#trainingClasses" role="button" aria-expanded="<?php echo e(is_active_route(['trainingClasses/*'])); ?>" aria-controls="trainingClasses">
          <i class="link-icon" data-feather="book-open" style="color: #8BC34A;"></i>
          <span class="link-title">Classes</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['trainingClasses/*'])); ?>" id="trainingClasses">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('trainingClasses.index')); ?>" class="nav-link <?php echo e(active_class(['trainingClasses'])); ?>">All Classes</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('trainingClasses.create')); ?>" class="nav-link <?php echo e(active_class(['trainingClasses/create'])); ?>">Add Class</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Post Tests Section -->
      <li class="nav-item <?php echo e(active_class(['post_tests/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#postTests" role="button" aria-expanded="<?php echo e(is_active_route(['post_tests/*'])); ?>" aria-controls="postTests">
          <i class="link-icon" data-feather="edit" style="color: #FF5722;"></i>
          <span class="link-title">Post Tests</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['post_tests/*'])); ?>" id="postTests">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('post_tests.index')); ?>" class="nav-link <?php echo e(active_class(['post_tests'])); ?>">All Post Tests</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('post_tests.create')); ?>" class="nav-link <?php echo e(active_class(['post_tests/create'])); ?>">Add Post Test</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Training Stages Section -->
      <li class="nav-item <?php echo e(active_class(['training_stages/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#trainingStages" role="button" aria-expanded="<?php echo e(is_active_route(['training_stages/*'])); ?>" aria-controls="trainingStages">
          <i class="link-icon" data-feather="layers" style="color: #FFC107;"></i>
          <span class="link-title">Stages</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['training_stages/*'])); ?>" id="trainingStages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('training_stages.index')); ?>" class="nav-link <?php echo e(active_class(['training_stages'])); ?>">All Stages</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('training_stages.create')); ?>" class="nav-link <?php echo e(active_class(['training_stages/create'])); ?>">Add Stage</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Attendance Section -->
      <li class="nav-item <?php echo e(active_class(['attendance/*'])); ?>">
        <a class="nav-link" data-bs-toggle="collapse" href="#attendance" role="button" aria-expanded="<?php echo e(is_active_route(['attendance/*'])); ?>" aria-controls="attendance">
          <i class="link-icon" data-feather="check-circle" style="color: #FFC107;"></i>
          <span class="link-title">Attendance</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['attendance/*'])); ?>" id="attendance">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(route('attendanceSchedules.index')); ?>" class="nav-link <?php echo e(active_class(['attendance'])); ?>">All Attendance</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('attendanceSchedules.create')); ?>" class="nav-link <?php echo e(active_class(['attendance/create'])); ?>">Add Attendance</a>
            </li>
          </ul>
        </div>
      </li>
      <?php if(auth()->user()->occupation !== 'spv'): ?>
      <!-- Recap Section -->
      <li class="nav-item <?php echo e(active_class(['rekap/*'])); ?>">
          <a class="nav-link" data-bs-toggle="collapse" href="#rekap" role="button" aria-expanded="<?php echo e(is_active_route(['rekap/*'])); ?>" aria-controls="rekap">
              <i class="link-icon" data-feather="check-circle" style="color: #FFC107;"></i>
              <span class="link-title">Recap</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse <?php echo e(show_class(['rekap/*'])); ?>" id="rekap">
              <ul class="nav sub-menu">
                  <!-- New Routes for Recap -->
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.rekap.induction_training')); ?>" class="nav-link <?php echo e(active_class(['rekap/induction-training'])); ?>">Induction Training</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.rekap.local_training_center')); ?>" class="nav-link <?php echo e(active_class(['rekap/local-training-center'])); ?>">Local Training Center</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.rekap.on_the_job_training')); ?>" class="nav-link <?php echo e(active_class(['rekap/on-the-job-training'])); ?>">On-the-Job Training</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.rekap.initial_control')); ?>" class="nav-link <?php echo e(active_class(['rekap/initial-control'])); ?>">Initial Control</a>
                  </li>
              </ul>
          </div>
      </li>
      <?php endif; ?>

      <?php if(auth()->user()->occupation === 'spv'): ?>
      <!-- Recap Section -->
      <li class="nav-item <?php echo e(active_class(['recap/*'])); ?>">
          <a class="nav-link" data-bs-toggle="collapse" href="#recap" role="button" aria-expanded="<?php echo e(is_active_route(['recap/*'])); ?>" aria-controls="recap">
              <i class="link-icon" data-feather="check-circle" style="color: #FFC107;"></i>
              <span class="link-title">Recap</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse <?php echo e(show_class(['recap/*'])); ?>" id="recap">
              <ul class="nav sub-menu">
                  <!-- New SPV Routes -->
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.spv.induction_training')); ?>" class="nav-link <?php echo e(active_class(['spv/induction-training'])); ?>">Induction Training</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.spv.local_training_center')); ?>" class="nav-link <?php echo e(active_class(['spv/local-training-center'])); ?>">Local Training Center</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.spv.on_the_job_training')); ?>" class="nav-link <?php echo e(active_class(['spv/on-the-job-training'])); ?>">On-the-Job Training</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('admin.spv.initial_control')); ?>" class="nav-link <?php echo e(active_class(['spv/initial-control'])); ?>">Initial Control</a>
                  </li>
              </ul>
          </div>
      </li>
     <?php endif; ?>
    </ul>
  </div>
</nav>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>