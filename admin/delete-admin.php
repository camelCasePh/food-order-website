<?php

// include constants
    include('../config/constants.php');

//get the of ID admin to be deleted
 $id=$_GET['id'];
//create SQL query to delete admin
$sql ="DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res=mysqli_query ($conn,$sql);
//redirect to manage admin page with message (success/error)

if($res == TRUE){
    //Redirect to manage admin page
    header("location:".SITE_URL.'admin/manage-admin.php');
    //Creating session variable to display message
    $_SESSION['delete'] = "<div class='success'>Deleted Sucessfully</div>";

}
else{
    $_SESSION['delete'] = "<div class='failed'> Deleted Failed</div>";
  //Redirect to manage admin page
  header("location:".SITE_URL.'admin/manage-admin.php');
}
?>