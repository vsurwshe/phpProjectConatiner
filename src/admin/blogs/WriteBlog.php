<head>
<script src="../../js/jquery.min.js"></script>  
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/admin-blog-form.css">
</head>
<body>
<div class="inner contact">
    <div class="contact-form">
      <!-- Form -->
      <?php 
      if(isset($_GET["data"])){
        $blog_id=$_GET["data"];
        include("../../data/db/db.php");
        $blogName="";
        $blogWriter="";
        $blogPath="";
        $blogCatgoreies="";
        $firstBlogsResult = mysqli_query($link, "SELECT * FROM `blogs` WHERE `blog_id`=$blog_id") or die("Query not executed");
        while ($row = mysqli_fetch_array($firstBlogsResult)) {
          $blogName=$row["blog_name"];
          $blogWriter=$row["blog_writer"];
          $blogPath=$row["blog_path"];
          $blogCatgoreies=$row["categorise"];
        }
      }
      ?>
      <form id="blogs" method="post" action="SaveBlog.php">
        <!-- Left Inputs -->
        <center>
          <h2>Admin Write Your Blog</h2>
        </center>
        <div class="col-xs-12  animated" data-wow-delay=".5s">
           <input type="hidden" id="blogId" name="blogId" value="<?php echo $blog_id; ?>" />
          <!-- Title -->
          <input type="text" name="blogtitle" id="blogtitle" required="required" class="form" value="<?php echo $blogName;?>" placeholder="Enter blog title"/>
          <!-- Name -->
          <select 
          name="blogwriter" 
          id="blogwriter" 
          value="Vishva"
          required="required" 
          placeholder="Choose the blog writer"
          class="select">
            <option value="Mr.Yogesh Rakhewar(Software Developer)">Yogesh</option>
            <option value="Mr.Vishvanath Surwshe(Full-Stack Developer)">Vishva</option>
          </select>
          <!-- Categoreies -->
          <input 
          type="text" 
          name="categoreies" 
          id="categoreies" 
          required="required" 
          value="<?php echo $blogCatgoreies;?>"
          class="form"
          placeholder="Enter blog categoreies" />
          <!--Blog Body Conetnt Write -->
          <textarea name="blogbody" id="blogbody" class="form textarea" placeholder="Enter blog content">
          <?php echo $blogPath != "" ?  file_get_contents($blogPath) : file_get_contents("../../developerblogs/Structure.html");?>
          </textarea>
        </div><!-- End Left Inputs -->
        <!-- Bottom Submit -->
        <div class="relative fullwidth col-xs-12">
        <button type="submit" id="submit" name="submit" class="form-btn semibold">
          <?php echo $blogPath != "" ? "Update Blog" :"Save Blog"; ?>
        </button>  &nbsp;
        <button type="button" id="cancle" name="cancle" onClick="cancle()" class="form-btn">Cancle</button>  
        </div><!-- End Bottom Submit -->
        <!-- Clear -->
        <div class="clear"></div>
      </form>
      <script>
        $(document).ready(function(){ 
            $("#cancle").click(function(){
              location.href="./index.php";
            })
        });
  </script>
      <div class="mail-message-area">
        <div class="alert gray-bg mail-message not-visible-message">
          <strong>Thank You !</strong> Your blog has been saved.
        </div>
      </div>
    </div><!-- End Contact Form Area -->
  </div><!-- End Inner -->
</body>