<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="title" placeholder="Category Title">
                            </td>

                    </tr>
                    <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes"> Yes
                                <input type="radio" name="featured" value="No"> No
                            </td>

                    </tr>
                    <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes"> Yes
                                <input type="radio" name="active" value="No"> No
                            </td>

                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Category" class="btn-category">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</div>

<?php 
    // check whether the button is clicked or not

    if(isset($_POST['submit'])){

        echo "is clicked";
    }
?>
<?php include('partials/footer.php')?>