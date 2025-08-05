<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CDMS | Adding of Users</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'superadmin_navbar_section.php'; ?> 
<?php include 'superadmin_main_sidebar.php'; ?> 
<?php include 'superadmin_profile_modal.php'; ?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" style="font-size:12px;">Home</a></li>
              <li class="breadcrumb-item active" style="font-size:12px;">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card xhire-outline">
              <div class="card-header">
                <h3 class="card-title d-flex" style="font-size:12px; font-weight: bold; color: black; align-items: center;">
                    <span class="badge" style="width:10px; height: 10px; display: inline-block; border-radius: 100%; background-color: #0f5132;"></span>&nbsp; User Registration
                </h3>
                               
                <br>
              </div>
              <div class="card-body">
               
                <form action="userreg.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_firstname" style="font-size:12px;">First Name</label>
                                <input type="text" class="form-control form-control-sm" id="update_firstname" name="firstname" style="font-size:12px; text-transform: capitalize;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_lastname" style="font-size:12px;">Last Name</label>
                                <input type="text" class="form-control form-control-sm" id="update_lastname" name="lastname" style="font-size:12px;" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_username" style="font-size:12px;">Username</label>
                                <input type="text" class="form-control form-control-sm" id="update_username" name="username" style="font-size:12px;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_password" style="font-size:12px;">Password</label>
                                <input type="password" class="form-control form-control-sm" id="update_password" name="password" style="font-size:12px;" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_role" style="font-size:12px;">Role</label>
                                <select class="form-control form-control-sm" id="update_role" name="role" style="font-size:12px;" required>
                                    <option value="admin">Accountant</option>
                                    <option value="interviewer">Interviewer</option>
                                    <option value="process officer">Process Officer</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create_photo" style="font-size:12px;">Profile Photo</label>
                                <input type="file" class="form-control form-control-sm" id="create_photo" name="profile_photo" style="font-size:12px;" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_contactno" style="font-size:12px;">Contact Number</label>
                                <input type="text" class="form-control form-control-sm" id="update_contactno" name="contactno" style="font-size:12px;" required>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="btnreg" value="Register User" class="btn xhire-info btn-sm" style="font-size:12px;"><i class="fas fa-pen-nib"></i> 
                </form>

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
<?php include 'footer.php'; ?>
</div>
<?php include 'footer_scripts.php'; ?>
</body>
</html>
<?php include 'superadmin_user_modal.php'; ?>
<?php include 'scripts/superadmin_users_scripts.php'; ?>