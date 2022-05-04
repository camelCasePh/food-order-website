<?php include('../config/constants.php') ?>
<html>
    <head>
         <title>Log in - Harris Food</title>
         <link rel="stylesheet" href="../css/admin.css">

    </head>
    <body class="login-background">

        <div class="login">
            <h1 class=" text-align-center">Login</h1>
            <br> 
            <?php
            if(isset($_SESSION['login-failed'])){
                echo $_SESSION['login-failed'];
                unset($_SESSION['login-failed']);
            }
            ?>
            <br>

          

            <!-- login form start here-->
                <form action="" method="POST" class="text-align-center login-form-label">
                    Username:
                    <br><br>
                    <input type="text" name="username" placeholder="">
                    <br><br>
                    Password:
                    <br><br>
                    <input type="password" name="password" placeholder="">
                    <br><br>
                    <input type="submit" name="submit" value="Login" class="login-button btn-primary">
                </form>
                <br><br><br>
            <!--Login form ends here-->

            <p class="login-footer text-align-center ">Created by - <a href="https://www.facebook.com/HHB-Team-107144751990798" target="blank">HHB Team</a></p>
        </div>


    </body>
   
</html>
<?php 
    //check whether the submit/login button is clicked or not
    if(isset($_POST['submit'])){
        //echo " submit button is clicked";

        //process for log in
        //  1. get the data from the log in form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check the whether the username and password exist
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. Execute the Query 
        $res = mysqli_query($conn,$sql);

        //4. count whether the user exist or not

        $count=mysqli_num_rows($res);
        
                  if($count==1){
                  
                       header('location:'.SITE_URL.'admin/index.php');
                    }
                    
                    else{
                        //Create a session variable to print failed to login message
                        $_SESSION['login-failed']="<div class='failed text-align-center'>No such Account. Try again.</div>";
                        header('location:'.SITE_URL.'admin/login.php');
                    }
                    
    }

      

    
?>