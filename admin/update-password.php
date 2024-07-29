<?php 
include ('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
}
?>

        <form action="" method="post">
        <table class="tbl-30">
            <tr>
                <td>
                    Current Password:
                </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr>
                <td>
                    New Password:
                </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>
                    Confirm Password:
                </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>


        </form>

    </div>
</div>

<?php
//check if submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "clicked";
   //1.get data from the form 
$id=$_POST['id'];
$current_password=md5($_POST['current_password']);
$new_password=md5($_POST['new_password']);
$confirm_password=md5($_POST['confirm_password']);
   //2.check user with current id and password
$sql="SELECT * FROM tbl_admin WHERE id=$id and password='$current_password'";
$res=mysqli_query($conn,$sql);
if($res==true)
{
    //check if data is available or not
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        //userexist and password can be changed
       // echo "User Found";
    // to check if new password and confirm password matches or not
    if($new_password==$confirm_password)
    {
        //update the password
       // echo "password matched";
       $sql2="UPDATE tbl_admin SET
       password='$new_password'
       where id=$id";
       //execute the query
       $res2=mysqli_query($conn,$sql2);
       //check query executed or not
       if($res2==true)
       {
           //display sucess message
           $_SESSION['change-pwd']="<div class='success'>Password Changed Sucessfully.</div>";
           header('location:'.SITEURL.'admin/manage-admin.php');
       }
       else
       {
           //display fail message
           $_SESSION['change-pwd']="<div class='error'>Failed to change Password.</div>";
           header('location:'.SITEURL.'admin/manage-admin.php');
       }
    }
    else
        {
            $_SESSION['pwd-not-match']="<div class='error'>Password did not Match.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }
    else
    {
        //user doesnot exist
        $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
}
   //3.check if password matches

   //4.change password if all condition meets
}
?>



<?php 
include ('partials/footer.php');
?>