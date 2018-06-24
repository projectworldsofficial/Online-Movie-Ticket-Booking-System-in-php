<?php
session_start();
include('../../config.php');
extract($_GET);
mysqli_query($con,"update tbl_shows set status='0' where s_id='$id'");
$_SESSION['success']="Show Deleted";
header('location:view_shows.php');?>