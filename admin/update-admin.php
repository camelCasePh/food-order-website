<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <div class="cardview">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            // 1.get the id of selected admin

            $id = $_GET['id'];

            //2. create sql query to get the details

            $sql= "SELECT * FROM tbl_admin  WHERE id=$id";

            //3. Execute the query

            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
                
                //check whether the data is available
               $count = mysqli_num_rows($res);
               //check whether we have data or not
               if($count == 1){
                        //get the details
                       $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];

              
               }else{
                   //redirect to manange admin page

                   header('location:'.SITE_URL.'admin/manage-admin.php');

               }
            }
        
        ?>

        <form action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name?>"required>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>"required>
                    </td>
                </tr>
              
                    <td colspan="2"> 
                        <input type="hidden" name="id" value ="<?php echo$id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-update-admin">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</div>

<?php
        //check whether the submit button is clicked or not

        if(isset($_POST['submit'])){
            
            // get all the value/data from form to update
            $id=mysqli_real_escape_string($conn,$_POST['id']);
            $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
            $username=mysqli_real_escape_string($conn,$_POST['username']);

            // create a sql query to update admin
            $sql = "UPDATE tbl_admin SET
            full_name ='$full_name',
            username ='$username'
            WHERE id='$id'
            ";
            //execute query
           
               $res=mysqli_query($conn,$sql);

            //check whether the query is executed properly or not

            if($res == TRUE){
                //creating session variable to print success message
                $_SESSION['update'] = "<div class='success'> Updated Sucessfully</div>";

                //redirecting to manage admin page
                header('location:'.SITE_URL.'admin/manage-admin.php');

            }else{
                  //creating session variable to print success message
                  $_SESSION['update'] = "<div class='failed'> Updated Failed</div>";

                  //redirecting to manage admin page
                  header('location:'.SITE_URL.'admin/manage-admin.php');
            }
          
            
        }
?>
<?php include('partials/footer.php')?>