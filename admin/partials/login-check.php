<?php
    //checked whether the user is logged in or not
    if(!isset($_SESSION['admin-user'])){ // if user admin session is not set

        //user is not logged in

        //redirect user to the login page
        $_SESSION['user-not-logged-in']="<div class='failed text-align-center'>Please Login to Enter Admin Panel!</div>";
        header('location:'.SITE_URL.'admin/login.php');
    }
?>