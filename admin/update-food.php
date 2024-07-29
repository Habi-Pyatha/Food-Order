

<?php include('partials/menu.php')?>

<?php
    //check whether the id is set or not
    if(isset($_GET['id']))
    {
        //get the id and all other details
       // echo "getting the data";
       $id=$_GET['id'];
       //query to get all other details
       $sql2="SELECT * FROM tbl_food WHERE id=$id";
       $res2=mysqli_query($conn,$sql2);
       //count the row to check whether the id is valid or not
       
               //get all the data
               $row2=mysqli_fetch_assoc($res2);
               $title=$row2['title'];
               $description=$row2['description'];
               $price=$row2['price'];
               $current_image=$row2['image_name'];
               $current_category=$row2['category_id'];
               $featured=$row2['featured'];
               $active=$row2['active'];
          
       
    }
    else
    {
        //reidirect to manage category page
        header('location:'.SITEURL.'admin/manage-food.php');

    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>
        <form action="" method="post" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>
        <td>Title:</td>
        <td>
            <input type="text" name="title" value="<?php echo $title;?>">
        </td>
    </tr>
    <tr>
        <td>Description:</td>
        <td>
            <textarea name="description" id="" cols="30" rows="5" ><?php echo $description;?></textarea>
        </td>
    </tr>
    <tr>
        <td>Price:</td>
        <td>
            <input type="number" name="price" value="<?php echo $price;?>">
        </td>
    </tr>
    <tr>
        <td>Current Image:</td>
        <td>
        <?php 
                        if($current_image!="")
                        {
                            //display the image
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px" alt="">
                            <?php
                        }                   
                        else
                        {
                           // display the message
                           echo"<div class=error> Image Not Added</div>";
                        }
                   ?>
        </td>
    </tr>
    <tr>
        <td>Select Image:</td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>
    <tr>
        <td>Category:</td>
        <td>
            <select name="category" id="">
                <?php 
                //create php code to display category from database
                //1.create sql to get all active categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                //executing query
                $res=mysqli_query($conn,$sql);
                //count rows to check if we have categories or not
                $count=mysqli_num_rows($res);
                //if count>0 we have categories else we donot have categories
                if($count>0)
                {
                    //we have categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details of categories 
                        $category_id=$row['id'];
                       
                      
                        $category_title=$row['title'];
                        ?>
                        <option <?php if($current_category==$category_id){echo "selected";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                        <?php
                    }
                }
                else 
                {
                    //we donot have category
                    ?>
                <option value="0">No Category Found</option>

                    <?php
                }
                //2.disply on dropdown
                ?>

                
               
            </select>
        </td>
    </tr>
    <tr>
        <td>Featured:</td>
        <td>
        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes
        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No

        </td>
    </tr>
    <tr>
        <td>
        Active:
        </td>
        <td>
        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" >Yes
        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No

        </td>

    </tr>
    <tr>
        <td colspan="2">
        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
        </td>
    </tr>
</table>
</form>  
<?php
    if(isset($_POST['submit']))
    {
        //echo "clicked";
        //1.get all the values from our form 
        $id=$_POST['id'];
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $description=mysqli_real_escape_string($conn,$_POST['description']);
        $price=$_POST['price'];
        $current_image=$_POST['current_image'];
        $category=$_POST['category'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        //2.updating new image if selected 
        //check whether the image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //get the image details
            $image_name=$_FILES['image']['name'];
            //check whether the image is available or not
            if($image_name!="")
            {
                //image is available
                //A.upload the new image 
                //auto rename our image 
//get the extension of our image(jpg,gif)
$ext=end(explode('.',$image_name));

//rename the image
$image_name="Food-Name-".rand(0000,9999).'.'.$ext;


$source_path=$_FILES['image']['tmp_name'];
$destination_path="../images/food/".$image_name;
//finally we can upload image
$upload=move_uploaded_file($source_path,$destination_path);
//check whether the image is uploaded or not
//and if image isnot uploaded then we wiill stop the process and redirect with error message
if($upload==false)
    {
        $_SESSION['upload']="<div class='error'>Failed to Upload New Image</div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/manage-food.php');
        //stop the process
        die();
    }

                //B.remove the current image if available
                if($current_image!="")
                {

                    $remove_path="../images/food/".$current_image;
                    $remove=unlink($remove_path);
                    
                    //check whether the image is removed or not
                    //if failed to remove display message and stop the process
                    if($remove==false)
                    {
                        //failed to remove image
                        $_SESSION['failed-remove']="<div class='error'>Failed to Remove Current Image</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();//stop the process
                    }
                }

            }
            
            else
            {
                $image_name=$current_image;

            }
        }
        else{
            $image_name=$current_image;
        }

        //3.finally update database

        $sql3="UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id
            ";

            //execute query
            $res3=mysqli_query($conn,$sql3);

        //4.redirect to manage category with message
//      check if query executed or not
        if($res3==true)
        {
            //category updated
            $_SESSION['update']="<div class='success'>Food Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to update category
            $_SESSION['update']="<div class='error'>Failed to Update Food </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
    }
?>


    </div>
</div>

<?php include('partials/footer.php')?>
