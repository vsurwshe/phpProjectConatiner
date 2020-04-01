<div class="col-lg-8 left-blog-info text-left">
<div class="blog-grid-top">
    <!-- <div class="b-grid-top">
        <div class="blog_info_left_grid">
            <a href="blogs.php">
                <img src="images/bg.jpg" class="img-fluid" alt="">
            </a>
        </div>
    </div> -->
    <hr/>
    <h3> <a href="blogs.php" class="single-text text-dark font-weight-light txt2" id="blogs_heading"> Sorry No Blogs Available....! </a></h3>
    <hr/>
    <span id="blogs_body" class="blogs_body"></span>
    <span id="blogs_writer" class="float-right"></span>
</div>

<div class="comment-top mt-4" >
<h4>Comments</h4>
<br/>
<div class="media">
        <div class="media-body pt-xl-2 pl-3" id="commentBlog"></div>
</div>
</div>
<div class="comment-top mt-5">
    <h4>Leave a Comment</h4>
    <hr />
    <h3 id="commentResult"></h3>
    <div class="comment-bottom">
    <form id="leaveForm" method="POST">
        <div class="form-group">
            <input class="form-control" type="text" name="Name" id="Name" placeholder="Name" required="">
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="Email" id="Email" placeholder="Email" required="">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="Message" id="Message" placeholder="Message..." required=""></textarea>
        </div>
        <button type="submit" name="Submit" class="btn btn-primary submit">Submit Your Comment</button>
    </form>
    </div>
</div>
</div>