
<?php
    include('config.php');
    extract($_POST);
   $qry=mysqli_query($con,"insert into tbl_contact values(NULL,'$name','$email',$mobile','$subject')");
    //echo $qry;
    //header('location:contact.php');
?>