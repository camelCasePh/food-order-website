<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            Update Category
        </h1>
        <br>
                <?php
                        //check whether the id is set or not
                        if(isset($_GET['id'])){
                            //get the id and all other details

                            $id = $_GET['id'];

                            //create sql query to get all details
                            $sql = "SELECT * FROM tbl_category WHERE id =$id";
                            //execute query
                            $res = mysqli_query($conn, $sql);
                            
                            //count the rows to check whether the id is valid or not
                            $count = mysqli_num_rows($res);

                           if($count == 1){
                               //get all the data
                               $rows =mysqli_fetch_assoc($res);
                               $title = $rows['title'];
                               $current_image = $rows['image_name'];
                               $featured = $rows['featured'];
                               $active = $rows['active'];
                           }else{
                               //redirect to them manage category and display session message
                               $_SESSION['update-category'] ="<div class='failed'>Category not found.</div>";
                               header('location:'.SITE_URL.'admin/manage-category.php');
                           }
                        }
                        else{
                            //redirect to mage category
                            header('location:'.SITE_URL.'admin/manage-category.php');
                        }
                ?>
        <br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                    if($current_image !=""){

                                        //display the image
                                        ?>
                                            <img src="<?php echo SITE_URL;?>images/category/<?php echo $current_image; ?>" width = "100px">
                                        <?php
                                    }else{
                                            echo "<div class='failed'>Image not Added.</div>";
                                    }
                            ?>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td>
                           <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Feaured:</td>
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
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-update-category">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                //saving the updated data
                if(isset($_POST['submit'])){
                    //echo "clicked";
                    //get a;; the va;ues from form
                    $id=$_POST['id'];
                    $title = $_POST['title'];
                    $current_image =$_GET['current_image'];
            
                    $featured = $_POST['featured'];
                    $active =$_POST['active'];

                    //updating new image if selected
                    //check whether the image is selected or not

                    if(isset($_FILES['image']['name'])){
                            //get the image details
                            $image_name = $_FILES['image']['name'];


                            if($image_name !=""){
                                //image available
                                //upload the new image
                                     // Auto rename image
                            //get file extension (png, jpg, gif, etc.)
                            $ext = end(explode('.',$image_name));

                            $image_name="food_category_".rand(000,999).'.'.$ext;

                            $source_path=$_FILES['image']['tmp_name'];
                            $destination_path="../images/category/".$image_name;
                            $upload=move_uploaded_file($source_path,$destination_path);

                                if($upload == false){
                                        $_SESSION['upload-category-image'] = " <div class='failed'> Failed to upload the Image.</div>";
                                        //redirect to add-category page
                                        header('location:'.SITE_URL.'admin/add-category.php');
                                    //stop the process 
                                        die();
                                }
                                //remove the current image
                                if($current_image !=""){
                                $remove_path ="../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                //check whether the image is remove or not
                                //if failed then display a message and stop the process
                                if($remove == false){
                                    // failed to remove the image
                                    $_SESSION['failed-to-remove'] = "<div class='failed'>Faile to Remove the image.</div>";
                                    header('location:'.SITE_URL.'/admin/manage-category.php');
                                    die();//stop the process
                                 }
                                 }

                            }else{
                                $image_name = $current_image;
                            }

                    }else{

                        $image_name = $current_image;
                    }
                    //update the datbase
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name ='$image_name',
                        featured='$featured',
                        active ='$active'
                        WHERE id=$id
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);


                        //redirect to manage category with session message

                        //check whether executed or not

                        if($res2 == true){
                            //category updated
                            $_SESSION['update-category'] ="<div class='success'>Category Updated.</div>";
                            header('location:'.SITE_URL.'admin/manage-category.php');
                        }else{
                            //faield to update category
                            $_SESSION['update-category'] ="<div class='failed'>Failed to update category.</div>";
                            header('location:'.SITE_URL.'admin/manage-category.php');
                        }
                }
            ?>
    </div>
</div>

<?php include('partials/footer.php')?>