<?php

        // Check if file is an actual image
            $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo " 
                    <script type='text/javascript'>
                        alert('File is not an image!')
                    </script>
                    ";
            }

            // Check if file already exists
            if (file_exists($profile_photo)) {
                echo " 
                    <script type='text/javascript'>
                        alert('Sorry, File already exist!')
                    </script>
                    ";
            }

            // Check file size
            if ($_FILES["profile_photo"]["size"] > 5000000) { // 5MB max size
                 echo " 
                    <script type='text/javascript'>
                        alert('Sorry, File is too large!')
                    </script>
                    ";
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo " 
                    <script type='text/javascript'>
                        alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed!')
                    </script>
                    ";
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo " 
                    <script type='text/javascript'>
                        alert('Sorry, your file could not be uploaded!')
                    </script>
                    ";
            } else {
                if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $profile_photo)) {
                    // File upload succeeded
                    
                    $sql = "insert into users(firstname, lastname, username, password, role, profilephoto, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $profile_photo . "', '" . $_POST['contactno'] . "')";
                    //$sql = "insert into users(firstname, lastname, username, password, role, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $_POST['contactno'] . "')";
                    $rs = $conn->query($sql);
            
                    echo " 
                        <script type='text/javascript'>
                            alert('New User successfully Added!')
                        </script>
                        ";
                    header("location: superadmin_users.php");
                }
            }
?>
<form action="userreg.php" id="updateForm" method="POST">
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