
<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['name']) && isset($_SESSION['role'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow-sm" style="width: 22rem;">
        <h3 class="text-center mb-3">Login</h3>
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>

    <!-- Login Script -->
  <script>
    $(document).ready(function () {
        $('#loginForm').submit(function (e) {
            e.preventDefault();

            const formData = {
                email: $('#email').val(),
                password: $('#password').val()
            };

            $.ajax({
                url: 'http://localhost:8000/api/login',
                method: 'POST',
                data: formData,
                success: function (response) {
                    localStorage.setItem('token', response.token);
                    localStorage.setItem('name', response.user.name);
                    localStorage.setItem('role', response.user.role);

                    const name = encodeURIComponent(response.user.name);
                    const role = encodeURIComponent(response.user.role);

                    // ✅ Only this redirect is needed
                    window.location.href = `set-session.php?name=${name}&role=${role}`;
                },
                error: function (xhr) {
                    alert('Login failed: ' + (xhr.responseJSON.message || 'Invalid credentials'));
                }
            });
        });
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
