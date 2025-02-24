<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Training Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Class Details</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        
        <!-- Banner Image (Thumbnail) -->
        <div class="banner-image">
          <img src="<?php echo e($trainingClass->banner_image ? asset('storage/' . $trainingClass->banner_image) : asset('default-image.jpg')); ?>" 
               alt="<?php echo e($trainingClass->name ?: 'Training Class Image'); ?>" class="img-fluid banner-img">
        </div>

        <!-- Training Class Title, Description, and Instructor (Centered) -->
        <div class="training-class-details text-center mt-4">
          <div class="training-class-meta mb-4">
            <p class="title-content"><?php echo e($trainingClass->name); ?></p>
            <p><strong>Instructor:</strong> <?php echo e($trainingClass->instructor->name); ?></p>
            <p><strong>Description:</strong> <?php echo e($trainingClass->description); ?></p>
          </div>
        </div>


        <div class="col-md-8 grid-margin stretch-card mx-auto">
          <!-- Training Module Content -->
          <?php if($trainingModule): ?>
            <div class="training-module-content mt-4">
              <div class="module-content" id="moduleContent">
                <?php echo $trainingModule->content; ?>

              </div>
            </div>
          <?php else: ?>
            <p class="no-content">No module content available for this class.</p>
          <?php endif; ?>
        </div>
        
        <!-- Back Button -->
        <a href="<?php echo e(route('student.trainingStages.show', $trainingClass->trainingStage->id)); ?>" class="btn btn-primary mt-4">Back to Stage</a>
        </div>
    </div>
  </div>
</div>

<!-- Custom Styles for Thumbnail Banner Image -->
<style>
  .banner-image {
    position: relative;
    width: 100%;
    height: 450px; /* Adjust the height of the thumbnail banner */
    overflow: hidden;
    border-radius: 8px;
  }

  .banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the space without stretching */
  }

  .title-content {
    font-size: 36px; /* Increase font size for the title */
    font-weight: bold; /* Make the title bold */
    color: #333; /* Set a dark color for the title */
    margin-bottom: 15px; /* Add space below the title */
  }

  .training-class-meta {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
  }

  .training-class-meta strong {
    font-weight: bold;
  }

  /* Custom Styles for the module content to match TinyMCE's default look */
  .module-content {
    font-family: 'Arial', sans-serif; /* Default font for readability */
    font-size: 18px; /* Adjust font size */
    line-height: 1.6; /* Adjust line height for better readability */
    color: #333; /* Dark text color */
    background-color: #fff; /* White background */
    padding: 20px;
    border-radius: 8px;
    margin-top: 30px;
    text-align: left; /* Left-aligned text */
  }

  .module-content h1, .module-content h2, .module-content h3 {
    font-family: 'Arial', sans-serif;
    color: #2a2a2a;
    margin-bottom: 20px;
  }

  .module-content p {
    margin-bottom: 20px;
    font-size: 18px;
    color: #444;
    line-height: 1.8; /* Increase line height for readability */
  }

  .module-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-top: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .module-content ul, .module-content ol {
    margin-bottom: 20px;
    padding-left: 20px;
  }

  .module-content blockquote {
    font-style: italic;
    border-left: 4px solid #0056b3;
    padding-left: 15px;
    margin: 30px 0;
    color: #777;
    background-color: #f9f9f9;
    font-size: 18px;
  }

  .no-content {
    font-size: 16px;
    color: #888;
    margin-top: 30px;
  }

  .btn-primary {
    font-size: 16px;
    padding: 12px 20px;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>

<script>
  // Initialize TinyMCE on the content
  tinymce.init({
    selector: '#moduleContent',
    menubar: false,
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
    plugins: 'code'
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.student_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\php\lmsforkp\resources\views/pages/student/TrainingClass/show.blade.php ENDPATH**/ ?>