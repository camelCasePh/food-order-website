
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
        if(isset($_SESSION['delete-category'])){
            echo $_SESSION['delete-category'];
            unset($_SESSION['delete-category']);   
       }
       if(isset($_SESSION['delete-category-image'])){
        echo $_SESSION['delete-category-image'];
        unset($_SESSION['delete-category-image']);   
   }
   if(isset($_SESSION['update-category'])){
    echo $_SESSION['update-category'];
    unset($_SESSION['update-category']);   
}
if(isset($_SESSION['failed-to-remove'])){
    echo $_SESSION['failed-to-remove'];
    unset($_SESSION['failed-to-remove']);   
}
        ?><br>
                    <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                    <br> <br>
                    <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                            //Query to get all the categories to the database
                            $sql = "SELECT * FROM tbl_category";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //count rows
                            $count = mysqli_num_rows($res);
                            //create serial number variable
                            $sn=1;
                            //Check whether we have data in database or not
                            if($count > 0){
                                // we have data in database
                                // get the data and display
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title =$row['title'];
                                    $image_name= $row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];

                                    ?>
                                        <tr>
                                    <td><?php echo$sn++;echo".";?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php 
                                    
                                    if($image_name!=""){
                                        
                                        ?>
                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name;?>"width="150px">
                                        <?php
                                    }else{
                                       // echo "<div class='failed'> Image not Added.</div>";
                                     
                                    }
                                    
                                    ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                    <a href="<?php echo SITE_URL;?>admin/update-category.php? id=<?php echo $id;?>" class="btn-secondary-delete-update" >Update Category</a>
                                    <a href=" <?php echo SITE_URL;?>admin/delete-category.php? id=<?php echo $id;?>&image_name=<?php echo $image_name;?> " class="btn-danger-delete-update">Delete Category</a>
                                    </td>
                                    
                                    <?php

                                }

                            }else{
                                //We dont have data in the database        
                                ?>
                                <tr>
                                    <td colspan="6"><div class="failed">No Category Added</div> </td>
                                </tr>

                                <?php          
                                }
                        
                        ?>
                    
                    </table>
    
    
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>
      