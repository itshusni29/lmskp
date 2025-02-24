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
      <li class="nav-item <?php echo e(active_class(['/manager/dashboard'])); ?>">
        <a href="<?php echo e(route('manager.dashboard')); ?>" class="nav-link">
          <i class="link-icon" data-feather="box" style="color: #4CAF50;"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">Training Management</li>

      <!-- Induction Training Section -->
      <li class="nav-item <?php echo e(request()->is('manager/induction-training*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('manager.induction_training')); ?>" class="nav-link">
          <i class="link-icon" data-feather="user-check" style="color: #009688;"></i>
          <span class="link-title">Induction Training</span>
        </a>
      </li>

      <!-- Local Training Center Section -->
      <li class="nav-item <?php echo e(request()->is('manager/local-training-center*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('manager.local_training_center')); ?>" class="nav-link">
          <i class="link-icon" data-feather="map-pin" style="color: #3F51B5;"></i>
          <span class="link-title">Local Training Center</span>
        </a>
      </li>

      <!-- On the Job Training Section -->
      <li class="nav-item <?php echo e(request()->is('manager/on-the-job-training*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('manager.on_the_job_training')); ?>" class="nav-link">
          <i class="link-icon" data-feather="briefcase" style="color: #FF9800;"></i>
          <span class="link-title">On the Job Training</span>
        </a>
      </li>

      <!-- Initial Control Section -->
      <li class="nav-item <?php echo e(request()->is('manager/initial-control*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('manager.initial_control')); ?>" class="nav-link">
          <i class="link-icon" data-feather="toggle-left" style="color: #673AB7;"></i>
          <span class="link-title">Initial Control</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/manager_sidebar.blade.php ENDPATH**/ ?>