<div class="col-lg-8 left-blog-info text-left">
<div class="blog-grid-top">
    <div class="b-grid-top">
        <div class="blog_info_left_grid">
            <a href="blogs.php">
                <img src="images/bg.jpg" class="img-fluid" alt="">
            </a>
        </div>
    </div>
    <hr/>
    <h3> <a href="blogs.php" class="single-text text-dark font-weight-light txt2" id="blogs_heading"> Sorry No Blogs Available....! </a></h3>
    <hr/>
    <span id="blogs_body" class="blogs_body"></span>
    <span id="blogs_writer" class="float-right"></span>
<!--     
    <p>Blogs Starting Informations </p>
    <p class="my-3">Blogs Sub Points</p>
    <p>Blgos Sub points Infomrations
        <span class="text-danger"> Highlating Text</span>
    </p> -->
    <!-- <div class="offset-lg-2 mt-5">
        <p> </p> -->
        <!-- <p class="my-3">Ullamco labor nisi ut aliquip exea commodo consequat duis aute irudre dolor
            in elit sed uta
            labore dolore reprehender</p>
        <p>Jabore et dolore magna aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea <span class="text-danger">commodo consequat duis aute irudre dolor in elit sed uta labore dolore reprehender</span>
        </p> -->
    <!-- </div> -->
    <!-- <h2 class="mt-3">
        <a href="blogs.php" class="single-text text-dark font-weight-light"> Blogs Ending Title</a>
    </h2>
    <p class="my-3"> Blogs Ending Details Informations</p>
    <p></p> -->
</div>

<div class="comment-top mt-4" >
<h4>Comments</h4>
<br/>
<div class="media">
        <div class="media-body pt-xl-2 pl-3" id="commentBlog">
    <?php
    //  include('./data/blogs/Comment.php');
     ?>
    </div>
</div>
    <!-- <div class="media">
        <img src="images/te3.jpg" alt="" class="img-fluid rounded" />
        <div class="media-body  pt-xl-2 pl-3">
            <h5 class="mb-2">Goh James</h5>
            <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. id dignissim sapien velit id felis ac cursus eros. Cras a ornare elit.</p>
        </div>
    </div> -->
</div>
<div class="comment-top mt-5">
    <h4>Leave a Comment</h4>
    <hr />
    <div class="comment-bottom">
    <?php include('./data/blogs/LeaveCommentForm.php');?>
    </div>
</div>
</div>