<?php require "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PJDMS | List of Agents</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="dist/img/xchire-logo.png" alt="PJDMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 33px; height: 33px;">
        <span class="brand-text font-weight-light">PJDMS</span>
      </a>

      <div class="navbar-nav ml-auto">
        <a href="index.php" class="nav-link">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
      </div>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Princess Joy Database Management System</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card xhire-outline">
              <div class="card-header">
                <h3 class="card-title d-flex" style="font-size:14px; font-weight: bold; color: black; align-items: center;">
                    <span class="badge" style="width:10px; height: 10px; display: inline-block; border-radius: 100%; background-color: #0f5132;"></span>&nbsp; List of Agents
                </h3>
              </div>
              <div class="card-body">
                <table id="usersTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Agent ID</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Contact No.</th>
                      <th>Address</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        // Query to fetch all users
                        $sql = "SELECT * FROM tblagents ORDER BY lastname";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = htmlspecialchars($row['agent_id']);

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['agent_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['middlename']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['contactno']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['fulladdress']) . "</td>";
                                echo "<td>";
                                ?>
                                        <a href="agent_entry.php?id=<?=$id;?>" class="btn btn-sm xhire-success">
                                          <i class="fas fa-user-plus"></i> Register New Applicant
                                        </a>
                                <?php    
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No agents found</td></tr>";
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <strong>Copyright &copy; 2025 <a href="#">PJDMS</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<?php include 'footer_scripts.php'; ?>
</body>
</html>

<?php include 'scripts/superadmin_users_scripts.php'; ?>