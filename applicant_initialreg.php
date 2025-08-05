<?php
    require "conn.php";

    if(isset($_POST['btnreg'])){

        // $sql = "insert into tblapplicants(validid,validid_no,fname,mname,lname,ext,dob,age,contactno,desiredcountry,passport,passportno,exabroad,whichcountry,daterange,regdate,agentid) 
        //         values('" . $_POST['txtvalidid'] . "','" . $_POST['txtvalidid1'] . "','" . $_POST['txtfirst'] . "','" . $_POST['txtmiddle'] . "','" . $_POST['txtlast'] . "','" . $_POST['txtext'] . "','" . $_POST['txtdob'] . "','" . $_POST['txtage'] . "','" . $_POST['txtcn'] . "','" . $_POST['txtcountry'] . "','1','" . $_POST['txtpassport'] . "','1','" . $_POST['txtabroadw'] . "','" . $_POST['txtabroadd'] . "','" . $_POST['txtregdate'] . "','" . $_POST['txtid'] . "')";

         $sql = "insert into tblapplicants(validid,validid_no,fname,mname,lname,ext, regdate,agentid) values('" . $_POST['txtvalidid'] . "','" . $_POST['txtvalidid1'] . "','" . $_POST['txtfirst'] . "','" . $_POST['txtmiddle'] . "','" . $_POST['txtlast'] . "','" . $_POST['txtext'] . "','" . $_POST['txtregdate'] . "','" . $_POST['txtid'] . "')";


        $rs = $conn->query($sql) or die('sfafa');

        echo "saved!";
        // echo "
        //     <script type='text/javascript'>
        //         alert('new applicant successfully registered!');
        //     </script>
        // ";
        //header('location:agent_entry.php');
    }
?>