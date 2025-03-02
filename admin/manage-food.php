<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">

        <h1>Manage Food</h1>
        <br> <br>
                <!-- Button to Add food -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br> <br>
            <?php 
            if(isset($_SESSION['add']))//checking session 
            {
                echo $_SESSION['add'];//display message
                unset($_SESSION['add']);   //remove session
            }
            if(isset($_SESSION['delete']))//checking session 
            {
                echo $_SESSION['delete'];//display message
                unset($_SESSION['delete']);   //remove session
            }
            if(isset($_SESSION['upload']))//checking session 
            {
                echo $_SESSION['upload'];//display message
                unset($_SESSION['upload']);   //remove session
            }
            if(isset($_SESSION['update']))//checking session 
            {
                echo $_SESSION['update'];//display message
                unset($_SESSION['update']);   //remove session
            }
            if(isset($_SESSION['unauthorized']))//checking session 
            {
                echo $_SESSION['unauthorized'];//display message
                unset($_SESSION['unauthorized']);   //remove session
            }
            ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                <?php 
                //create sql query to get data 
                $sql="SELECT * FROM tbl_food";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>
                          <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>Rs<?php echo $price; ?></td>
                        <td>
                            <?php //echo $image_name;
                            //check whether we have image or not
                            if($image_name=="")
                            {
                                // we do not have image, display error message
                                echo "<div class='error'>Image not Added</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px" alt="">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                       
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?> &image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>

                        </td>
                    </tr>
                            <?php


                        }
                    }
                    else{
                        //food not added in data base
                        echo" <tr>
                        <td colspan='7' class='error'>Food Not Added Yet
                        </td>
                    </tr>";
                    }
                ?>
                    
                    
                </table>
    </div>
</div>

<?php include('partials/footer.php')?>

