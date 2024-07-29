<?php include('../config/constants.php') ?>
<html>
    <head><title>Login -Food Order System</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
<br>
<?php
if(isset($_SESSION['login']))
{
 echo $_SESSION['login'];
 unset($_SESSION['login']);   
}
if(isset($_SESSION['no-login-message']))
{
 echo $_SESSION['no-login-message'];
 unset($_SESSION['no-login-message']);   
}
?>
<style>
    body{
        margin:0;
        padding:0;
        font-family:montserrat;
        background:linear-gradient(120deg,#2980b9,#8e44ad);
        height:100vh;
        overflow:hidden;
       
    }
    .login{
        background:white;
        border-radius:5px;
    }
    form,h1{
        border-bottom:4px solid #adadad;
    }
    input{
        width:100%;
        padding 0 5px;
        height:40px;
        font-size:16px;
        border:none;
        border-bottom:2px solid #adadad;
        
        background:none;
        outline:none;
        text-align:center;
    }
    .btn-primary{
        border-radius:10px;
    }
label{
    font-size:20px;
    /* position:relative; */
    /* top:50px;
    left:5px; */
    color:#2691d9;
    transform:translateY(-50%);
    pointer-events:none;
}

a{
    text-decoration:none;
}
p{
    padding:5px 0 0 0;
}

</style>
<!-- login form starts here -->
        <form action="" method="post" class="text-center">
            <br>
            <label >

                Username: 
            </label>
            <br><input type="text" name="username" placeholder="Enter Username" autocomplete="off"> <br> <br>
            <label >

                Password: <br>
            </label>
            <input type="password" name="password" placeholder="Enter Password"> <br> <br> 
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

<!-- login form ends here -->

            <p class="text-center">Created By <a href="<?php echo SITEURL;?>aboutme.php">Habi Pyatha</a></p>
        </div>
    </body>
</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.get the data from the login form
 $username=mysqli_real_escape_string($conn,$_POST['username']);
  $password=mysqli_real_escape_string($conn,md5($_POST['password']));
//2.sql to check whether the user with username and password exists or not
$sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
//execute query
$res=mysqli_query($conn,$sql);
//user exist or not
$count=mysqli_num_rows($res);
if($count==1)
   {
        //user available and login sucess
 $_SESSION['login']="<div class='success'>Login successful.</div>";
 $_SESSION['user']=$username;// to check if user is login or not and logout will unset it

 header('location:'.SITEURL.'admin/');

   } 
    else
    {
//user not available
$_SESSION['login']="<div class='error text-center'>User name Or Password Did Not match.</div>";
 header('location:'.SITEURL.'admin/login.php');
    }

}
?>