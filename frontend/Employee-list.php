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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
   
   
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
        </div>
    </div>

    <a href="logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>


<div class="content">
  <h2>Employee List</h2>
   <div class="d-flex justify-content-between align-items-center mb-3">
 <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">+ Add Employee</button>
    <button class="btn btn-primary btn-print" onclick="window.print()">🖨️ Print</button>
</div>
  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Photo</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Address</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="addEmployeeForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="file" class="form-control dropify mb-3" name="photo" required>
          <input type="text" class="form-control mb-3" name="first_name" placeholder="First Name" required>
          <input type="text" class="form-control mb-3" name="last_name" placeholder="Last Name" required>
          <input type="text" class="form-control mb-3" name="address" placeholder="Address" required>
          <input type="number" class="form-control mb-3" name="age" placeholder="Age" required>
          <input type="email" class="form-control mb-3" name="email_address" placeholder="Email" required>
          <input type="text" class="form-control mb-3" name="phone_number" placeholder="Phone" required>
          <input type="text" class="form-control mb-3" name="emergency_contact" placeholder="Emergency Contact">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editEmployeeForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editEmployeeId" name="id">
          <input type="file" class="form-control dropify mb-3" id="editPhoto" name="photo" data-default-file="" />
          <input type="text" class="form-control mb-3" id="editFirstName" name="first_name" placeholder="First Name" required>
          <input type="text" class="form-control mb-3" id="editLastName" name="last_name" placeholder="Last Name" required>
          <input type="text" class="form-control mb-3" id="editAddress" name="address" placeholder="Address" required>
          <input type="number" class="form-control mb-3" id="editAge" name="age" placeholder="Age" required>
          <input type="email" class="form-control mb-3" id="editEmail" name="email_address" placeholder="Email" required>
          <input type="text" class="form-control mb-3" id="editPhone" name="phone_number" placeholder="Phone" required>
          <input type="text" class="form-control mb-3" id="editEmergencyContact" name="emergency_contact" placeholder="Emergency Contact">
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
    document.getElementById("sidebar").classList.toggle("open");
  }

  $(document).ready(function () {
    $('.dropify').dropify();
    fetchEmployees();

    function fetchEmployees() {
      $.get('http://localhost:8000/api/employees', function (data) {
        let rows = '';
        data.forEach(employee => {
          rows += `
            <tr>
              <td>${employee.id}</td>
              <td><img src="http://localhost:8000/storage/${employee.photo}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
              <td>${employee.first_name}</td>
              <td>${employee.last_name}</td>
              <td>${employee.address}</td>
              <td>${employee.email_address}</td>
              <td>
                <button class="btn btn-sm btn-primary edit-employee" 
                  data-id="${employee.id}"
                  data-first_name="${employee.first_name}"
                  data-last_name="${employee.last_name}"
                  data-address="${employee.address}"
                  data-age="${employee.age}"
                  data-email_address="${employee.email_address}"
                  data-phone_number="${employee.phone_number}"
                  data-emergency_contact="${employee.emergency_contact}">
                  Edit
                </button>
                <button class="btn btn-sm btn-danger delete-employee" data-id="${employee.id}">Delete</button>
              </td>
            </tr>`;
        });
        $('tbody').html(rows);
      });
    }

    $('#addEmployeeForm').submit(function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  $.ajax({
    url: 'http://localhost:8000/api/employees',
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success(response) {
      Swal.fire('Success', response.message, 'success');
      $('#addEmployeeModal').modal('hide');
      $('#addEmployeeForm')[0].reset();
      $('.dropify').dropify(); // Reinitialize Dropify after reset
      fetchEmployees(); // Make sure you have this function defined
    },
    error(xhr) {
      const errors = xhr.responseJSON?.errors || {};
      const errorList = Object.values(errors).flat().map(msg => `<li>${msg}</li>`).join('');
      Swal.fire('Error', `<ul>${errorList}</ul>`, 'error');
    }
  });
});


    $(document).on('click', '.edit-employee', function () {
      $('#editEmployeeId').val($(this).data('id'));
      $('#editFirstName').val($(this).data('first_name'));
      $('#editLastName').val($(this).data('last_name'));
      $('#editAddress').val($(this).data('address'));
      $('#editAge').val($(this).data('age'));
      $('#editEmail').val($(this).data('email_address'));
      $('#editPhone').val($(this).data('phone_number'));
      $('#editEmergencyContact').val($(this).data('emergency_contact'));

      const photoFile = $(this).closest('tr').find('img').attr('src');
      let drEvent = $('#editPhoto').dropify({ defaultFile: photoFile });

      drEvent = drEvent.data('dropify');
      drEvent.resetPreview();
      drEvent.clearElement();
      drEvent.settings.defaultFile = photoFile;
      drEvent.destroy();
      drEvent.init();

      $('#editEmployeeModal').modal('show');
    });

    $('#editEmployeeForm').submit(function (e) {
      e.preventDefault();
      const id = $('#editEmployeeId').val();
      const formData = new FormData();

      formData.append('first_name', $('#editFirstName').val());
      formData.append('last_name', $('#editLastName').val());
      formData.append('address', $('#editAddress').val());
      formData.append('age', $('#editAge').val());
      formData.append('email_address', $('#editEmail').val());
      formData.append('phone_number', $('#editPhone').val());
      formData.append('emergency_contact', $('#editEmergencyContact').val());
      formData.append('_method', 'POST');

      const photo = $('#editPhoto')[0]?.files[0];
      if (photo) {
        formData.append('photo', photo);
      }

      $.ajax({
        url: `http://localhost:8000/api/employees/${id}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
          Swal.fire('Updated!', 'Employee record has been updated.', 'success');
          $('#editEmployeeModal').modal('hide');
          fetchEmployees();
        },
        error(xhr) {
          const errors = xhr.responseJSON.errors || {};
          const errorList = Object.values(errors).flat().map(msg => `<li>${msg}</li>`).join('');
          Swal.fire('Error', `<ul>${errorList}</ul>`, 'error');
        }
      });
    });

    $(document).on('click', '.delete-employee', function () {
      const id = $(this).data('id');
      if (confirm('Are you sure you want to delete this employee?')) {
        $.ajax({
          url: `http://localhost:8000/api/employees/${id}`,
          method: 'DELETE',
          success: function () {
            fetchEmployees();
          }
        });
      }
    });
  });
</script>

</body>
</html>
