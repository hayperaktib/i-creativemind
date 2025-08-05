<?php
include 'conn.php';

//if(isset($_GET['id'])){
  $sql1 = "select * from tblagents where agent_id='" . $_GET['id'] . "'";
  //$sql1 = "select * from tblagents where agent_id='3'";
  $rs1 = $conn->query($sql1) or die('cannOt proceed'. $rs1->connect_error);
  $row = $rs1->fetch_array();
  $first = strtoupper($row['firstname']);
  $middle = strtoupper(substr($row['middlename'],0,1)) . ".";
  $last = strtoupper($row['lastname']);
  $full = $first . " " . $middle . " " . $last;
if(isset($_POST['btnreg'])){

// $sql = "insert into tblapplicants(validid,validid_no,fname,mname,lname,ext, regdate,agent_id) values('" . $_POST['txtvalidid'] . "','" . $_POST['txtvalidid1'] . "','" . $_POST['txtfirst'] . "','" . $_POST['txtmiddle'] . "','" . $_POST['txtlast'] . "','" . $_POST['txtext'] . "','" . $_POST['txtregdate'] . "','" . $_POST['txtid'] . "')";
      $sql = "insert into tblapplicants(validid,validid_no,fname,mname,lname,ext,dob,age,contactno,desiredcountry,passportno,exabroad,whichcountry,daterange,regdate,agent_id,agentfull) 
              values('" . $_POST['txtvalidid'] . "','" . $_POST['txtvalidid1'] . "','" . $_POST['txtfirst'] . "','" . $_POST['txtmiddle'] . "','" . $_POST['txtlast'] . "','" . $_POST['txtext'] . "','" . $_POST['txtdob'] . "','" . $_POST['txtage'] . "','" . $_POST['txtcn'] . "','" . $_POST['txtcountry'] . "','" . $_POST['txtpassport'] . "','" . $_POST['xabroad'] . "','" . $_POST['txtabroadw'] . "','" . $_POST['txtabroadd'] . "','" . $_POST['txtregdate'] . "','" . $_POST['txtid'] . "','" . $_POST['txtagentfull'] . "')";


  
      $rs = $conn->query($sql) or die('There is a problem in the query process! '.$conn->error);

        // $sql = "insert into tblapplicants(validid,validid_no,fname,mname,lname,ext,dob,age,contactno,desiredcountry,passport,passportno,exabroad,whichcountry,daterange,regdate,agent_id) 
        //         values('" . $_POST['txtvalidid'] . "','" . $_POST['txtvalidid1'] . "','" . $_POST['txtfirst'] . "','" . $_POST['txtmiddle'] . "','" . $_POST['txtlast'] . "','" . $_POST['txtext'] . "','" . $_POST['txtdob'] . "','" . $_POST['txtage'] . "','" . $_POST['txtcn'] . "','" . $_POST['txtcountry'] . "','1','" . $_POST['txtpassport'] . "','1','" . $_POST['txtabroadw'] . "','" . $_POST['txtabroadd'] . "','" . $_POST['txtregdate'] . "','" . $_POST['txtid'] . "')";

       
        // echo "saved!";
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Success!',
                    text: 'New applicant successfully registered!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0f5132'
                });
            </script>
        ";
        //header('location:agent_entry.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PJDMS | Register New Applicant</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
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
        <a href="agent_lst.php" class="nav-link">
          <i class="fas fa-arrow-left"></i> Back to Agent List
        </a>
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
            <h1 class="m-0">Register New Applicant</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="card xhire-outline">
              <div class="card-header">
                <h3 class="card-title d-flex align-items-center" style="font-size:16px; font-weight: bold; color: black;">
                    <span class="badge" style="width:12px; height: 12px; display: inline-block; border-radius: 100%; background-color: #0f5132; margin-right: 8px;"></span>
                    Agent Registration Portal
                </h3>
              </div>
              <div class="card-body p-4">
                <!-- Agent Information Display -->
                <div class="alert alert-info" style="background-color: #e8f4fd; border: 1px solid #0f5132; border-left: 4px solid #0f5132;">
                  <div class="row align-items-center">
                    <div class="col-md-2">
                      <i class="fas fa-user-tie fa-2x text-primary"></i>
                    </div>
                    <div class="col-md-10">
                      <h5 class="mb-1" style="color: #0f5132; font-weight: bold;">Authorized Agent</h5>
                      <p class="mb-0" style="font-size: 16px; font-weight: 600; color: #333;">
                        <?php echo $full; ?>
                        <input type="hidden" name="txtagentfull" id="txtagentfull" value="<?=$full;?>">
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Registration Form -->
                <form method="post" action="agent_entry.php?id=<?=$_GET['id']?>" class="needs-validation" novalidate>
                  <input type="hidden" name="txtid" id="txtid" value="<?=$_GET['id']?>">
                  <input type="hidden" value="<?=date('m/d/Y');?>" name="txtregdate" id="txtregdate">
                  
                  <!-- Personal Information Section -->
                  <div class="card mb-4" style="border-left: 4px solid #0f5132;">
                    <div class="card-header" style="background-color: #f8f9fa;">
                      <h5 class="mb-0" style="color: #0f5132;">
                        <i class="fas fa-user mr-2"></i>Personal Information
                      </h5>
                    </div>
                    <div class="card-body">
                      <!-- Valid ID Row -->
                      <div class="row mb-3">
                        <div class="col-md-4">
                          <label class="form-label font-weight-bold" for="txtvalidid">Valid ID Type <span class="text-danger">*</span></label>
                          <select name="txtvalidid" id="txtvalidid" class="form-control" onchange="ifPassport()" required>
                              <option value="">-- Select ID Type --</option>
                              <option value="Philippine Identification">Philippine Identification</option>
                              <option value="Driver's License">Driver's License</option>
                              <option value="Passport">Passport</option>
                              <option value="SSS UMID Card">SSS UMID Card</option>
                              <option value="Voter's ID">Voter's ID</option>
                              <option value="PRC ID">PRC ID</option>
                              <option value="PhilHealth ID">PhilHealth ID</option>
                              <option value="Barangay ID">Barangay ID</option>
                              <option value="Postal ID">Postal ID</option>
                              <option value="OWWA ID">OWWA ID</option>
                          </select>
                        </div>
                        <div class="col-md-8">
                          <label class="form-label font-weight-bold" for="txtvalidid1">ID Number <span class="text-danger">*</span></label>
                          <input type="text" name="txtvalidid1" id="txtvalidid1" class="form-control" placeholder="Enter Valid ID Number" onblur="pasPassportid()" required>
                          <span id="vid"></span>
                        </div>
                      </div>

                      <!-- Name Row -->
                      <div class="row mb-3">
                        <div class="col-md-3">
                          <label class="form-label font-weight-bold" for="txtfirst">First Name <span class="text-danger">*</span></label>
                          <input type="text" name="txtfirst" id="txtfirst" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label font-weight-bold" for="txtmiddle">Middle Name <span class="text-danger">*</span></label>
                          <input type="text" name="txtmiddle" id="txtmiddle" class="form-control" placeholder="Middle Name" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label font-weight-bold" for="txtlast">Last Name <span class="text-danger">*</span></label>
                          <input type="text" name="txtlast" id="txtlast" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label font-weight-bold" for="txtext">Extension</label>
                          <select name="txtext" id="txtext" class="form-control">
                              <option value="">-- Extension --</option>
                              <option value="Jr.">Jr.</option>
                              <option value="Sr.">Sr.</option>
                              <option value="I">I</option>
                              <option value="II">II</option>
                              <option value="III">III</option>
                              <option value="IV">IV</option>
                              <option value="V">V</option>
                          </select>
                        </div>
                      </div>

                      <!-- DOB, Age, Contact Row -->
                      <div class="row mb-3">
                        <div class="col-md-4">
                          <label class="form-label font-weight-bold" for="txtdob">Date of Birth <span class="text-danger">*</span></label>
                          <input type="date" name="txtdob" id="txtdob" class="form-control" onchange="calculateAge()" required max="<?= date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-2">
                          <label class="form-label font-weight-bold" for="txtage">Age</label>
                          <input type="text" name="txtage" id="txtage" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label font-weight-bold" for="txtcn">Contact Number <span class="text-danger">*</span></label>
                          <input type="text" name="txtcn" id="txtcn" class="form-control" placeholder="Contact Number" required>
                        </div>
                      </div>

                     
                    </div>
                  </div>

                  <!-- Additional Information Section -->
                  <div class="card mb-4" style="border-left: 4px solid #0076CE;">
                    <div class="card-header" style="background-color: #f8f9fa;">
                      <h5 class="mb-0" style="color: #0076CE;">
                        <i class="fas fa-passport mr-2"></i>Additional Information
                      </h5>
                    </div>
                    <div class="card-body">
                       <!-- Desired Country Row -->
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label class="form-label font-weight-bold" for="txtcountry">Desired Country</label>
                          <select name="txtcountry" id="txtcountry" class="form-control">
                              <option value="">-- Select Country --</option>
                              <option value="Bahrain">Bahrain</option>
                              <option value="Jordan">Jordan</option>
                              <option value="Kuwait">Kuwait</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Oman">Oman</option>
                              <option value="Qatar">Qatar</option>
                              <option value="Saudi">Saudi</option>
                          </select>
                        </div>
                      </div>
                      <!-- Passport Section -->
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="txtwpassport" name="txtwpassport" onchange="document.getElementById('txtwpassport').checked ? document.getElementById('txtpassport').style.display='block':document.getElementById('txtpassport').style.display='none';document.getElementById('txtpassport').value=''">
                            <label class="custom-control-label font-weight-bold" for="txtwpassport">Has Passport</label>
                          </div>
                          <input type="text" style="display:none" name="txtpassport" placeholder="Passport Number" id="txtpassport" class="form-control">
                        </div>
                      </div>

                      <!-- Experience Abroad Section -->
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" name="txtabroad" id="txtabroad" onchange="abroad()">
                            <label class="custom-control-label font-weight-bold" for="txtabroad">Has Experience Working Abroad</label>
                          </div>
                          <input type="hidden" id="xabroad" name="xabroad">


                          
                          <div class="row">
                            <div class="col-md-12">
                              <input type="text" style="display:none" name="txtabroadw" placeholder="Which Country/countries" id="txtabroadw" class="form-control mb-2">
                              <input type="text" style="display:none" name="txtabroadd" placeholder="Date Range (e.g., 2020-2022)" id="txtabroadd" class="form-control mb-2">
                            </div>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Action Buttons -->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button type="submit" name="btnreg" class="btn xhire-success btn-lg px-5">
                        <i class="fas fa-user-plus mr-2"></i>Register New Applicant
                      </button>
                      <a href="agent_lst.php" class="btn xhire-secondary btn-lg px-5 ml-3">
                        <i class="fas fa-times mr-2"></i>Cancel
                      </a>
                    </div>
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

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="float-right d-none d-sm-inline">
        PJDMS - Professional Job Deployment Management System
      </div>
      <strong>Copyright &copy; 2025 <a href="#" style="color: #0f5132;">PJDMS</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  function ifPassport(){
    let valid_id = document.getElementById('txtvalidid');
    let w_passport = document.getElementById('txtwpassport');
    let passport = document.getElementById('txtpassport');
    if(valid_id.value=="Passport"){
        w_passport.checked = true;
        passport.style.display = 'block';
        passport.disabled = true;
    }else{
        w_passport.checked = false;
        passport.disabled = false;
        passport.style.display = 'none';
    }
  }
  
  function pasPassportid(){
      let valid_id = document.getElementById('txtvalidid');
      let passport1 = document.getElementById('txtvalidid1');
      let passport2 = document.getElementById('txtpassport');

      if(valid_id.value=="Passport"){
        passport2.value = passport1.value;
      }
  }

  function calculateAge() {
      const birthdate = document.getElementById("txtdob").value;
      if (!birthdate) return;

      const birthDateObj = new Date(birthdate);
      const today = new Date();

      let age = today.getFullYear() - birthDateObj.getFullYear();
      const monthDiff = today.getMonth() - birthDateObj.getMonth();
      const dayDiff = today.getDate() - birthDateObj.getDate();

      // Adjust age if birthday hasn't occurred yet this year
      if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        age--;
      }

      document.getElementById("txtage").value=`${age}`;
    }

    function abroad(){
      let isxabroad = document.getElementById('txtabroad');
      let wabroad = document.getElementById('txtabroadw');
      let dabroad = document.getElementById('txtabroadd');
      let xabroad = document.getElementById('xabroad');
      if(isxabroad.checked){
        wabroad.style.display='block';
        dabroad.style.display='block';
        xabroad.value="1";  
      }else{
        wabroad.value="";
        dabroad.value=""
        wabroad.style.display='none';
        dabroad.style.display='none';
        xabroad.value="0";  
      }
    }

    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php include 'footer_scripts.php'; ?>
</body>
</html>