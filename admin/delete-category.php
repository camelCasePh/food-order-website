<?php
        include('../config/constants.php');
        if(isset($_GET['id']) AND isset($_GET['image_name']))
        {
            //get the value and delete
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            //remove the physical image file if available

            if($image_name !=""){
                //image is available so remove it.

                $path ="../images/category/".$image_name;
                $remove = unlink($path);

                //if failed to remove file image then add error message and stop the process
                if($remove == false){

                $_SESSION['delete-category-image']="<div class='failed'>Failed to Delete Category Image</div>";
                header('location:'.SITE_URL.'/admin/manage-category.php');
                die();
                }
            }
            //Delete data from the database
            //SQL query to delete data from the database
            $sql = "DELETE FROM tbl_category WHERE id=$id";

            //Execute sql query
            $res=mysqli_query($conn,$sql);
            //check whether the data is deleted in the database or not
            if($res== true){
                //set sucess message
                $_SESSION['delete-category']="<div class='success'>Deleted Successfully.</div>";
                header('location:'.SITE_URL.'/admin/manage-category.php');
            }else{
                //set failed message
                 $_SESSION['delete-category']="<div class='failed'>Failed to Delete Category.</div>";
                 header('location:'.SITE_URL.'/admin/manage-category.php');
            }
            //Redirect to mage-category with message


        }else{
            //redirect to manage category page

            header('location:'.SITE_URL.'/admin/manage-category.php');
        }

?>