<?php include 'admin_session.php'; ?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CDMS | Registration of Applicants</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/applicant_validation.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'admin_navbarsection.php'; ?> 
  <?php include 'admin_profile_modal.php'; ?>
  <?php include 'admin_main_sidebar.php'; ?>  

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
                  <span class="badge" style="width:10px; height: 10px; display: inline-block; border-radius: 100%; background-color: #0f5132;"></span>&nbsp; Registration of new Applicant
                </h3>
                <!-- <div class="card-tools" style="margin-right: 2px;">
                  <button class="btn xhire-success btn-sm" style="font-size:12px;" data-toggle="modal" data-target="#createCustomerModal">
                    <i class="fas fa-plus"></i> Add Client
                  </button>
                </div> -->
              </div>
              
            <!-- Form Container -->
            <div class="card shadow-sm p-4 mb-4" style="background: #f9f9f9; border">
              <form method="post" action="regapplicant.php">
                <!-- Personal Information -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;  ">Personal Information</h5>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px; ">Valid ID:</label>
                      <select name="txtvalidid" id="txtvalidid" class="form-control" style="font-size: 12px;" required>
                        <option value="">-- select here --</option>
                        <option value="Philippine Identification">Philippine Identification</option>
                        <option value="Driver's License">Driver's License</option>
                        <option value="Passport">Passport</option>
                        <option value="SSS UMID Card">SSS UMID Card</option>
                        <option value="Voter's ID">Voter's ID</option>
                        <option value="PRC ID">PRC ID</option>
                        <option value="PhilHealth ID">PhilHealth ID</option>
                        <option value="OWWA ID">OWWA ID</option>
                        <option value="Postal ID">Postal ID</option>
                        <option value="Other">Other</option>
                      </select>
                      <input type="text" name="txtvalidid1" id="txtvalidid1" class="form-control mt-2" style="font-size: 12px;" placeholder="ID Number" required>
                 
                    
                  </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Religion:</label>
                      <select name="txtreligion" id="txtreligion" class="form-control" style="font-size: 12px;" required>
                        <option value="">-- select here --</option>
                        <option value="Religion">Religion</option>
                        <option value="Roman Catholic">Roman Catholic</option>
                        <option value="Buddhist">Buddhist</option>
                        <option value="Islam">Islam</option>
                        <option value="Protestant">Protestant</option>
                        <option value="Aglipayan">Aglipayan</option>
                          <option value="Evangelical">Evangelical</option>
                          <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                        <option value="Other">Other</option>
                      </select>
                      <input type="text" name="txtreligion1" id="txtreligion1" class="form-control mt-2" style="font-size: 12px;" placeholder="Specify Religion" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Lastname:</label>
                      <input type="text" name="txtlast" id="txtlast" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Firstname:</label>
                      <input type="text" name="txtfirst" id="txtfirst" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Middlename:</label>
                      <input type="text" name="txtmiddle" id="txtmiddle" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Birthday:</label>
                      <input type="date" name="txtdob" id="txtdob" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Age:</label>
                      <input type="text" name="txtage" id="txtage" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Place of Birth:</label>
                      <input type="text" name="txtpob" id="txtpob" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Children:</label>
                      <input type="text" name="txtchildren" id="txtchildren" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Civil Status:</label>
                      <select name="txtcivilstatus" id="txtcivilstatus" class="form-control" style="font-size: 12px;" required>
                        <option value="">-- select here --</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Gender:</label>
                      <select name="txtgender" id="txtgender" class="form-control" style="font-size: 12px;" required>
                        <option value="">-- select here --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Contact Number:</label>
                      <input type="text" name="txtcontact" id="txtcontact" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Work Abroad:</label>
                      <input type="text" name="txtworkabroad" id="txtworkabroad" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Years of Experience:</label>
                      <input type="text" name="txtyears" id="txtyears" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                </div>

                <!-- Address -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;">Address</h5>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Complete Address, Street/Purok/Sitio Zone/Block:</label>
                      <input type="text" name="txtaddress" id="txtaddress" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Municipal:</label>
                      <input type="text" name="txtmunicipal" id="txtmunicipal" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Province:</label>
                      <input type="text" name="txtprovince" id="txtprovince" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Barangay:</label>
                      <input type="text" name="txtbarangay" id="txtbarangay" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                </div>

                <!-- Family Information -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;">Family Information</h5>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Father's Last Name:</label>
                      <input type="text" name="txtfathersname" id="txtfathersname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Father's First Name:</label>
                      <input type="text" name="txtfathersfname" id="txtfathersfname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Father's Middle Name:</label>
                      <input type="text" name="txtfathersmname" id="txtfathersmname" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Mother's Last Name:</label>
                      <input type="text" name="txtmothersname" id="txtmothersname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Mother's First Name:</label>
                      <input type="text" name="txtmothersfname" id="txtmothersfname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Mother's Middle Name:</label>
                      <input type="text" name="txtmothersmname" id="txtmothersmname" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Husband's Last Name:</label>
                      <input type="text" name="txthusbandsname" id="txthusbandsname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Husband's First Name:</label>
                      <input type="text" name="txthusbandsfname" id="txthusbandsfname" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Husband's Middle Name:</label>
                      <input type="text" name="txthusbandsmname" id="txthusbandsmname" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                </div>

                <!-- Emergency Contact -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;">Emergency Contact</h5>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">In Case of Emergency:</label>
                      <input type="text" name="txtin_case_of_emergency" id="txtin_case_of_emergency" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Contact Number of Emergency:</label>
                      <input type="text" name="txtcontact_number_emergency" id="txtcontact_number_emergency" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                </div>

                <!-- Work Information -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;">Work Information</h5>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Present Work:</label>
                      <input type="text" name="txtpresent_work" id="txtpresent_work" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Full Address:</label>
                      <input type="text" name="txtfull_address" id="txtfull_address" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" style="font-size:12px;">Insured Person in Insurance:</label>
                      <input type="text" name="txtinsured_person" id="txtinsured_person" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                </div>

                <!-- Passport Information -->
                <div class="mb-4">
                  <h5 class="mb-3" style="font-size:12px; font-weight:bold; background:#0f5132; padding:8px 12px; border-radius:4px; color: white;">Passport Information</h5>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Passport Number:</label>
                      <input type="text" name="txtpassport_number" id="txtpassport_number" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Place of Issue:</label>
                      <input type="text" name="txtplace_of_issue" id="txtplace_of_issue" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Date Issued:</label>
                      <input type="text" name="txtdate_issued" id="txtdate_issued" class="form-control" style="font-size: 12px;" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Date Expired:</label>
                      <input type="text" name="txtdate_expired" id="txtdate_expired" class="form-control" style="font-size: 12px;" required>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label" style="font-size:12px;">Applicant's Status:</label>
                      <select name="txtapplicants_status" id="txtapplicants_status" class="form-control" style="font-size: 12px;" required>
                        <option value="">-- select here --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="text-center mt-4">
                  <input type="submit" name="btnreg" value="register" class="btn btn-success px-5 py-2" style="font-size: 14px; background: #0f5132;"
                  onmouseover="this.style.background='#107747ff'; this.style.color='#fff';"
                  onmouseout="this.style.background='#0f5132'; this.style.color='#fff';">
                </div>
              </form>
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
<?php include 'footer_scripts.php'; ?>
</body>
</html>
<?php include 'admin_customer_modal.php'; ?>
<?php include 'scripts/admin_customer_scripts.php'; ?>
