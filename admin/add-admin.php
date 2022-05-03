<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <div class="cardview">
      <h1>ADD ADMIN</h1>
          <?php 

                       if(isset($_SESSION['add'])){
                            echo $_SESSION['add']; //Displaying session message
                            unset($_SESSION['add']); //Removing session message
                    }

                    ?>
      <br><br>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>FULL NAME:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>USERNAME:</td>
                        <td><input type="text"  name="username" placeholder="Your Username">  </td>
                    </tr>
                    <tr>
                        <td>PASSWORD:</td>
                        <td><input type="password" name="password" placeholder="Your Password">  </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                        </td>
                    </tr>
                    

                </table>
            </form>
        </div>
        <br>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php
    //Process the value from form and save it to database

   //check weather the button is clicked or not
   if(isset($_POST['submit'])){

        //1. Get the data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        //2.SQL Query to insert the data into the database

        $sql="INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        //3.Execute query and save data to database
        $res= mysqli_query($conn, $sql) or die(mysqli_error());

        //check whether the (Query is executed) data is inserted or not
        if($res == TRUE){
            
            //data is inserted
            //create a session variable to display a message
            $_SESSION['add'] = "<div class='success'> Added successfully</div>";
            
               
            //Redirect page to manage admin page
            header("location:".SITE_URL.'admin/manage-admin.php');
        
     
        }else{
            //failed to insert data

              //create a session variable to display a message
            $_SESSION['add'] = "<div class='failed'> Failed to Add Admin</div>";
               
            //Redirect page to add admin page
            header("location:".SITE_URL.'admin/add-admin.php');
        
  
        }

   }


?>