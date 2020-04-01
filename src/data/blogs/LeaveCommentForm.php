<?php 
if(isset($_POST['Submit']) && isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Message']) ){
    $name=$_POST['Name'];
    $email=$_POST['Email'];
    $message=$_POST['Message'];
    $blogId=$_COOKIE['blog_id'];
    $query="INSERT INTO `comments`(`comment_name`, `comment_body`, `comment_email`, `blog_id`) VALUES ('$name','$message','$email',$blogId)";
    $result = mysqli_query($link, $query);
    if($result){
		echo "<script>alert('Your comment is submited successFully')</script>";
	}else{
		echo "<script>alert('Your comment is not submited successFully, Please try again !!')</script>";
	}
}

?>
<form action="#" method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="Name" placeholder="Name" required="">
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="Email" placeholder="Email" required="">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="Message" placeholder="Message..." required=""></textarea>
    </div>
    <button type="submit" name="Submit" class="btn btn-primary submit">Submit Your Comment</button>
</form>