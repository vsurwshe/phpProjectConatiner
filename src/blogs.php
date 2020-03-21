<!DOCTYPE html>
<?php 
 include("./data/db/db.php");
?>
<html lang="zxx">

<head>
    <title>V & Y | Blogs</title>
    <?php include('./data/head/Head.php'); ?>
</head>

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
    <!-- //footer -->
</body>

</html>