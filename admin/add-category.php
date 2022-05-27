<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <?php
        if(isset($_SESSION['add-category-message'])){
            echo $_SESSION['add-category-message'];
            unset($_SESSION['add-category-message']);   
        }
        if(isset($_SESSION['upload-category-image'])){
            echo $_SESSION['upload-category-image'];
            unset($_SESSION['upload-category-image']);   
        }
        ?>
         
        <br>
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="title" placeholder="Category Title" required>
                            </td>

                    </tr>
                    <tr>
                        <td>Upload Image:</td>
                        <td>
                            <input type="file" name="image" required>
                        </td>
                    </tr>
                    <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes"> Yes
                                <input type="radio" name="featured" value="No"> No
                            </td>

                    </tr>
                    <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes"> Yes
                                <input type="radio" name="active" value="No"> No
                            </td>

                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Category" class="btn-category">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</div>

<?php 
    // check whether the button is clicked or not

    if(isset($_POST['submit'])){

    

        // Get the value from category form
        $title = $_POST['title'];

         //check whether the image is selected or not and set the value for the image
        //  print_r($_FILES['image']);
        //  if(isset($_FILES['image']['name'])){
        //     //upload the image
        //     $image_name = $_FILES['image']['name'];
        //     $source_path = $FILES['image']['tmp_name'];
        //     $destination_path = "../images/category/".$image_name;

        //     //finally upload the image

        //     $upload = move_uploaded_file($source_path, $destination_path);
            //check whether the image is uploaded or not

        //     if($upload == false){
        //         $_SESSION['upload-category-image'] = " <div class='failed'> Failed to upload the Image.</div>";
        //         //redirect to add-category page
        //         header('location:'.SITE_URL.'admin/add-category.php');
        //         //stop the process 
        //         die();
        //     }

        // }else{
        //     //dont upload the image and set the image to blank
        //     $image_name = "";
        // }
        // for radio button, we need to check whether the button is clicked or not

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{

            //set default value to "NO"
            $featured = "No";
        }
       
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = "No";
        }

     //   print_r($_FILES['image']);
      //  die();
        
        if(isset($_FILES['image']['name'])){
            //upload the image
            $image_name=$_FILES['image']['name'];

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
        }else{
            $image_name = "";
        }

        //Create sql query to insert data into the database
            $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'";
        //Execute the query and save into the database
            $res = mysqli_query($conn, $sql);

        // check whether the query is executed or not or data added or not



            if($res == true){
                //Query executed and category added
                  $_SESSION['add-category-message'] = "<div class='success'>Category Added Sucessfully.</div>";
                  header('location:'.SITE_URL.'admin/manage-category.php');

                  
            } else{
                    // failed to add category      
                  $_SESSION['add-category-message'] = "<div class='failed'>Failed to Add Category.</div>";
                  header('location:'.SITE_URL.'admin/add-category.php');
              
            }

    }
?>
<?php include('partials/footer.php')?>