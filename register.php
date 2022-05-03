<?php include('config/constants.php');?>
<html>
    <head>
        <title>Register</title>
        <body>
          <form action="" method="POST">
        <input type="submit" name="submit" value="go to home page">
        </form>
    <?php
      if(isset($_POST['submit'])){
        
        header("location:".SITE_URL.'index.html');
      }
    ?>
          

           
        
        </body>
</html>