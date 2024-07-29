<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>
        <?php 
                 if(isset($_SESSION['upload']))//checking session 
                 {
                     echo $_SESSION['upload'];//display message
                     unset($_SESSION['upload']);   //remove session
                 }
                
                 ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
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
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title;?></option>
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
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>
                <tr>
                    <td>
                    Active:
                    </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php 
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add food in data base
           // echo "food in database";
           //1.get the data from the form 
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $description=mysqli_real_escape_string($conn,$_POST['description']);
            $price=$_POST['price'];
            $category=$_POST['category'];

            //check whether radio button is checked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";//setting default value
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";//default value
            }

           //2.upload the image if selected 
           //checkwheteher the select image is clicked or not and upload the image only if the image is selected
           
           if(isset($_FILES['image']['name']))
           {
               //get the details of the selected image
                $image_name=$_FILES['image']['name'];
                //check whether the iamge is selected or not and upload image only if selected
                if($image_name!="")
                {
                    //image is selected
                    //a.Rename the image
                    //get the extension of lselected image
                    $ext=end(explode('.',$image_name));
                    //create new name for image
                    $image_name="Food-Name-".rand(0000,9999).".".$ext;//creates new image name


                    //b.upload the image
                    //get the source path and destination path
                    $src=$_FILES['image']['tmp_name'];
                    $dst="../images/food/".$image_name;

                    //finally upload the food image
                    $upload=move_uploaded_file($src,$dst);
                    
                    //check if image is upload or not
                    if($upload==false)
                    {
                        //failed to upload the image
                        //redirect the page to add food page
                        //stop the process
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                        
                        header("location:".SITEURL.'admin/add-food.php');
                        die();
                    }
                }

           }
           else
           {
               $image_name="";//setting default value as blank
           }

           //3.insert into database
           // for numerial ' ' not needed
           $sql2="INSERT INTO tbl_food SET
           title='$title',
           description='$description',
           price='$price',
           image_name='$image_name',
           category_id=$category,
           featured='$featured',
           active='$active'

           ";

           $res2=mysqli_query($conn,$sql2);
           //check if data is inserted or not
           if($res2==true)
           {
               //data inserted sucessfully
               $_SESSION['add']="<div class='success'>Food Addeded Sucessfully </div>";
        
        header("location:".SITEURL.'admin/manage-food.php');
           }
           else
           {
               //failed to insert data
               $_SESSION['add']="<div class='error'>Failed to Add Food </div>";
        
               header("location:".SITEURL.'admin/manage-food.php');
           }

           //4. redirect with message to mage food page


        }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>