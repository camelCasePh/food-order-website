<?php
    echo "updating food";

    //check whether the id and image is set
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //image and id is set
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //echo $id ." ". $image_name;
        
    }else{
        //image and id is not set
    }
?>