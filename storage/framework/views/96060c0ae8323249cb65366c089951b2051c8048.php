<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="profile-initial wd-30 ht-30 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: #007bff;">
            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

          </div>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <div class="profile-initial wd-80 ht-80 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: #007bff; font-size: 2rem;">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

              </div>
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder"><?php echo e(auth()->user()->name); ?></p>
              <p class="tx-12 text-muted"><?php echo e(auth()->user()->email); ?></p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <a href="<?php echo e(route('profile.show')); ?>" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
              </form>
              <a href="#" class="text-body ms-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
<?php /**PATH C:\dev\php\lmsforkp\resources\views/layout/header.blade.php ENDPATH**/ ?>