
<?php include('partials/menu.php');?>

    <?php
        //Check whether id is set or not
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //get all the details
            // sql query to get all the food details in the database if id is matched
            $sql2 = " SELECT * FROM tbl_food WHERE id = $id ";
            //execute the query
            $res2 =  mysqli_query($conn, $sql2);
            $rows2 = mysqli_fetch_assoc($res2);

            $title = $rows2['title'];
            $description = $rows2['description'];
            $price = $rows2['price'];
            $current_image = $rows2['image_name'];
            $current_category = $rows2['category_id'];
            $featured = $rows2['featured'];
            $active = $rows2['active'];

        }else{
            //redirect to manage food page
            header('location:'.SITE_URL.'admin/manage-food.php');

        }
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method ="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td> <input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description"  cols="30" rows="10" ><?php echo $description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price;?>">
                        </td>

                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                                <?php
                                    if($current_image == ""){
                                        //image is not available
                                        echo"<div class='failed'>Image is not Available</div>";
                                    }else{
                                        ?>
                                        <img src="<?php echo SITE_URL;?>/images/food/<?php echo $current_image;?>"width="150px">
                                        <?php
                                    }
                                ?>
                           
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Select New Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">

                           <?php
                                //get all the category data in the database
                                //sql query to get the data
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //Execute the query
                                 $res = mysqli_query($conn, $sql);
                                
                                //count the rows
                                $count = mysqli_num_rows($res);

                                if($count >0){

                                     
                                    //category is available
                                    while($rows= mysqli_fetch_assoc($res)){

                                        $category_title= $rows['title']; 
                                        $category_id = $rows['id'];
                                        
                                        ?>
                                        <option <?php if($current_category == $category_id){ echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                        
                                   
                                    }
                                }else{
                                    //category is not available
                                    echo " <option value='0'>Category not Available.</option>";
                                }

                              
                           ?>


                               
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                        <input <?php if($featured =="Yes"){echo"checked";}?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured =="No"){echo"checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                        <input <?php if($active=="Yes"){echo"checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo"checked";}?>  type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">

                            <input class="btn-primary"type="submit" name="submit" value="Update">
                        </td>
                    </tr>
                </table>

            </form>
            <?php
                if(isset($_POST['submit'])){
                    //get the current or update data from the form and store to the database
                   // echo "button click";

                   //1. get all the details from the form 
                            $id = $_POST['id'];
                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];
                            $current_image = $_POST['current_image'];
                            $category = $_POST['category'];

                            $featured = $_POST['featured'];
                            $active = $_POST ['active'];


                   //2. upload the image if selected
                        //check whether upload button is cliked or not
                            if(isset($_FILES['image']['name'])){
                                //button is clicked
                                $image_name = $_FILES['image']['name']; //new image name


                                //check whether the file is available or not
                                if($image_name !=""){
                                    //image is available
                                    //rename the image but first get the extension
                                    $tmp_ext = explode('.',$image_name);
                                    $ext=end($tmp_ext);
                                    $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;
                                       //source path current location of the image
                                       $src_path = $_FILES['image']['tmp_name'];
                                       //Destination path for the image to be uploaded
                                       $dest_path = "../images/food/".$image_name;
                                       
                                       //upload the image
                                       $upload = move_uploaded_file($src_path,$dest_path);
                                    // check whether the image is uploaded or not
                                        if($upload == false){
                                            //failed to upload

                                            //print session message
                                         //   $_SESSION['upload-food-image'] = "<div class='failed'>Failed to upload the image.</div>";
                                            //redirect to manage food
                                         //   header('location:'.SITE_URL.'admin/manage-food.php');
                                            //stop the process
                                            die();
                                        }

                                        //remove current image if available
                                             //3. d;ete the current image if new image is uploaded
                                        if($current_image !=""){
                                            //Current image is available
                                            //remove the image
                                            $remove_path = "../images/food/".$current_image;
                                            $remove = unlink($remove_path);

                                            //check whether the image is remove or not
                                            if($remove == false){
                                                //failed to removecurrent image
                                              //  $_SESSION['delete-food-image'] = "<div class='failed'>Failed to Remove Current image.</div>";
                                                //redirect to manage food
                                                 //   header('location:'.SITE_URL.'admin/manage-food.php');
                                                //stop the process
                                                die();
                                            }
                                        }

                                    }else{
                                        $image_name = $current_image;
                                    }
                            }else{
                                //button is not clicked
                                $image_name = $current_image;
                            }

                   

                    //4. update the food in the database
                            $sql3 = " UPDATE tbl_food SET
                                title = '$title',
                                description = '$description',
                                price = $price,
                                image_name ='$image_name',
                                category_id = $category,
                                featured = '$featured',
                                active = '$active'
                                WHERE id=$id
                            ";

                            //Execute the query
                            $res3 = mysqli_query($conn, $sql3);
                            //check whether the wuery is executed or not
                          if($res3 == true){
                                //query executed and food updated
                                
                               $_SESSION['update-foods'] = "<div class='success'>Food updated successfully.</div>";
                                       header('location:'.SITE_URL.'admin/manage-food.php');


                         }else{
                                //query is not executed
                                $_SESSION['update-foods'] = "<div class='failed'>Failed to update food.</div>";
                                header('location:'.SITE_URL.'admin/manage-food.php');
                         }

                    //5. redirect to manage food with session message

                }
            ?>
        
        </div>
    </div>
<?php include('partials/footer.php');?>