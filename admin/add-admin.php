<?php include("partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>
        <?php 
                 if(isset($_SESSION['add']))//checking session 
                 {
                     echo $_SESSION['add'];//display message
                     unset($_SESSION['add']);   //remove session
                 }
                 ?>
                 <br> <br> <br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="your username" required autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="your password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php") ?>

<?php
// process the value from form and save it in database
// check whether the button is clicked or not
if(isset($_POST['submit']))
{
    // button clicked
    //1.get data from form
     $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=md5($_POST['password']);//password encryption with md5

    //2.sql query to save data in the database
    $sql="INSERT INTO tbl_admin set
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    

    //3.executing database
$res=mysqli_query($conn,$sql) or die(mysqli_error());

// 4. data is inserted or not and displaying appropiate message
if($res==true)
{
    //echo "DAta inserted";
    //create session variable to display message for better result
    $_SESSION['add']="<div class='success'>Admin Addeded Sucessfully </div>";
    //redirect page to manage admin
    header("location:".SITEURL.'admin/manage-admin.php');
}
else
    {
      //  echo "data_failed to insert";
      $_SESSION['add']="<div class='error'>Failed to add admin</div>";
    //redirect page to add admin
    header("location:".SITEURL.'admin/add-admin.php');
    }
}


?>