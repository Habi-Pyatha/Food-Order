<?php include('partials-front/menu.php');?>

<?php  
//check whether food id is set or not
 if(isset($_GET['food_id']))
 {
     //get food id
     $food_id=$_GET['food_id'];
     //get food details
     $sql="SELECT * FROM tbl_food WHERE id=$food_id";
     $res=mysqli_query($conn,$sql);
     $count=mysqli_num_rows($res);
     if($count==1)
     {
         //we have data
         $row=mysqli_fetch_assoc($res);
         
         $title=$row['title'];
         
         $price=$row['price'];
         $image_name=$row['image_name'];
     }
     else
     {
         //food not available redirect to home page
         header('location:'.SITEURL);
     }
 }
 else
 {
        //redirect to home page
        header('location:'.SITEURL);
 }


?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                //check whether the image is available or not
                    if($image_name=="")
                    {
                        echo"<div class='error'>Image Not Available</div>";
                    }
                    else{
                        ?>

                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="order" class="img-responsive img-curve">
                        <?php
                    }
                ?>                    
                </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo$title;?>">
                        
                        <p class="food-price">Rs<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo$price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Firstname Lastname" class="input-responsive" autocomplete="off" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" pattern="[0-9]{10}" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" autocomplete="off" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. example@gmail.com" class="input-responsive" autocomplete="off" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" autocomplete="off" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //get all details from form
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty; 
                $order_date=date("Y-m-d h:i:sa");//current date and time
                $status="Ordered";//ordered, on delievery, delivered, cancel
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                //save the order in data base
                $sql2="INSERT INTO tbl_order SET
                    food='$food',
                    price=$price,
                    qty='$qty',
                    total='$total',
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";

                    //execute the query
                    $res2=mysqli_query($conn,$sql2);
                    //check whether query executed sucessfully or not
                    if($res==true)
                    {
                        //order saved
                        $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order']="<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                     //failed to save order
                    }

                
                

            }
            ?>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>