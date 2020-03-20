<!DOCTYPE html>
<?php 
 include("./data/db/db.php");
?>
<html lang="zxx">

<head>
    <title>V & Y | About US</title>
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
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
</div>
<!-- //page details -->


<div class="gallery pt-5">
		<div class="container pt-xl-5 pt-lg-3">
			<h3 class="title-w3 mb-sm-5 mb-4 text-dark text-center font-weight-bold">Products </h3>
			<p class="title-para text-center mx-auto mb-sm-5 mb-4">This our Company Product List, here gives a quick review of our company products which is sucessfully done.</p>
			<ul class="demo">
                <?php
                    $result = mysqli_query($link, "SELECT * FROM `product`");
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                
                <li>
					<div class="gallery-grid1">
						<img src='data:image/jpeg;base64,<?php echo base64_encode($row['data']) ?>' alt=" " class="img-fluid" />
						<div class="p-mask">
							<h4><?php echo $row['client_name']  ?></h4>
							<p><?php echo $row['compnay_name'] ?></p>
						</div>
					</div>
				</li>
                <?php
                    }
                ?>
            </ul>
        </div>
</div>
<!-- footer -->
<?php include("./data/footer/Footer.php") ?>
<!-- //footer -->
</body>
</html>