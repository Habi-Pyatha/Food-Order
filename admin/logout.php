<?php

include('../config/constants.php');
//destory the session and redirect to login page
session_destroy();//unsets $_session['user]
header('location:'.SITEURL.'admin/login.php');

?>