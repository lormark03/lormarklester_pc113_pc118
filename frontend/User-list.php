<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

$userRole = $_SESSION['role'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Dropify -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <style>
    body {
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: white;
      padding-top: 1rem;
      position: fixed;
      height: 100%;
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
      @media print {
  .btn, .sidebar, .sidebar-toggle {
    display: none !important;
  }
  .content {
    margin: 0 !important;
    padding: 0 !important;
  }
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
            <a href="Students-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>   Student List</a>
            <a href="Employee-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /></svg>   Employee List</a>
        </div>
    </div>

    <a href="logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
  <h2>User List</h2>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Add User</button>
    <button class="btn btn-primary btn-print" onclick="window.print()">🖨️ Print</button>
</div>

  <table class="table table-bordered" id="userTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addUserForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>Photo</label><input type="file" class="form-control dropify" id="addPhoto" name="photo" required></div>
          <div class="mb-3"><label>Name</label><input type="text" class="form-control" id="addName" name="name" required></div>
          <div class="mb-3"><label>Email</label><input type="email" class="form-control" id="addEmail" name="email" required></div>
          <div class="mb-3"><label>Password</label><input type="password" class="form-control" id="addPassword" name="password" required></div>
          <div class="mb-3"><label>Role</label>
            <select class="form-control" id="addUserRole" name="role">
              <option value="Admin">admin</option>
              <option value="User">user</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editUserForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editUserId">
          <div class="mb-3">
            <label>Photo</label>
            <input type="file" class="form-control dropify" id="editUserPhoto" name="photo">
          </div>
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" id="editUserName" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="editUserEmail" required>
          </div>
          <div class="mb-3">
            <label>Role</label>
            <select class="form-control" id="editUserRole">
              <option value="Admin">admin</option>
              <option value="User">user</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }



  $(document).ready(function () {
    $('.dropify').dropify();
    fetchUsers();

    function fetchUsers() {
      $.getJSON('http://localhost:8000/api/users', function (data) {
        let rows = '';
        data.forEach(user => {
          rows += `
            <tr>
              <td>${user.id}</td>
              <td>
                <img src="http://localhost:8000/storage/${user.photo}" 
                     alt="User Photo" 
                     style="width: 50px; height: 50px; border-radius: 50%;">
              </td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.role}</td>
              <td>
               <button class="btn btn-primary btn-sm edit-user"
                  data-id="${user.id}"
                  data-photo="${user.photo}"
                  data-name="${user.name}"
                  data-email="${user.email}"
                  data-role="${user.role}">
                  edit
                </button>
                 <button class="btn btn-danger btn-sm delete-user" data-id="${user.id}">Delete</button>
              </td>
            </tr>
          `;
        });
        $('#userTable tbody').html(rows);
      });
    }

    $('#addUserForm').submit(function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      $.ajax({
        url: 'http://localhost:8000/api/users',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success(response) {
          Swal.fire('Success', response.message, 'success');
          $('#addUserModal').modal('hide');
          $('#addUserForm')[0].reset();
          fetchUsers();
        },
        error(xhr) {
          const errors = xhr.responseJSON.errors || {};
          const errorList = Object.values(errors).flat().map(msg => `<li>${msg}</li>`).join('');
          Swal.fire('Error', `<ul>${errorList}</ul>`, 'error');
        }
      });
    });

    
$(document).on('click', '.edit-user', function () {
  $('#editUserId').val($(this).data('id'));
  $('#editUserName').val($(this).data('name'));
  $('#editUserEmail').val($(this).data('email'));
  $('#editUserRole').val($(this).data('role'));

  
  
  const dropify = $('#editUserPhoto').dropify();
  dropify.data('dropify').resetPreview();
  dropify.data('dropify').clearElement();

  $('#editUserModal').modal('show');
});



$('#editUserForm').submit(function (e) {
  e.preventDefault();
  const id = $('#editUserId').val();
  const formData = new FormData();

  formData.append('name', $('#editUserName').val());
  formData.append('email', $('#editUserEmail').val());
  formData.append('role', $('#editUserRole').val());
  formData.append('_method', 'POST'); // Laravel method override

  const photo = $('#editUserPhoto')[0]?.files[0];
  if (photo) {
    formData.append('photo', photo);
  }

  $.ajax({
    url: `http://localhost:8000/api/users/${id}`,
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success(response) {
      Swal.fire('Success', 'User updated!', 'success');
      $('#editUserModal').modal('hide');
      $('#editUserForm')[0].reset();
      fetchUsers();
    },
    error(xhr) {
      const errors = xhr.responseJSON.errors || {};
      const errorList = Object.values(errors).flat().map(msg => `<li>${msg}</li>`).join('');
      Swal.fire('Error', `<ul>${errorList}</ul>`, 'error');
    }
  });
});


    $(document).on('click', '.delete-user', function () {
      const id = $(this).data('id');
      Swal.fire({
        title: 'Are you sure?',
        text: 'This user will be permanently deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then(result => {
        if (result.isConfirmed) {
          $.ajax({
            url: `http://localhost:8000/api/users/${id}`,
            method: 'DELETE',
            success() {
              Swal.fire('Deleted!', 'User has been deleted.', 'success');
              fetchUsers();
            },
            error() {
              Swal.fire('Error', 'Failed to delete user.', 'error');
            }
          });
        }
      });
    });
  });
</script>
</body>
</html>
