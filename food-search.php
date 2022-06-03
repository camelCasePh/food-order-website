<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <?php
     //Get the search keyword
     $search = $_POST['search'];
     ?>
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
               

                //Sql query to get foods based on search keyword
                $sql = " SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                
                if($count > 0){
                    //food available
                    while($rows = mysqli_fetch_assoc($res)){
                        $id =$rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name = $rows['image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name;?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price;?> PHP</p>
                                    <p class="food-detail">
                                       <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITE_URL;?>order.php?id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php


                    }
                }else{
                    //food not available.
                    echo "<div class='failed'>Food not Found.</div>";
                }
           ?>

    
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>