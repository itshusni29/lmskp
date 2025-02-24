<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Users</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2"><?php echo e($totalUsers); ?></h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span><?php echo e($userGrowthPercentage); ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="totalUsersStats" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Modules</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2"><?php echo e($totalModules); ?></h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+<?php echo e($moduleGrowthPercentage); ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="totalModulesStats" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Classes</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2"><?php echo e($totalClasses); ?></h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+<?php echo e($classGrowthPercentage); ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <div id="totalClassesStats" class="mt-3 mt-md-0 mt-xl-3"></div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="row">
  <!-- User Growth by Month (Bar Chart) -->
  <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Monthly new Employee</h6>
        </div>
        <p class="text-muted"></p>
        <div id="userStats" style="height: 350px;"></div>
      </div> 
    </div>
  </div>

  <!-- User Distribution by LTC Chart (Pie Chart) -->
  <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">User Distribution by LTC</h6>
        </div>
        <div id="usersltc" style="height: 300px;"></div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/apexcharts/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/admin.js')); ?>"></script>
  <script>
    window.dashboardData = {
        userGrowthData: <?php echo json_encode($userGrowthData, 15, 512) ?>,
        userGrowthMonths: <?php echo json_encode($userGrowthMonths, 15, 512) ?>,
        ltcCounts: <?php echo json_encode($ltcCounts, 15, 512) ?>,
        ltcCategories: <?php echo json_encode($ltcCategories, 15, 512) ?>,
        totalUsersDates: <?php echo json_encode($totalUsersDates, 15, 512) ?>,
        totalUsersData: <?php echo json_encode($totalUsersData, 15, 512) ?>,
        totalModulesDates: <?php echo json_encode($totalModulesDates, 15, 512) ?>,
        totalModulesData: <?php echo json_encode($totalModulesData, 15, 512) ?>,
        totalClassesDates: <?php echo json_encode($totalClassesDates, 15, 512) ?>,  // Add this line
        totalClassesData: <?php echo json_encode($totalClassesData, 15, 512) ?>   // Add this line
    };
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/dashboard.blade.php ENDPATH**/ ?>