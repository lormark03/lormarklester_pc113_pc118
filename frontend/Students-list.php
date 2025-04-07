<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
        <span>Student List</span>
    </div>
    <i class="fas fa-chevron-down"></i> 
</a>

        <div class="collapse" id="userDropdown">
            <a href="User-List.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>  User List</a>
            <a href="Employee-list.php" class="dropdown-item"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /></svg>   Employee List</a>
        </div>
    </div>

    <a href="logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
    <h2>Student List</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        + Add Student
    </button>
    
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Address</th>
                <th>Age</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addStudentForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="addFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="addFirstName" required>
          </div>
          <div class="mb-3">
            <label for="addLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="addLastName" required>
          </div>
          <div class="mb-3">
            <label for="addAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="addAddress" required>
          </div>
          <div class="mb-3">
            <label for="addAge" class="form-label">Age</label>
            <input type="number" class="form-control" id="addAge" required>
          </div>
          <div class="mb-3">
            <label for="addEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="addEmail" required>
          </div>
          <div class="mb-3">
            <label for="addPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="addPhone" required>
          </div>
          <div class="mb-3">
            <label for="addEmergencyContact" class="form-label">Emergency Contact</label>
            <input type="text" class="form-control" id="addEmergencyContact" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editStudentForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editStudentId">
          <div class="mb-3">
            <label for="editFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="editFirstName" required>
          </div>
          <div class="mb-3">
            <label for="editLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="editLastName" required>
          </div>
          <div class="mb-3">
            <label for="editAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="editAddress" required>
          </div>
          <div class="mb-3">
            <label for="editAge" class="form-label">Age</label>
            <input type="number" class="form-control" id="editAge" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" required>
          </div>
          <div class="mb-3">
            <label for="editPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="editPhone" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("open");
    }

    $(document).ready(function () {
        fetchStudents();

        function fetchStudents() {
            $.ajax({
                url: 'http://localhost:8000/api/students',
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
                                <td>
                                    <button class="btn btn-primary btn-sm edit-student"
                                        data-id="${student.id}"
                                        data-firstname="${student.first_name}"
                                        data-lastname="${student.last_name}"
                                        data-address="${student.address}"
                                        data-age="${student.age}"
                                        data-email="${student.email_address}"
                                        data-phone="${student.phone_number}">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-student" data-id="${student.id}">Delete</button>
                                </td>
                            </tr>`;
                    });
                    $('.table tbody').html(tableBody);
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        }

        // Add new student
        $('#addStudentForm').submit(function (event) {
    event.preventDefault();

    const newStudent = {
        first_name: $('#addFirstName').val(),
        last_name: $('#addLastName').val(),
        address: $('#addAddress').val(),
        age: $('#addAge').val(),
        email_address: $('#addEmail').val(),
        phone_number: $('#addPhone').val(),
        emergency_contact: $('#addEmergencyContact').val() || null  
    };

    $.ajax({
        url: 'http://localhost:8000/api/students',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(newStudent),
        success: function () {
            alert('Student added successfully!');
            const modalEl = document.getElementById('addStudentModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();
            $('#addStudentForm')[0].reset();
            fetchStudents();
        },
        error: function (error) {
            console.error('Error adding student:', error);
        }
    });
});


        // Show edit modal
        $(document).on('click', '.edit-student', function () {
            $('#editStudentId').val($(this).data('id'));
            $('#editFirstName').val($(this).data('firstname'));
            $('#editLastName').val($(this).data('lastname'));
            $('#editAddress').val($(this).data('address'));
            $('#editAge').val($(this).data('age'));
            $('#editEmail').val($(this).data('email'));
            $('#editPhone').val($(this).data('phone'));

            const modal = new bootstrap.Modal(document.getElementById('editStudentModal'));
            modal.show();
        });

        // Update student
        $('#editStudentForm').submit(function (event) {
            event.preventDefault();
            const studentId = $('#editStudentId').val();
            const updatedData = {
                first_name: $('#editFirstName').val(),
                last_name: $('#editLastName').val(),
                address: $('#editAddress').val(),
                age: $('#editAge').val(),
                email_address: $('#editEmail').val(),
                phone_number: $('#editPhone').val()
            };

            $.ajax({
                url: `http://localhost:8000/api/students/${studentId}`,
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(updatedData),
                success: function () {
                    alert('Student updated successfully!');
                    const modalEl = document.getElementById('editStudentModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();
                    fetchStudents();
                },
                error: function (error) {
                    console.error('Error updating student:', error);
                }
            });
        });

        // Delete student
        $(document).on('click', '.delete-student', function () {
            const studentId = $(this).data('id');
            if (confirm('Are you sure you want to delete this student?')) {
                $.ajax({
                    url: `http://localhost:8000/api/students/${studentId}`,
                    method: 'DELETE',
                    success: function () {
                        alert('Student deleted successfully!');
                        fetchStudents();
                    },
                    error: function (error) {
                        console.error('Error deleting student:', error);
                    }
                });
            }
        });
    });
</script>

</body>
</html>