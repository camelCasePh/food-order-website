<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br><br>

            <?php
                        //check whether id is passsed or not

                        if(isset($_GET['id'])){
                            //id is set
                            //get the id fvalue
                            $id = $_GET['id'];

                            // get all the order data from the database where id is equal to the id passed above
                            $sql = "SELECT * FROM tbl_order WHERE id=$id ";

                            //execute the query
                                $res = mysqli_query($conn, $sql);

                            //count the rows if there is any
                            $count = mysqli_num_rows($res);
                            //check whether there is data or not
                            if($count == 1){
                                //there is an order data
                                $rows = mysqli_fetch_assoc($res);
                                $food = $rows['food'];
                                $price = $rows['price'];
                                $qty= $rows['qty'];
                                $status = $rows['status'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact = $rows['customer_contact'];
                                $customer_email= $rows['customer_email'];
                                $customer_address = $rows['customer_address'];
                            }else{
                                header('location:'.SITE_URL.'admin/manage-order.php');
                            }

                        }else{
                            //id is not passed here
                            header('location:'.SITE_URL.'adminn/manage-order.php');
                        }

?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><?php echo $food;?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                      <td><?php echo $price;?></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty;?>">
                        </td>

                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status =="Ordered"){ echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status =="On-delivery"){ echo "selected";} ?> value="On-delivery">On-delivery</option>
                                <option <?php if($status =="Delivered"){ echo "selected";} ?> value="Delivered">Delivered</option>
                                <option <?php if($status =="Cancelled"){ echo "selected";} ?> value="Cancelled">Cancelled</option>

                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Contact</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td>
                            <textarea name="customer_address" cols="30" rows="5">
                            <?php echo $customer_address;?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan ="2">
                            <input type="hidden" name="id" value ="<?php echo $id; ?> ">
                            <input type="hidden" name="food" value ="<?php echo $food; ?> ">
                            <input type="hidden" name="price" value ="<?php echo $price; ?> ">
                            <input type="submit" name="submit" value="Update Order" class="btn-primary">
                        </td>
                    </tr>
                    
                </table>
            </form>

            <?php
                    //CHECK whether update button is clicked or not

                    if(isset($_POST['submit'])){
                        //is cliked
                       // echo "is clicked";

                       //get all the data from the form

                       $id = $_POST['id'];
                       $food = $_POST['food'];
                       $price = $_POST['price'];
                       $qty = $_POST['qty'];
                       $total = $price*$qty;
                       $status = $_POST['status'];
                       $customer_name = $_POST['customer_name'];
                       $customer_contact = $_POST['customer_contact'];
                       $customer_email = $_POST['customer_email'];
                       $customer_address = $_POST['customer_address'];

                       //update the current data in the tbl_order database
                       //sql query to store updated data to the database

                       $sql2 = " UPDATE tbl_order SET
                                food = '$food',
                                price = $price,
                                qty = $qty,
                                total = $total,
                                status ='$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                                WHERE id=$id ";

                       //Execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            if($res2 == true){
                                $_SESSION['update-order'] = "<div class='success'> Order Updated Successfully!</div>";
                                header('location:'.SITE_URL.'admin/manage-order.php');
                            }else{
                                $_SESSION['update-order'] = "<div class='failed'> Failed to update Order.</div>";
                                header('location:'.SITE_URL.'admin/manage-order.php');
                            }


                    }
            ?>


        </div>
    </div>

<?php include('partials/footer.php')?>