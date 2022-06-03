<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->

    <?php
            if(isset($_GET['category_id'])){
                //get the value of the id
                    $category_id = $_GET['category_id'];
                //sql query to get category title based on id
                $sql ="SELECT title FROM tbl_category WHERE id=$category_id ";
                $res = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_assoc($res);
                    $cat_title = $rows['title'];
            
            }

            //SQL query to get the foods that corresponds to the category id
            
    ?>

    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php  echo $cat_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                 //sql query to get the food from database that corresponds to the category id
                    $sql2 = "SELECT * FROM tbl_food WHERE active ='Yes' AND featured ='Yes' AND category_id=$category_id ";
                    $res2 = mysqli_query($conn, $sql2);
                    $count = mysqli_num_rows($res2);
                    if($count >0 ){
                           while( $rows2 =mysqli_fetch_assoc($res2)){

                            $id =$rows2['id'];
                            $title = $rows2['title'];
                            $price = $rows2['price'];
                            $description = $rows2['description'];
                            $image_name = $rows2['image_name'];

                            ?>
                                    <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title;?></h4>
                                        <p class="food-price"><?php echo $price;?> PHP</p>
                                        <p class="food-detail">
                                           <?php echo $description;?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITE_URL;?>order.php?id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                            <?php
    
                           }
                            
                    }else{
                        echo"<div class='failed'>No Food found in this category</div>";
                    }
            ?>

            <div class="clearfix"></div>

        
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>