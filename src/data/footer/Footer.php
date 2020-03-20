<!-- footer -->
<footer>
		<div class="w3ls-footer-grids py-4">
			<div class="container py-xl-5 py-lg-3">
				<div class="row">
					<div class="col-lg-3 w3l-footer-logo text-center">
						<!-- logo -->
						<a class="navbar-brand font-weight-bold" href="index.php">
                            V & Y
						</a>
						<!-- //logo -->
					</div>
					<!-- button -->
					<div class="col-lg-5 w3l-footer text-lg-right text-center mt-3">
						<ul class="list-unstyled footer-nav-wthree">
							<li class="mr-3">
								<a href="index.php" >Home</a>
							</li>
							<li class="mr-3">
								<a  href="about.php">About Us</a>
							</li>
							<li class="mr-3">
								<a class="" href="gallery.php">Gallery</a>
							</li>
							<li class="mr-3">
								<a class="" href="product.php">Products</a>
							</li>
							<li class="mr-3">
								<a class="" href="contact.php">Contact Us</a>
							</li>
						</ul>
					</div>
					<!-- //button -->
					<!-- social icons -->
					<div class="col-lg-4 w3social-icons text-lg-right text-center mt-lg-0 mt-3">
						<ul>
							<li>
								<a href="https://www.facebook.com/VY-365604737344237" target="_blank" class="rounded-circle">
									<i class="fa fa-facebook-f"></i>
								</a>
							</li>
							<li class="px-2">
								<a href="#" class="rounded-circle">
									<i class="fa fa-google-plus"></i>
								</a>
							</li>
							<li>
								<a href="#" class="rounded-circle">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- //social icons -->
				</div>
				<div class="pt-lg-4 pt-3 text-center">
					<!-- copyright -->
					<p class="copy-right-grids mt-lg-1">© 2018 V & Y. All Rights Reserved | Design by
						<a href="" target="_blank">W3layouts</a>
					</p>
					<!-- //copyright -->
				</div>
			</div>
		</div>
	</footer>
    <!-- //footer -->
    
    <!-- Js files -->
	<!-- JavaScript -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- Default-JavaScript-File -->
	<script src="js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- fixed navigation -->
	<script src="js/fixed-nav.js"></script>
	<!-- //fixed navigation -->
	<!-- dropdown smooth -->
	<script>
		$(document).ready(function () {
				$(".dropdown").hover(
					function () {
						$('.dropdown-menu', this).stop(true, true).slideDown("fast");
						$(this).toggleClass('open');
					},
					function () {
						$('.dropdown-menu', this).stop(true, true).slideUp("fast");
						$(this).toggleClass('open');
					}
				);
			});
		</script>
	<!-- //dropdown smooth -->

	<!-- search plugin -->
	<!-- pop-up-box -->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquery.magnific-popup.js"></script>
	<!-- //pop-up-box -->
	<!-- search script -->
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- //search script -->
	<!-- //search plugin -->

	<!-- gallery -->
	<script src="js/jquery.picEyes.js"></script>
	<script>
		$(function () {
			//picturesEyes($('.demo li'));
			$('.demo li').picEyes();
		});
	</script>
	<!-- //gallery -->

	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- move-top -->
	<script src="js/move-top.js"></script>
	<!-- easing -->
	<script src="js/easing.js"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="js/inside.js"></script>

	<script src="js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->
	<!-- //Js files -->

