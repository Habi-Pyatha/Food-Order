<?php
include('../config/constants.php');

//echo"delete food page";
if(isset($_GET['id'])&&isset($_GET['image_name'])) //use can also use AND in place of &&
{
    //process to delete
   // echo "Process to Delete";
   //1.get image id and image name
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];

   //2.remove image if available
//check whether the image is available or not delete if available
if($image_name!="")
{
    //it has image and need to remove from folder
    $path="../images/food/".$image_name;
    //remove image file from folder
    $remove=unlink($path);
    //check if image is removed or not
    if($remove==false)
    {
        //failed to remove image
        $_SESSION['upload']="<div class='error'>Failed to Remove Image File</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    die();
    }
}
   //3.delete food from database
   $sql="DELETE FROM tbl_food WHERE id=$id";
   //execute query
   $res=mysqli_query($conn,$sql);
   //check whether if executed or not
   if($res==true)
   {
       //food deleted
       $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
       header('location:'.SITEURL.'admin/manage-food.php');
   }
   else
   {
       //failed to delete food
       $_SESSION['delete']="<div class='error'>Failed to Delete Food</div>";
       header('location:'.SITEURL.'admin/manage-food.php');
   }

   //4.redirect to mananage food with session message
}
else{
    //redirect to manage food page
    //echo "redirect";
    $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}



?>