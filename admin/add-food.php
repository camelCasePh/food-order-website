<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br>
            <?php
        if(isset($_SESSION['upload-food'])){
            echo $_SESSION['upload-food'];
            unset($_SESSION['upload-food']);   
        }
     
        ?><br>

            <form action="" method="POST" enctype ="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder=" Title of the food" required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="30" rows="10" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td> <input type="file" name="image" required> </td>
                </tr>
                <tr>
                    <td>Category:</td>

                    <td>
                        <select name="category" required>

                        <?php 
                            //create php code to display category from the database

                            //create sql query to get all categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execute the query
                                $res = mysqli_query($conn, $sql);
                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            
                            if($count>0){
                                //we have categories
                                while($row = mysqli_fetch_assoc($res)){
                                    //get the details of the categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }

                            }else{
                                //we do not have categories
                                ?>
                               <option value="0">No category found.</option>
                                <?php
                            }
                              
                        ?>
                            
                          
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                     </td>
                    
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                     </td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
            </form>
            <?php
                //check whether the button is clicked or not
                if(isset($_POST['submit'])){
                    //echo "is clicked";
                    //button is clicked

                    //Add the food in the database

                    //1. get the data from the form
                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];
                            $category = $_POST['category'];
                           

                        // check whether the radio button for featured and active are clicked or not
                        if(isset($_POST['featured'])){
                            $featured = $_POST['featured'];
                        }else{
                            $featured = "No";
                        }
                        if(isset($_POST['active'])){
                            $active = $_POST['active'];
                        }else{
                            $active = "No";
                        }
                         

                    
                    //2. upload the image if selected

                        //check whether the select image is clicked or not and upload only if image is selected
                                if(isset($_FILES['image']['name'])){
                                // get the details of the selected image

                                    $image_name = $_FILES['image']['name'];

                                    // check whether the image is selected or not and upload on;y if selected
                                        if($image_name !=""){
                                            //image is selected

                                            //rename the image
                                                //get the extension of the selected image
                                                $ext = end(explode('.',$image_name));
                                                //create  new name for image

                                                $image_name="Food-Name-".rand(0000,9999).".".$ext;
                                            
                                            //source path current location of the image
                                            $src = $_FILES['image']['tmp_name'];
                                            //Destination path for the image to be uploaded
                                            $dst = "../images/food/".$image_name;
                                            
                                            //upload the image
                                            $upload = move_uploaded_file($src,$dst);
                                            if($upload == false){
                                                //failed to upload the image
                                                //redirect to add food page with error message
                                                $_SESSION['upload-food'] = "<div class='failed'>Failed to upload image.</div>";
                                               header('location:'.SITE_URL.'admin/add-food.php');
                                                die();
                                            }

                                        }

                                }else{
                                    $image_name = ""; //setting default value as blank
                                }
                    //3. insert the data to the database
                        //create sql query to save data to the database
                            $sql2 = "INSERT INTO tbl_food SET
                                    title = '$title',
                                    description = '$description',
                                    price = $price,
                                    image_name = '$image_name',
                                    category_id = '$category',
                                    featured ='$featured',
                                    active = '$active'
                            ";
                        //execute the query
                            $res = mysqli_query($conn,$sql2);

                            if($res == true){
                                //data inserted
                                $_SESSION['upload-food'] = "<div class='success'>Food Added Successfully.</div>";
                                header('location:'.SITE_URL.'admin/manage-food.php');
                            }else{
                                //failed to insert data
                                $_SESSION['upload-food'] = "<div class='failed'>Failed to add food.</div>";
                                header('location:'.SITE_URL.'admin/manage-food.php');
                            }
                    //4. redirect with message to manage food page

                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php') ?>