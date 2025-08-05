<?php
 include 
 'admin_session.php'; 
 
 require "conn.php";

    $id=111;


 if(isset($_POST['btnreg'])){

    $sql="update tblapplicants;

    $rs = $conn->query($sql);

    header("location:admin_dashboard.php?user_id=" . urlencode($user_id));

 }
 ?>  