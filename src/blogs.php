<!-- <!DOCTYPE html> -->
<?php 
 include("./data/db/db.php");
?>
<html lang="english">

<head>
    <title>V & Y | Blogs</title>
    <?php include('./data/head/Head.php'); ?>
</head>
<script>
function loadBody(url,blog_title,blog_writer,blog_id){
    if(url){
        document.cookie="blog_id = "+blog_id;
        let newUrl=url.split("/var/www/html/");
        $(".txt2").text(blog_title);
        $(".blogs_body").load(newUrl[1]);
        $("#blogs_writer").text("- "+blog_writer);
        localStorage.setItem('blog_id',blog_id);
        $.ajax({
             type:'POST',
             url:'./data/blogs/Comment.php',
             dataType: 'html',
             data:{
                 blog_id:blog_id
             },
             success: function(html){
                 $("#commentBlog").html(html);
             }
            });
    }
}
</script>

<body>
    <header>
        <?php include('./data/navbar/NavBar.php'); ?>
    </header>
    <!-- banner -->
    <div class="banner-w3ls-2">
    </div>
    <!-- //banner -->
    <!-- page details -->
    <div class="breadcrumb-agile">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
        </ol>
    </div>
    <!-- //page details -->
    <!-- single -->
    <div class="blog-w3l pt-5">
        <div class="container pt-xl-5 pt-lg-3">
            <h3 class="title-w3 mb-sm-5 mb-4 text-dark text-center font-weight-bold">Our Blogs</h3>
            <!-- <p class="title-para text-center mx-auto mb-sm-5 mb-4">Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat, dolor sit amet consectetur elit.</p> -->
            <div class="row blog-content">
                <!-- left side -->
                <?php include('./data/blogs/LeftSide.php'); ?>
                <!-- //left side -->
                <!-- right side -->
                <?php include('./data/blogs/RightSide.php'); ?>
                <!-- //right side -->
            </div>
        </div>
    </div>
    <!-- //blog -->
    <!-- footer -->
    <?php include("./data/footer/Footer.php") ?>
    <script>
    $(document).ready(function(){
        var blogArray=[<?php echo json_encode($josnarray,true) ?>];
        if(blogArray.length>0 && blogArray[0] !== null ){
            localStorage.setItem('blog_id',blogArray[0].blog_id);
            document.cookie="blog_id = "+blogArray[0].blog_id;
            let newUrl=blogArray[0].blog_path.split("/var/www/html/");
            $(".txt2").text(blogArray[0].blog_name);
            $(".blogs_body").load(newUrl[1]);
            $("#blogs_writer").text("- "+blogArray[0].blog_writer);
            $.ajax({
             type:'POST',
             url:'./data/blogs/Comment.php',
             dataType: 'html',
             data:{
                 blog_id:blogArray[0].blog_id
             },
             success: function(html){
                 $("#commentBlog").html(html);
             }
            });
        }
        $("#leaveForm").submit(function(event){
            event.preventDefault();
            console.log("Hi ",$("#Name").val(),$("#Email").val(),$("#Message").val())
            $.ajax({
                type:'POST',
                url:'./data/blogs/SubmitCommentForm.php',
                data:{
                    Name:$("#Name").val(),
                    Email:$("#Email").val(),
                    Message:$("#Message").val(),
                    BlogId:localStorage.getItem('blog_id')
                },
                success:function(data){
                    $("#commentResult").text(data);
                    location.replace('blogs.php');
                }

            })
        });
    });
    </script>
    <!-- //footer -->
</body>
</html>