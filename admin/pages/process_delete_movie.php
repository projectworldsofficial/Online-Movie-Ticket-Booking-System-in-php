<?php
session_start();
include('../../config.php');

$mid=$_GET['mid'];
mysqli_query($con,"delete  from tbl_movie where movie_id='$mid'");
 $_SESSION['success']="Movie deleted  successfully";
header("location:index.php");
?>