<?php include('partials/menu.php');
?>
 <div class="main-content">
     <div class="wrapper">
          <h1>Add Category</h1>
<br> <br>
<?php 
                 if(isset($_SESSION['add']))//checking session 
                 {
                     echo $_SESSION['add'];//display message
                     unset($_SESSION['add']);   //remove session
                 }
                 if(isset($_SESSION['upload']))//checking session 
                 {
                     echo $_SESSION['upload'];//display message
                     unset($_SESSION['upload']);   //remove session
                 }
                 ?>
                 <br><br>

<!-- add category form start -->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>
                    Title:
                </td>
                <td>
                    <input type="text" name="title" placeholder="Category Title" required>
                </td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>
                    Featured:
                </td>
                <td>
                    <input type="radio" name="featured" value="Yes" >Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes" >Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>

        </table>
    </form>

<!-- add category stop -->

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "clicked";
    //1.get the value from category form
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    //for radio input type we need to check whether the button is selected or not 
    if(isset($_POST['featured']))
    {
        $featured=$_POST['featured'];
    }
    else
    {
        $featured="No";

    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else
    {
        $active="No";

    }
    //check whether the image is selected or not and set the value for the image name accordingly
//print_r($_FILES['image']);

//die();//break the code here

if(isset($_FILES['image']['name']))
{
    //upload the image
    //to upload image we need image name ,source path and destination path 
    $image_name=$_FILES['image']['name'];
//upload image only if image is selected
if($image_name!="")
{

    
    
//auto rename our image 
//get the extension of our image(jpg,gif)
$ext=end(explode('.',$image_name));

//rename the image
$image_name="Food_Category_".rand(000,999).'.'.$ext;


$source_path=$_FILES['image']['tmp_name'];
$destination_path="../images/category/".$image_name;
//finally we can upload image
$upload=move_uploaded_file($source_path,$destination_path);
//check whether the image is uploaded or not
//and if image isnot uploaded then we wiill stop the process and redirect with error message
if($upload==false)
{
        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/add-category.php');
        //stop the process
        die();
    }
}

}
else    
{
        //don't upload the image and set the image name value as blank
        $image_name="";
    }


    //2.create sql query to insert into database
    $sql="INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'";
    //3.execute query and save it to database
    $res=mysqli_query($conn,$sql);
    //check if query executed or not
    if($res==true)
    {
        //query executed and added
        $_SESSION['add']="<div class='success'>Category Addeded Sucessfully </div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-category.php');
    }
    else{
        //failed to add category
        $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
    //redirect page to add admin
    header("location:".SITEURL.'admin/add-category.php');
    }

}
?>
     </div>
 </div>

<?php include('partials/footer.php');
?>