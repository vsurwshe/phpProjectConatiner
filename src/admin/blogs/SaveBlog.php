<?php
include("../../data/db/db.php");
if(isset($_POST["submit"]) && isset($_POST["blogtitle"]) && isset($_POST["blogwriter"]) && isset($_POST["blogbody"])){
    // require "../../data/blogs/";
    $title=$_POST["blogtitle"];
    $witerName=$_POST["blogwriter"];
    $body=htmlspecialchars($_POST["blogbody"]) ;

    echo nl2br("\n$title\n------\n$witerName\n-----\n$body");

     //Save File
     $file = fopen($_POST["blogtitle"] & ".html","a+");
     file_put_contents($file, $body);
     $blobData=addslashes(file_get_contents($file));
     
     if($blobData == "")
    {   
        echo $blobData."Your File Not Created";
        exit();
    }else{
        $insertQuery="INSERT INTO `blogs`(`blogtitle`, `blogbody`, `blogwriter`) VALUES ($title,$witerName,$blobData)";
        $result = mysqli_query($link,$insertQuery);  
        if($result >0){
            echo "<script>alert('Your Data is Inserted SuccessFully')</script>";
        }else{
            echo "<script>alert('Your Data is Not Inserted SuccessFully')</script>";
         }
    }
    fclose($file);

}else{
    header("index.html");
}

?>