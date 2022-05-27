
        <?php include('partials/menu.php')?>
        <!--menu ends here-->
        <div class="main-content">
            <div class="wrapper">
                    <h1>Manage admin</h1>
                    <!-- Button to add Admin-->
                    <?php 

                       if(isset($_SESSION['add-admin-message'])){
                            echo $_SESSION['add-admin-message']; //Displaying session message
                            unset($_SESSION['add-admin-message']); //Removing session message
                    }

                        if(isset($_SESSION['delete'])){
                            echo $_SESSION['delete'];
                             unset($_SESSION['delete']);
                        }
                        if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                        if(isset($_SESSION['user_not_found'])){
                            echo $_SESSION['user_not_found'];
                            unset($_SESSION['user_not_found']);
                        }
                           if(isset($_SESSION['pwd-not-match'])){
                            echo $_SESSION['pwd-not-match'];
                            unset($_SESSION['pwd-not-match']);
                        }
                           if(isset($_SESSION['update-password'])){
                            echo $_SESSION['update-password'];
                            unset($_SESSION['update-password']);
                        }
                            

                    ?>
                        <br><br><br>
                       <a href="add-admin.php" class="btn-primary">Add Admin</a>
                    
                       <br> <br>
                    <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Full name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>

                        <?php 
                            //Query to get all admin
                            $sql = "SELECT * FROM tbl_admin";
                            //Execute the query
                             $res = mysqli_query($conn, $sql);

                             //check whether the query is executed or not
                             if($res == TRUE){
                                
                                //count rows whether we have data in database or not
                                $count = mysqli_num_rows($res);

                                $sn=1;
                                
                                //check the number of rows
                                if($count>0){
                                        // we have data in rows
                                    
                                        while($rows=mysqli_fetch_assoc($res)){
                                            //using while loop to get all the data from the database
                                            //while loop will run as long as we have data in the database

                                            //get individual data
                                            $id=$rows['id'];
                                            $full_name=$rows['full_name'];
                                            $username=$rows['username'];
                                        
                                            //Display the values in our table

                                            ?>
                                                    <tr>
                                                        <td><?php echo$sn++;?></td>
                                                        <td><?php echo"<div class='admin-table-data'> $full_name</div>"; ?></td>
                                                        <td><?php echo"<div class='admin-table-data'> $username</div>"; ?></td>
                                                        <td>
                                                            <a href="<?php echo SITE_URL;?>admin/update-password.php ? id=<?php echo $id;?>" class="btn-change-password">Change password</a>
                                                            <a href="<?php echo SITE_URL;?>admin/update-admin.php ? id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                                            <a href="<?php echo SITE_URL;?>admin/delete-admin.php ? id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                        }
                                }else{
                                    //we dont have data in rows
                                    echo " we dont have data in rows";

                                }
                             }
                        ?>
                       
                    </table>
    
            </div>
        </div>
            <!--main-content ends here-->

            <?php include('partials/footer.php')?>