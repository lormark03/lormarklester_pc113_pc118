<?php
session_start();

// Optional: check if user is not logged in
if (!isset($_SESSION['name']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 1rem;
            position: fixed;
            transition: all 0.3s;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            padding-bottom: 1rem;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            width: 100%;
            transition: all 0.3s;
        }

        .sidebar-toggle {
            display: none;
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #343a40;
            color: white;
            border: none;
            font-size: 1.5rem;
            padding: 5px 10px;
            cursor: pointer;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>

  
    <!-- Sidebar -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
<div class="sidebar" id="sidebar">
    <div class="logo">📊 Dashboard</div>
    <a href="dashboard.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg><i class="fas fa-home"></i> Home</a>
    <div class="dropdown">
    <a href="#" class="dropdown-toggle d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#userDropdown" style="padding: 12px 20px;">
    <div class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>
        <span>Users</span>
    </div>
    <i class="fas fa-chevron-down"></i> 
</a>

        <div class="collapse" id="userDropdown">
            <a href="User-List.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>  User List</a>
            <a href="Students-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>   Student List</a>
            <a href="Employee-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /></svg>   Employee List</a>
        </div>
    </div>

    <a href="logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

    <!-- Main content -->
    <div class="content">
        <h2>Welcome to the Dashboard </h2>
         <p id="username"></p>
    </div>

    <!-- Scripts -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }

    document.addEventListener("DOMContentLoaded", function () {
        const name = localStorage.getItem('name');
        const role = localStorage.getItem('role');
        const token = localStorage.getItem('token');

        // Redirect if no token (optional)
        if (!token) {
            console.log('No token found! Redirecting to login...');
            window.location.href = 'login.php';
            return;
        }

        // Show username
    if (name) {
        document.getElementById('username').textContent = `Hi, ${name}!`;
    }


        // Hide Users dropdown for non-admins
        if (role !== 'admin') {
            const userDropdown = document.querySelector('.dropdown');
            if (userDropdown) {
                userDropdown.style.display = 'none';
            }
        }
    });
</script>


</body>
</html>
