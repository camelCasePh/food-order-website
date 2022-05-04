<?php include('partials/menu.php');?>
 <div class="main-content">
    <div class="wrapper">

        <br>
        <div class="cardview">
        <h1>CHANGE PASSWORD</h1>
        <br><br>
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
         ?>

        <form action="" method="POST">
            <table class="tbl-70">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-change-password">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
 </div>

 <?php
    if(isset($_POST['submit']))
    {
        //echo "clicked";
        //1.get data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        
        //2.check ether the user with the current ID and current password exist or not
        $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute the query

        $res=mysqli_query($conn, $sql);

        if($res==true)
        {
            //check whether the data is available or not

            $count= mysqli_num_rows($res);

                if($count==1)
                    {
                        //user exist and password can be changed
                      //  echo"user found";
                        //check whether the new password and confirm password match
                        if($new_password == $confirm_password){
                            //update the password
                           // echo "password match";

                         $sql2= "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                         ";
                         //execute the query
                         $res2 =mysqli_query($conn,$sql2);

                         //check whether the query execute or not
                            if($res2 ==true){
                                $_SESSION['update-password']="<div class='success'>Password Updated Successfully</div> ";
                                header('location:'.SITE_URL.'admin/manage-admin.php');
                            }
                            else{
                                 $_SESSION['update-password']="<div class='failed'>Password Update Failed</div> ";
                                header('location:'.SITE_URL.'admin/manage-admin.php');
                            }
                         

                        }else{
                            //redirect to manage admin page with error message
                            header('location:'.SITE_URL.'admin/manage-admin.php');
                             $_SESSION['pwd-not-match']= "<div class='failed'>Confirmation password does not match to the new password. Try again.</div>";
                        }

                    }else{

                        //user does not exist set message and redirect
                        $_SESSION['user_not_found']= "<div class='failed'>User Not Found. Check if the old password you've entered is correct.</div>";
                        header('location:'.SITE_URL.'admin/manage-admin.php');

                        }
        }
       
    }
        //3.checked wether the new password or current password match or not
        //4.change password if all above is true
    
 ?>
<?php include('partials/footer.php');?>