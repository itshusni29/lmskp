// Ensure that jQuery is loaded before this script
$(function() {
  // Define the showSwal function
  function showSwal(type, id) {
    'use strict';

    // Form for both user and course deletions
    const form = document.getElementById('form-' + id);

    // Check the type of swal alert and ensure form exists
    if ((type === 'delete_users' || type === 'delete_courses') && form) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger me-2'
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); // Submit the form if confirmed
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your action is cancelled!',
            'error'
          );
        }
      });
    } else {
      console.error('Form not found or invalid type');
    }
  }

  function showSwal(type, id) {
    if (type === 'delete_post_test') {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-${id}`).submit();
            }
        });
    }
}


  // Expose showSwal function to the global scope
  window.showSwal = showSwal;
});
