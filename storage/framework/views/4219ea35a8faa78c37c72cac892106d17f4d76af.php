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
      
      <!-- Dashboard Navigation Item -->
      <li class="nav-item <?php echo e(request()->is('student/dashboard') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('student.dashboard')); ?>" class="nav-link">
          <i data-feather="box" class="link-icon" style="color: #4CAF50;"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <!-- Post Test Navigation Item -->
      <li class="nav-item <?php echo e(request()->is('student/post-tests*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('student.post_tests.index')); ?>" class="nav-link">
          <i data-feather="edit" class="link-icon" style="color: #FF9800;"></i>
          <span class="link-title">Post Test</span>
        </a>
      </li>

      <!-- Attendance Navigation Item -->
      <li class="nav-item <?php echo e(request()->is('student/attendance*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('student.attendance.index')); ?>" class="nav-link">
          <i data-feather="check-circle" class="link-icon" style="color: #2196F3;"></i>
          <span class="link-title">Attendance</span>
        </a>
      </li>

      <li class="nav-item nav-category">Other Sections</li>
      <!-- Add more navigation items as needed -->
    </ul>
  </div>
</nav>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/student_sidebar.blade.php ENDPATH**/ ?>