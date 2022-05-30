
        <?php include('partials/menu.php')?>

        <!--menu ends here-->
        <div class="main-content">
            <div class="wrapper">


                    <h1 class="page-name">Manage Food</h1>
                    <br>
                    <a href="<?php echo SITE_URL;?>/admin/add-food.php" class="btn-primary">Add Food</a>
                    <br><br>
                    <?php
                            if(isset($_SESSION['upload-food'])){
                                echo $_SESSION['upload-food'];
                                unset($_SESSION['upload-food']);   
                            }
                        
                     ?>
        <br><br>

        <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>

                        <?php 
                                //create a sql query to get all the food from the database
                                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                                //Execute the query
                                $res = mysqli_query($conn, $sql);

                                //count the data
                                $count = mysqli_num_rows($res);

                                //craete serial nuber
                                $sn=1;
                                //check whether there is a data or not
                                if($count>0){
                                        //there is a data in the database
                                        //print the data
                                        while($rows=mysqli_fetch_assoc($res)){

                                            //get the value from individual columns
                                            $id = $rows['id'];
                                            $title = $rows['title'];
                                            $price = $rows['price'];
                                            $image_name = $rows['image_name'];
                                            $featured =$rows['featured'];
                                            $active = $rows['active'];
                                            ?>
                                            <tr>
                                            <td><?php echo $sn++;?>.</td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php 
                                    
                                                if($image_name!=""){
                                                    
                                                    ?>
                                                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name;?>"width="100px">
                                                    <?php
                                                }else{
                                                    echo "<div class='failed'> Image not Added.</div>";
                                                }
                                                
                                                ?>
                                            </td>
                                            <td><?php echo $featured; ?></td>
                                            <td><?php echo $active; ?></td>
                                            <td>
                                            <a href="#" class="btn-secondary">Update Admin</a>
                                            <a href="#" class="btn-danger">Delete Admin</a>
                                            </td>
                                        </tr>
                                            <?php

                                        }
                                }else{
                                    //there is no food data in the databasse
                                    echo"<tr><td colspan='7' class='failed'>Food not Added Yet.</td></tr>";
                                }
                        ?>
                  
                   
                 
                                

                    
                    
                    </table>


    
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>