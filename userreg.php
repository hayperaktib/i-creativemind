<?php
    require "conn.php";

    if(isset($_POST['btnreg'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // if (isset($_FILES["profile_photo"]) && $_FILES["profile_photo"]["error"] == 0) {
        //     $target_dir = "uploads/";
        //     $profile_photo = $target_dir . basename($_FILES["profile_photo"]["name"]);
        //     $uploadOk = 1;
        //     $imageFileType = strtolower(pathinfo($profile_photo, PATHINFO_EXTENSION));

        //$sql = "insert into users(firstname, lastname, username, password, role, profilephoto, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $profile_photo . "', '" . $_POST['contactno'] . "')";
        $sql = "insert into users(firstname, lastname, username, password, role, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $_POST['contactno'] . "')";
                    $rs = $conn->query($sql);
        
                    
                    echo " 
                        <script type='text/javascript'>
                            alert('New User successfully Added!')
                        </script>
                        ";
                    header("location: superadmin_users.php");

        // Handle file upload
        // if (isset($_FILES["profile_photo"]) && $_FILES["profile_photo"]["error"] == 0) {
        //     $target_dir = "uploads/";
        //     $profile_photo = $target_dir . basename($_FILES["profile_photo"]["name"]);
        //     $uploadOk = 1;
        //     $imageFileType = strtolower(pathinfo($profile_photo, PATHINFO_EXTENSION));

        //     if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $profile_photo)) {
        //             // File upload succeeded
                    
        //             //$sql = "insert into users(firstname, lastname, username, password, role, profilephoto, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $profile_photo . "', '" . $_POST['contactno'] . "')";
        //             $sql = "insert into users(firstname, lastname, username, password, role, contact_number) values('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['username'] . "','" . $password . "','" . $_POST['role'] . "', '" . $_POST['contactno'] . "')";
        //             $rs = $conn->query($sql);
            
        //             echo " 
        //                 <script type='text/javascript'>
        //                     alert('New User successfully Added!')
        //                 </script>
        //                 ";
        //             header("location: superadmin_users.php");
        //     }
                
        //}
        //}
    }
?>