
        <?php include('partials/menu.php')?>
        <!--menu ends here-->
        <div class="main-content">
            <div class="wrapper">
                    <h1>Dashboard</h1>

                    <div class="col-4 text-align-center">
                        <?php
                            $sql= " SELECT * FROM tbl_category WHERE active ='Yes' AND featured='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                           
                        ?>

                        <h2><?php echo $count;?></h2>
                        <h5>Categories</h5>
                    </div>
                    <div class="col-4 text-align-center">
                        <?php
                                 $sql2= " SELECT * FROM tbl_food WHERE active ='Yes' AND featured='Yes'";
                                 $res2 = mysqli_query($conn, $sql2);
                                 $food_count = mysqli_num_rows($res2);
                        ?>
                    <h2><?php echo $food_count;?></h2>
                        <h5>Foods</h5>
                    </div>
                    <div class="col-4 text-align-center">
                    <?php
                                 $sql3= " SELECT * FROM tbl_order";
                                 $res3 = mysqli_query($conn, $sql3);
                                 $total_order = mysqli_num_rows($res3);
                        ?>
                    <h2><?php echo $total_order;?></h2>
                        <h5>Total Orders</h5>
                    </div>
                    <div class="col-4 text-align-center">
                    <?php
                            $sql4 = " SELECT sum(total) as Total FROM tbl_order WHERE status='Delivered'";
                            $res4 = mysqli_query($conn, $sql4);

                            $rows4 = mysqli_fetch_assoc($res4);

                            $revenue =$rows4['Total'];
                    ?>
                  
                    <h2>₱ <?php echo $revenue; ?></h2>
                        <h5>Revenue Generated</h5>
                    </div>
                  
                    <div class="clearfix"></div>
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>
      