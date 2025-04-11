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

<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
<div class="sidebar" id="sidebar">
    <div class="logo">📊 Dashboard</div>
    <a href="dashboard.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg><i class="fas fa-home"></i> Home</a>


    <div class="dropdown">
    <a href="#" class="dropdown-toggle d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#userDropdown" style="padding: 12px 20px;">
    <div class="d-flex align-items-center">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
        <span>User List</span>
    </div>
    <i class="fas fa-chevron-down"></i> 
</a>
        <div class="collapse" id="userDropdown">
            <a href="Students-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>  Student List</a>
            <a href="Employee-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /></svg> Employee List</a>
            </div>
    </div>

   
    <a href="logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="content">
        <h2>User List</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Add User
    </button>

        <table class="table">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
    </tr>
  </thead>
    <tbody>
      
    </tbody>
</table>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addUserForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="addName" class="form-label">Name</label>
            <input type="text" class="form-control" id="addName" required>
          </div>
          <div class="mb-3">
            <label for="addEmail" class="form-label">Email</label>
            <input type="text" class="form-control" id="addEmail" required>
          </div>
          <div class="mb-3">
            <label for="addPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="addPassword" required>
          </div>
          <div class="mb-3">
            <label for="addRole" class="form-label">Role</label>
            <input type="text" class="form-control" id="addRole" required>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUserName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserRole" class="form-label">Role</label>
                        <select class="form-control" id="editUserRole">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>


</body>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        fetchUsers();

        // Fetch users
        function fetchUsers() {
            $.ajax({
                url: 'http://localhost:8000/api/users',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let tableBody = '';
                    data.forEach(user => {
                        tableBody += `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.role}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-user" 
                                        data-id="${user.id}" 
                                        data-name="${user.name}" 
                                        data-email="${user.email}" 
                                        data-role="${user.role}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-user" 
                                        data-id="${user.id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>`;
                    });
                    $('.table tbody').html(tableBody);
                },
                error: function (error) {
                    console.error('Error fetching users:', error);
                    alert('Failed to load users.');
                }
            });
        }

    // Add User Form Submission
    $('#addUserForm').submit(function (event) {
        event.preventDefault();

        const newUser = {
            name: $('#addName').val(),
            email: $('#addEmail').val(),
            password: $('#addPassword').val(),
            role: $('#addRole').val()
        };

        $.ajax({
            url: 'http://localhost:8000/api/users',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(newUser),
            success: function (response) {
                alert('User added successfully!');
                $('#addUserForm')[0].reset();
                var addModal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                addModal.hide();
                setTimeout(() => fetchUsers(), 500);
            },
            error: function (xhr) {
                console.error('Error adding user:', xhr.responseText);
                alert('Failed to add user.');
            }
        });
    });



        // Open Edit Modal
        $(document).on('click', '.edit-user', function () {
            let userId = $(this).data('id');
            let userName = $(this).data('name');
            let userEmail = $(this).data('email');
            let userRole = $(this).data('role');

            $('#editUserId').val(userId);
            $('#editUserName').val(userName);
            $('#editUserEmail').val(userEmail);
            $('#editUserRole').val(userRole);

            // Use Bootstrap 5 modal to show it
            var myModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            myModal.show();
        });

        // Submit Form (Update User)
        $('#editUserForm').submit(function (event) {
            event.preventDefault();

            let userId = $('#editUserId').val();
            let updatedData = {
                name: $('#editUserName').val(),
                email: $('#editUserEmail').val(),
                role: $('#editUserRole').val()
            };

            $.ajax({
                url: `http://localhost:8000/api/users/${userId}`,
                method: 'PUT',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify(updatedData),
                success: function (response) {
                    alert('User updated successfully!');
                    var myModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                    myModal.hide();
                    setTimeout(() => fetchUsers(), 500);
                },
                error: function (xhr) {
                    console.error('Error updating user:', xhr.responseText);
                    alert('Failed to update user.');
                }
            });
        });

        // Delete User
        $(document).on('click', '.delete-user', function () {
            let token = localStorage.getItem('token'); 
            let userId = $(this).data('id');

            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: `http://localhost:8000/api/users/${userId}`,
                    method: 'DELETE',
                    cache: false,
                    headers: { "Authorization": `Bearer ${token}` },
                    success: function () {
                        alert('User deleted successfully!');
                        setTimeout(() => fetchUsers(), 500); 
                    },
                    error: function (xhr) {
                        console.error('Error deleting user:', xhr.responseText);
                        alert('Failed to delete user.');
                    }
                });
            }
        });
    });
</script>



</html>
