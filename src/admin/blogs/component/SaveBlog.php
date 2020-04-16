<!DOCTYPE html>
<?php
include_once("../../../data/db/db.php");
if(isset($_POST["submit"]) && isset($_POST["blogtitle"]) && isset($_POST["blogwriter"]) && isset($_POST["blogbody"])){
    $title=$_POST["blogtitle"];
    $witerName=$_POST["blogwriter"];
    $categories=$_POST["categoreies"];
    $body=htmlspecialchars($_POST["blogbody"]) ;
    echo nl2br("\n$title\n------\n$witerName\n-----\n$body");
     //Save File
     $dir_path = "/developerblogs/";
     $fileNamePath = $_SERVER['DOCUMENT_ROOT'].$dir_path.$_POST["blogtitle"].".html";
     $fileName=str_replace(" ","",$fileNamePath);
     echo $fileName;
     $file = fopen($fileName,"a+") or die(" Sorry File not created");
     file_put_contents($fileName, $_POST["blogbody"]);
    // fwrite($f, $body);
    if($file)
    {
        if($_POST["blogId"] == ""){
            $insertQuery="INSERT INTO `blogs`(`blog_name`, `blog_writer`,`categorise`, `blog_path`) VALUES ('$title','$witerName','$categories','$fileName')";
        $result = mysqli_query($link,$insertQuery);  
        if($result >0){
            echo "<script>alert('Your blog is created successFully'); location.replace('../index.php');</script>";
        }else{
            echo "<script>alert('Your blog is not created');location.replace('../index.php');</script>";
         }
        }else{
            echo "<script>alert('Your blog is updated successFully'); location.replace('../index.php');</script>";
        }
    }
    fclose($file);
}else{
    echo "<script>alert('Sorry your blog file not save'); location.replace('../index.php');</script>";
}
?>