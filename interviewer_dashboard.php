<?php 

include 'interviewer_session.php';

// Database credentials
require "conn.php";

?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CDMS | Create Agents</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'admin_navbarsection.php'; ?> 
  
  <?php include 'interviewer_main_sidebar.php'; ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php include 'admin_alert.php'; ?>  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" style="font-size:12px;">Home</a></li>
              <li class="breadcrumb-item active" style="font-size:12px;">Applicants</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card xhire-outline">
              <div class="card-header">
                <h3 class="card-title d-flex" style="font-size:12px; font-weight: bold; color: black; align-items: center;">
                  <span class="badge" style="width:10px; height: 10px; display: inline-block; border-radius: 100%; background-color: #0f5132;"></span>&nbsp; List of Applicants
                </h3>
                <div class="card-tools" style="margin-right: 2px;">
                  
                </div>
              </div>
              
              <div class="card-body">
                <table id="customerOrdersTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Authorize Agent</th>  
                      <th>Firstname</th>
                      <th>Middlenname</th>
                      <th>Lastname</th>
                      <th>Contact Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    // SQL query to fetch data
                    $sql = "SELECT * FROM tblapplicants";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $a_id = $row['id'];
                          $a_agentfull = $row['agentfull'];
                          $a_lastname = $row['lname'];
                          $a_firstname = $row['fname'];
                          $a_middlename = $row['mname'];
                          $a_contactno = $row['contactno'];
                        
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($row["agentfull"], ENT_QUOTES, 'UTF-8')."</td>";
                            echo "<td>".htmlspecialchars($row["fname"], ENT_QUOTES, 'UTF-8')."</td>";
                            echo "<td>".htmlspecialchars($row["mname"], ENT_QUOTES, 'UTF-8')."</td>";
                            echo "<td>".htmlspecialchars($row["lname"], ENT_QUOTES, 'UTF-8')."</td>";
                            echo "<td>".htmlspecialchars($row["contactno"], ENT_QUOTES, 'UTF-8')."</td>";
                            
                            echo "<td>";
                            ?>
                               <a href="applicantprocess1.php?id=<?=$id;?>" class="btn btn-sm xhire-success">
                                          <i class="fas fa-user-plus"></i> Application process
                                        </a>

                            <?php
                                    
                            echo "</td>";
                            echo "</tr>";
                        }
                        //<a class='dropdown-item' data-toggle='modal' data-target='#updateCustomerModal' onclick='fillUpdateForm(".htmlspecialchars($row['agent_id'], ENT_QUOTES, 'UTF-8').", \"".htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8')."\", \"".htmlspecialchars($row['middlename'], ENT_QUOTES, 'UTF-8')."\", \"".htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8')."\", \"".htmlspecialchars($row['contactno'], ENT_QUOTES, 'UTF-8')."\", \"".htmlspecialchars($row['fulladdress'], ENT_QUOTES, 'UTF-8')."\")' style='font-size:12px;'>Update Records</a>
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
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
<?php include 'footer.php'; ?>
</div>
<?php include 'interviewer_profile_modal.php'; ?> 
<?php include 'footer_scripts.php'; ?>
</body>
</html>
<?php include 'admin_agent_modal.php'; ?>
<?php include 'scripts/admin_customer_scripts.php'; ?>