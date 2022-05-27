
        <?php include('partials/menu.php')?>
        <!--menu ends here-->
        <div class="main-content">
            <div class="wrapper">
                    <h1>Manage Categories</h1>
                    <br> <?php
         if(isset($_SESSION['add-category-message'])){
             echo $_SESSION['add-category-message'];
             unset($_SESSION['add-category-message']);   
        }
        ?><br>
                    <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                    <br><br>
    
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>
      