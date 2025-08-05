<?php
include 'conn.php';

// Ensure that POST data is being processed
if (isset($_POST['login'])) {
    // // Fetch and sanitize input data
    // $username = trim($_POST['username']);
    // $password = $_POST['password'];

    // Validate input
    // if (empty($username) || empty($password)) {
    //     $alertType = 'error';
    //     $alertMessage = 'Please enter both username and password.';
    // } else {
    //     // Prepare SQL query to prevent SQL injection
    //     $sql = "SELECT * FROM users WHERE username = ?";
    //     $stmt = $conn->prepare($sql);

    //     if ($stmt === false) {
    //         die("Error preparing statement: " . htmlspecialchars($conn->error));
    //     }

    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if ($result->num_rows < 1) {
    //         $alertType = 'error';
    //         $alertMessage = 'Cannot find an account with the username.';
    //     } else {
    //         $row = $result->fetch_assoc();
    //         // Verify password
    //         if (password_verify($password, $row['password'])) {
    //             // Regenerate session ID to prevent session fixation
    //             session_regenerate_id(true);

    //             // Store user data in session variables
    //             $_SESSION['user_id'] = $row['user_id'];
    //             $_SESSION['username'] = $row['username'];
    //             $_SESSION['role'] = $row['role'];
    //             $_SESSION['firstname'] = $row['firstname'];
    //             $_SESSION['lastname'] = $row['lastname'];
    //             $_SESSION['profile_photo'] = $row['profile_photo'];
    //             $_SESSION['department_assignment'] = $row['department_assignment'];
    //             $_SESSION['id_number'] = $row['id_number'];
    //             $_SESSION['email'] = $row['email'];
    //             $_SESSION['gender'] = $row['gender'];
    //             $_SESSION['contact_number'] = $row['contact_number'];
    //             $_SESSION['nickname'] = $row['nickname'];

    //             // Redirect based on role
    //             $redirectUrl = '';
    //             switch ($row['role']) {
    //                 case 'superadmin':
    //                     $redirectUrl = 'superadmin_dashboard.php';
    //                     break;
    //                 case 'admin':
    //                     $redirectUrl = 'admin_dashboard.php';
    //                     break;
    //                 case 'user':
    //                     $redirectUrl = 'user_dashboard.php';
    //                     break;
    //                 default:
    //                     $alertType = 'error';
    //                     $alertMessage = 'Unknown role.';
    //                     break;
    //             }

    //             if (!isset($alertType)) {
    //                 echo '<script>
    //                         document.addEventListener("DOMContentLoaded", function() {
    //                             Toastify({
    //                                 text: "Login successful, redirecting...",
    //                                 duration: 3000,
    //                                 close: true,
    //                                 gravity: "top",
    //                                 position: "right",
    //                                 backgroundColor: "linear-gradient(to right, #1d2e28, #18392b)",
    //                             }).showToast();
    //                             setTimeout(function() {
    //                                 window.location.href = "' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '";
    //                             }, 3000);
    //                         });
    //                       </script>';
    //             }
    //         } else {
    //             $alertType = 'error';
    //             $alertMessage = 'Incorrect password.';
    //         }
    //     }
    //     $stmt->close();
    //     $conn->close();
    // }

    // if (isset($alertType) && $alertType === 'error') {
    //     echo '<script>
    //             document.addEventListener("DOMContentLoaded", function() {
    //                 Toastify({
    //                     text: "' . htmlspecialchars($alertMessage, ENT_QUOTES, 'UTF-8') . '",
    //                     duration: 3000,
    //                     close: true,
    //                     gravity: "top",
    //                     position: "right",
    //                     backgroundColor: "#8B0000",
    //                 }).showToast();
    //             });
    //           </script>';
    // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agent</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
</head>
<body>
<!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card xhire-outline">
              <div class="card-header">
                <h3 class="card-title d-flex" style="font-size:12px; font-weight: bold; color: black; align-items: center;">
                                    <span class="badge" style="width:10px; height: 10px; display: inline-block; border-radius: 100%; background-color: #0f5132;"></span>&nbsp; List of Users
                                </h3>
                                <div class="card-tools" style="margin-right: 2px;">
                                  <a href="superadmin_addusers.php">add new user</a>
                                    <!-- <button class="btn xhire-success btn-sm" style="font-size:12px;" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add User</button> -->
                                </div>
                <br>
              </div>
              <div class="card-body">
               <table id="usersTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Contact No.</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Query to fetch all users
            $sql = "SELECT * FROM users WHERE role != 'superadmin'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                    echo "<td>
                        <div class='btn-group'>
                            <button type='button' class='btn-xs btn btn-default'>View Details</button>
                            <button type='button' class='btn-xs btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#updateModal' onclick='fillUpdateForm(" . htmlspecialchars($row['user_id']) . ", \"" . htmlspecialchars($row['firstname']) . "\", \"" . htmlspecialchars($row['lastname']) . "\", \"" . htmlspecialchars($row['username']) . "\", \"" . htmlspecialchars($row['role']) . "\", \"" . htmlspecialchars($row['contact_number']) . "\")' style='font-size:12px;'>Update Records</a>
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item deleteBtn' data-id='" . htmlspecialchars($row['user_id']) . "' style='font-size:12px;'>Delete Records</a>
                            </div>
                        </div>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found</td></tr>";
            }
        ?>
    </tbody>
</table>
    </div>
  </div>
</div>
<!-- /.col-md-6 -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
 
<?php include 'footer_scripts.php'; ?>
</body>
</html>
<style type="text/css">
.gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
</style>