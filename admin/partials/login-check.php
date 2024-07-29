<?php
//check if user is login or not
//authorization or access control
if(!isset($_SESSION['user']))
//if user session is not set
 {
//user is not login then redirect to login page
$_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
header('location:'.SITEURL.'admin/login.php');

 } 
?>