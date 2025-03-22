<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            height: 100vh;
        }

        /* Sidebar styling */
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

        /* Main content */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            width: 100%;
            transition: all 0.3s;
        }

        /* Sidebar toggle button */
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

        /* Responsive sidebar */
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
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-users"></i> User List</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Welcome to the Dashboard</h2>

        <table class="table">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Address</th>
        <th scope="col">Age</th>
        <th scope="col">Email Address   </th> 
        <th scope="col">Phone</th>
        <th scope="col">Emergency Contact</th>
    </tr>
  </thead>
    <tbody>
        <!-- Students data will be fetched here -->
    </tbody>
</table>

</body>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
    // Fetch students data and populate the table
    $(document).ready(function () {
        fetchStudents();

        function fetchStudents() {
            $.ajax({
                url: 'http://localhost:8000/api/students', // Update with your API URL
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.forEach(student => {
                        tableBody += `
                            <tr>
                                <td>${student.id}</td>
                                <td>${student.first_name}</td>
                                <td>${student.last_name}</td>
                                <td>${student.address}</td>
                                <td>${student.age}</td>
                                <td>${student.email_address}</td>
                                <td>${student.phone_number}</td>
                                <td>${student.emergency_contact}</td>
                            </tr>
                        `;
                    });
                    $('.table tbody').html(tableBody);
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        }
    });
</script>
</html>
