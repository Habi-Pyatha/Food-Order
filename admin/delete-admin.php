<?php 
//include constants.php page here
include('../config/constants.php');
//1.get the id of admin to be deleted
 $id=$_GET['id'];
//2.create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//3.redirect to manage admin page with message ( sucess or fail)
$res=mysqli_query($conn,$sql);
//if query is sucessfull or not
if($res==true)
{
    //query executed successfully and admin deleted
   // echo "admin deleted";
   //creating session varaible to display sucessfull deleted message
   $_SESSION['delete']="<div class='success'>Admin Deleted Sucessfully</div>";
   //redirect to manage admin page
   header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    //failed to delete admin
    // echo"failed to delete admin";
    $_SESSION['delete']="<div class='error'>Failed to Delete Admin . Try again</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}


?>