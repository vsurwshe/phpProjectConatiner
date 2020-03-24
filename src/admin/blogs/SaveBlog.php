<!DOCTYPE html>
<?php
include_once("../../data/db/db.php");
if(isset($_POST["submit"]) && isset($_POST["blogtitle"]) && isset($_POST["blogwriter"]) && isset($_POST["blogbody"])){
    $title=$_POST["blogtitle"];
    $witerName=$_POST["blogwriter"];
    $body=htmlspecialchars($_POST["blogbody"]) ;
    echo nl2br("\n$title\n------\n$witerName\n-----\n$body");
     //Save File
     $dir_path = "/developerblogs/";
     $fileName = $_SERVER['DOCUMENT_ROOT'].$dir_path.$_POST["blogtitle"].".html";
     $file = fopen($fileName,"a+") or die(" Sorry File not created");
     file_put_contents($fileName, $_POST["blogbody"]);
    // fwrite($f, $body);
    if($file)
    {
        $insertQuery="INSERT INTO `blogs`(`blog_name`, `blog_writer`, `blog_path`) VALUES ('$title','$witerName','$fileName')";
        $result = mysqli_query($link,$insertQuery);  
        if($result >0){
            echo "<script>alert('Your Data is Inserted SuccessFully'); location.replace('index.html');</script>";
        }else{
            echo "<script>alert('Your Data is Not Inserted SuccessFully');location.replace('index.html');</script>";
         }   
    }
    fclose($file);
}else{
    echo "<script>alert('Sorry your blog file not save'); location.replace('index.html');</script>";
}
?>