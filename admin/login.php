<?php include('../config/constants.php') ?>
<html>
    <head>
         <title>Log in - Harris Food</title>
         <link rel="stylesheet" href="../css/admin.css">
         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Radio+Canada:wght@300&display=swap" rel="stylesheet">
</head>
    <body class="login-background">

        <div class="login">
            <br>
            <h1 class=" text-align-center">Admin Panel</h1>
            <br> 
            <?php
            if(isset($_SESSION['login-failed'])){
                echo $_SESSION['login-failed'];
                unset($_SESSION['login-failed']);
            }
             if(isset($_SESSION['user-not-logged-in'])){
                echo $_SESSION['user-not-logged-in'];
                unset($_SESSION['user-not-logged-in']);
            }
            ?>
          
            <!-- login form start here-->
                <form action="" method="POST">
                    <div class="login-form-label"> Username</div>
                   <div class="text-align-center">
                   <input type="text" name="username" placeholder="" required >
                   </div>
                    <div class="login-form-label"> Password</div> 
                   <div class="text-align-center"><input type="password" name="password" placeholder="" required></div>
                    <br>
                    <div class="text-align-center">
                    <input type="submit" name="submit" value="Login" class="login-button btn-primary">

                    </div>
                </form>
             <br><br>
            <!--Login form ends here-->
            <br>
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
                  
                       $_SESSION['admin-user']=$username; //this session variable will be used in menu page to check whether the user is log in or not   
                       header('location:'.SITE_URL.'admin/index.php');
                    }
                    
                    else{
                        //Create a session variable to print failed to login message
                        $_SESSION['login-failed']="<div class='failed text-align-center'>No such Account. Try again.</div>";
                        header('location:'.SITE_URL.'admin/login.php');
                    }
                    
    }

      

    
?>