<?php include('partials-front/menu.php');?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                    //create sql query to get all the categories from the database
                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' ";

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
                                   <a href="<?php echo SITE_URL;?>/category-foods.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">

                                        <?php
                                                if($image_name ==""){
                                                    //image not available
                                                    echo " <div class='failed'>Image is not available.</div>";
                                                }else{
                                                    ?>
                                                     <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                                    <?php
                                                }
                                        ?>
                                       

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


    <?php include('partials-front/footer.php');?>