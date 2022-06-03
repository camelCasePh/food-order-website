<?php include('partials-front/menu.php');?>

<?php
        //get the food id if food id is available
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
             //make an sql query to get the food details that corresponds to the food id
        $sql =" SELECT * FROM tbl_food WHERE id=$id ";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            $rows = mysqli_fetch_assoc($res);
            $title = $rows['title'];
            $price = $rows['price'];
            $image_name = $rows['image_name'];
        }else{
            header('location:'.SITE_URL);
        }
        
        
           

        }else{
            header('location:'.SITE_URL);
        }

       

        
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value ="<?php echo $title;?>">
                        <p class="order-food-price"><?php echo $price;?> PHP</p>
                        <input type="hidden" name="price" value ="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="fullname" placeholder="E.g. Harris Revelo" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 09754514873" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. camelCase.ph@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, Barangay, Municipality, City, Province" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check whether submit button is clicked or not
                if(isset($_POST['submit'])){
                   
                        $food = mysqli_real_escape_string($conn,$_POST['food']);
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];

                        $total = $price*$qty;
                        $order_date = date("Y-m-d h:i:sa");
                        $status = "Ordered"; //ordered, on-delivery, delivered, Cancelled
                        $customer_name = mysqli_real_escape_string($conn,$_POST['fullname']);
                        $customer_contact = mysqli_real_escape_string($conn,$_POST['contact']);
                        $customer_email = mysqli_real_escape_string($conn,$_POST['email']);
                        $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                        //save the order to the database

                        //create sql query to save all the data

                        $sql2 = " INSERT INTO tbl_order SET
                            food ='$food',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        ";

                        //Execute query
                        $res2 = mysqli_query($conn, $sql2);

                        //check whether the query is executed or not

                        if($res == true){
                            //query is executed and order save
                            $_SESSION['order'] = "<div class='text-alig-center success'>         Food Ordered Successfully!</div>";
                            header('location:'.SITE_URL);

                        }else{
                            //query is not executed and order not save
                            $_SESSION['order'] = "<div class='text-alig-center failed'>Failed to order food.</div>";
                            header('location:'.SITE_URL);

                        }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>