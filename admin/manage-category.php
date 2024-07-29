<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1>
        <br> <br>
        <?php 
                 if(isset($_SESSION['add']))//checking session 
                 {
                     echo $_SESSION['add'];//display message
                     unset($_SESSION['add']);   //remove session
                 }
                 if(isset($_SESSION['remove']))//checking session 
                 {
                     echo $_SESSION['remove'];//display message
                     unset($_SESSION['remove']);   //remove session
                 }
                 if(isset($_SESSION['delete']))//checking session 
                 {
                     echo $_SESSION['delete'];//display message
                     unset($_SESSION['delete']);   //remove session
                 }
                 if(isset($_SESSION['no-category-found']))//checking session 
                 {
                     echo $_SESSION['no-category-found'];//display message
                     unset($_SESSION['no-category-found']);   //remove session
                 }
                 if(isset($_SESSION['update']))//checking session 
                 {
                     echo $_SESSION['update'];//display message
                     unset($_SESSION['update']);   //remove session
                 }
                 if(isset($_SESSION['upload']))//checking session 
                 {
                     echo $_SESSION['upload'];//display message
                     unset($_SESSION['upload']);   //remove session
                 }
                 if(isset($_SESSION['failed-remove']))//checking session 
                 {
                     echo $_SESSION['failed-remove'];//display message
                     unset($_SESSION['failed-remove']);   //remove session
                 }
                 ?>
                 <br>
                 <br>
                <!-- Button to Add Category -->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br> <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Feature</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    $sql="SELECT * FROM tbl_category";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
//we have data in database
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>
                            <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $title;?></td>
                                            <td>
                                                <?php //echo $image_name;
                                                //check if image name is available or not
                                                if($image_name!="")
                                                {?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width='100px' alt="">
                                                <?php
                                                    //display the image
                                                }
                                                else
                                                {
                                                    //display the no image message
                                                    echo"<div class='error'>Image not Added.</div>";
                                                }

                                                ?>
                                             </td>

                                            <td><?php echo $featured;?></td>
                                            <td><?php echo $active;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?> " class="btn-secondary">Update Category</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?> &image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>

                                            </td>
                             </tr>

                            <?php

                        }

                    }
                    else
                    {
                        // we donot have data in database
                        //we need to display data inside the table
                        ?>
                        <tr>
                            <td>
                                <div colspan="6" class="error">No Category Added</div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                    
                </table>
    </div>
</div>

<?php include('partials/footer.php')?>

