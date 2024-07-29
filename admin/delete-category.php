<?php
//to include constrain files
include('../config/constants.php');

//echo "Deleted";
//check whether the id and image_name value is set or not
if(isset($_GET['id'])&& isset($_GET['image_name']))
{
    //get the value and delete
   // echo "get value and delete";
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];
    //remove the physical image file if there is it 
    if($image_name!="")
    {
        //image is available so remove it
        $path="../images/category/".$image_name;
        //remove image
        $remove=unlink($path);
        //if failed to remove image then add and error messageand stop the process
        if($remove==false)
        {
            //set the session message 
            $_SESSION['remove']="<div class='error'>Failed to remove category Image.</div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/manage-category.php');
            //redirect to manage-category page
            //stop the process
            die();
        }

    }
    //delete data from database 
    $sql="DELETE FROM   tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    //IF DATA IS DELETED OR NOT
    if($res==true)
    {
        //set success message
        $_SESSION['delete']="<div class='success'>Category Deleted Sucessfully </div>";
    
    header("location:".SITEURL.'admin/manage-category.php');
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete']="<div class='error'>Failed to Delete Category </div>";
    
    header("location:".SITEURL.'admin/manage-category.php');
    }
    //redirect to manage category page with message

}
else
{
    //redirect to manage-category page
    header("location:".SITEURL.'admin/manage-category.php');
}



?>