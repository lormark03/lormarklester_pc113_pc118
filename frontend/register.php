<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <style>
    html, body {
      height: 100%;
    }
  </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center">

<div class="container" style="max-width: 500px;">
  <div class="card shadow">
    <div class="card-body">
      <h2 class="mb-4 text-center">User Registration</h2>

      <form id="registerForm" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" name="email" id="email" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required minlength="8" />
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Profile Photo (optional)</label>
          <input type="file" name="photo" id="photo" class="form-control" accept=".jpg,.jpeg,.png,.svg" />
        </div>

        <input type="hidden" name="role" value="user" />

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#registerForm').on('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: 'http://localhost:8000/api/register',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: 'Registration Successful',
            text: 'Redirecting to login page...',
            timer: 2000,
            showConfirmButton: false
          }).then(() => {
            window.location.href = 'login.php';
          });
        },
        error: function (xhr) {
          const errors = xhr.responseJSON?.errors || {};
          const errorList = Object.values(errors).flat().map(msg => `<li>${msg}</li>`).join('');

          Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            html: errorList ? `<ul>${errorList}</ul>` : 'Something went wrong. Please try again.'
          });

          console.error('Registration error:', xhr.responseText);
        }
      });
    });
  });
</script>

</body>
</html>
