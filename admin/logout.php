<?php
//constants
    include('../config/constants.php');
 //1. destroy the session
 session_destroy(); // unset $_SESSION['admin-user]
 //redirect to login page
  header('location:'.SITE_URL.'admin/login.php');

?>