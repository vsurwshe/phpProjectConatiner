<?php 
if(isset($_POST["blogId"]) && isset($_POST["blogFile"])){
    include("../../data/db/db.php");
    $deleteId=$_POST["blogId"];
    $deleteFile=$_POST["blogFile"];
    $deleteQuery="DELETE FROM `blogs` WHERE `blog_id`=$deleteId";
    if(mysqli_query($link,$deleteQuery)){
        if(unlink($deleteFile)){
            echo "true";
        }else{
            echo "File is not deleted!!";
        }
    }else{
        echo "false";
        mysqli_error($link);
    }
}
?>