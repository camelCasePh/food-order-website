<?php
        //start a session
        session_start();

         //Create constants to store non repeating values
        define('SITE_URL', 'http://localhost/food-order-website/');
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD','');
        define('DB_NAME','food-order');

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error()); //Database connection
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting database

?>