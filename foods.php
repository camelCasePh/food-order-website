<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITE_URL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                    ///sql query to get all the food data in the database
                    $sql2 = " SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' ";

                    $res2 = mysqli_query($conn, $sql2);

                    $count = mysqli_num_rows($res2);
                    
                    if($count >0){
                        while($rows2 = mysqli_fetch_assoc($res2)){
                            $food_id = $rows2['id'];
                            $food_title = $rows2['title'];
                            $food_description = $rows2['description'];
                            $food_price = $rows2['price'];
                            $food_image_name =$rows2['image_name'];
                            $food_category_id = $rows2['category_id'];
                            

                            ?>
                                      <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <img src="<?php echo SITE_URL;?>images/food/<?php echo $food_image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4><?php echo $food_title;?></h4>
                                            <p class="food-price">₱ <?php echo $food_price;?></p>
                                            <p class="food-detail">
                                                     <?php echo $food_description;?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITE_URL;?>order.php?id=<?php echo $food_id?>" class="btn btn-primary">Order Now</a>
                                        </div>
                                       </div>
                            <?php
                        }
                    }else{
                        echo "<div class='failed'> Food Not Available.</div>";
                    }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>