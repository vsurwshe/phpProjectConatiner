<?php 
    include_once("../db/db.php");
    $name=$_POST['Name'];
    $email=$_POST['Email'];
    $message=$_POST['Message'];
    $blogId=$_POST['BlogId'];
    $query="INSERT INTO `comments`(`comment_name`, `comment_body`, `comment_email`, `blog_id`) VALUES ('$name','$message','$email',$blogId)";
    $result = mysqli_query($link, $query);
    if($result){
		echo "Your comment is submited successFully";
	}else{
		echo "Your comment is not submited successFully, Please try again !!";
	}
?>
