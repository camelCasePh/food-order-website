
        <?php include('partials/menu.php')?>
        <!--menu ends here-->
        <div class="main-content">
            <div class="wrapper">
                    <h1>Manage Order</h1>
                    <br> 
                            <?php
                                if(isset($_SESSION['update-order'])){
                                    echo $_SESSION['update-order'];
                                    unset($_SESSION['update-order']);
                                }
                            ?>
                    <br>
                    <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>

                        </tr>

                        <?php
                                // get all data from the ordered table

                                $sql = "SELECT * FROM tbl_order";

                                //execute the  query

                                $res = mysqli_query($conn, $sql);

                                //count the rows
                                $sn=1;
                                $count = mysqli_num_rows($res);

                                //check whether there is data available or not

                                if($count > 0 ){
                                    //thre is data available
                                    //get the data
                                    while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $food = $rows['food'];
                                            $price = $rows['price'];
                                            $qty = $rows['qty'];
                                            $total = $rows['total'];
                                            $order_date = $rows['order_date'];
                                            $status = $rows['status'];
                                            $customer_name = $rows['customer_name'];
                                            $customer_contact = $rows['customer_contact'];
                                            $customer_email = $rows['customer_email'];
                                            $customer_address = $rows['customer_address'];

                                            ?>
                                                    <tr>
                                                    <td><?php echo $sn++;?>.</td>
                                                    <td><?php echo $food;?></td>
                                                    <td><?php echo $price;?></td>
                                                    <td><?php echo $qty;?></td>
                                                    <td><?php echo $total;?></td>
                                                    <td><?php echo $order_date;?></td>
                                                    <td>
                                                        
                                                    
                                                            <?php
                                                                    //ordered, on delivery , delivered and cancelled
                                                                    if($status =="Ordered"){
                                                                        echo"<label style='font-weight:bold;'>$status</label>";
                                                                    }
                                                                    else if($status =="On-delivery"){
                                                                        echo"<label style='color:orange; font-weight:bold;'>$status</label>";
                                                                    }else if($status == "Delivered"){
                                                                        echo"<label style='color:green; font-weight:bold;'>$status</label>";
                                                                    }else{
                                                                        echo"<label style='color:red; font-weight:bold;'>$status</label>";
                                                                    }
                                                            ?>
                                                
                                                
                                                    </td>
                                                    <td><?php echo $customer_name;?></td>
                                                    <td><?php echo $customer_contact;?></td>
                                                    <td><?php echo $customer_email;?></td>
                                                    <td><?php echo $customer_address;?></td>
                                                    <td>
                                                        <a href="<?php echo SITE_URL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary-order">Update</a>
                                                    </td>
                        

                                            <?php
                                    }

                                
                                    
                                }else{

                                    //there is no data available
                                    echo "<tr><td colspan='12' class='failed'>There is no order yet.</td></tr>";
                                }
                        ?>
                   
                    </table>
    
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>