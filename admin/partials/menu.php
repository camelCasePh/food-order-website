<?php include('../config/constants.php')?>
<?php include('partials/login-check.php')?>
<html>
    <head>
        
        <title>Admin page</title>        
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Radio+Canada:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="menu">
           <div class="wrapper">
           <ul>
                <li>
                    <a id="home-btn" href="index.php">Home</a>
                    <a href="manage-admin.php">Admin</a>
                    <a href="manage-category.php">Category</a>
                    <a href="manage-food.php">Food</a>
                    <a href="manage-order.php">Order</a>
                     <a id="logout-btn" href="logout.php">Logout</a>
                </li>
            </ul>
            </div>


        </div>
