<?php include('partials-front/menu.php'); ?>

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
    <?php
            if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                    //create sql query to get all the categories from the database
                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?>
                                   <a href="<?php echo SITE_URL;?>category-foods.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">
                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                                    </div>
                                    </a>
                            <?php
                        }
                    }
                    else{
                        echo " <div class='failed'>Category Not Added.</div>";
                    }
            ?>

         
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                    ///sql query to get all the food data in the database
                    $sql2 = " SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 2 ";

                    $res2 = mysqli_query($conn, $sql2);

                    $count = mysqli_num_rows($res2);
                    
                    if($count >0){
                        while($rows2 = mysqli_fetch_assoc($res2)){
                            $id = $rows2['id'];
                            $title = $rows2['title'];
                            $description = $rows2['description'];
                            $price = $rows2['price'];
                            $image_name =$rows2['image_name'];
                            $category_id = $rows2['category_id'];
                            

                            ?>
                                      <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4><?php echo $title;?></h4>
                                            <p class="food-price">₱ <?php echo $price;  ?></p>
                                            <p class="food-detail">
                                                     <?php echo $description;  ?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITE_URL;?>order.php?id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
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

        <p class="text-center">
            <a href="<?php SITE_URL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php  include('partials-front/footer.php');  ?>