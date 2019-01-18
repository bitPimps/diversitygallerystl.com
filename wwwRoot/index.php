<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<title>Diversity Gallery</title>
		<?php include_once("inc/meta-data.php"); ?>
		<link rel="stylesheet" href="css/carousel.css" />
	</head>
	<body>
		<?php include_once("inc/nav-main.php"); DrawNavMain("Home"); ?>
		<div class="jumbotron">
			<!-- Carousel -->
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="first-slide img-responsive" src="img/carousel/jewelry.jpg" alt="Beautifully Handcrafted Jewelry">
					</div>
					<div class="item">
						<img class="first-slide img-responsive" src="img/carousel/clothing.jpg" alt="Clothing &amp; Beauty Care">
					</div>
					<div class="item">
						<img class="first-slide img-responsive" src="img/carousel/proud.jpg" alt="St. Louis Proud">
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div><!-- /.carousel -->
		</div><!-- /jumbotron -->
		<main role="main">
			<div class="band">
				<div class="container">
					<h1 class="text-uppercase heading-1">
						<span>Celebrate Diversity with Us!</span>
					</h1>
					<div class="row">
						<div class="col-md-4">
							<h2>Welcome to Diversity Gallery, a place for natural beauty and hair care, art, and jewelry!</h2>
							<p>Diversity Gallery was created in 2000 as a place to empower our community to reach its highest potential. We do more than just sell products &mdash; we offer a lifestyle, one that encourages others to feel beautiful and uniquely themselves. Over the years, and with a lot of support from our family and friends, Diversity Gallery has grown into a cultural St. Louis institution, a place that offers something for everyone.</p>
							<p><a href="about/index.php" class="btn btn-lg btn-success" role="button">Learn more</a></p>
						</div>
						<div class="col-md-8">
							<div class="thumbnail">
								<img src="img/leslie-christian-wilson.jpg" alt="Leslie Christian-Wilson">
								<div class="caption text-right">
									<p class="text-muted"><small>Owner, natural hair stylist, and jewelry designer Leslie Christian-Wilson</small></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="band">
				<div class="container">
					<h1 class="text-uppercase heading-1">
						<span>Products and Services</span>
					</h1>
					<div class="row">
						<div class="col-md-3">
							<div class="thumbnail">
								<img src="img/hair-station.jpg" class="img-rounded" alt="">
								<div class="caption">
									<h3>Natural Hair Styling</h3>
									<p>Embrace your hair's natural beauty with locs, twisting, two strands, and braiding without the use of any chemicals.</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img src="img/necklace.jpg" class="img-rounded" alt="">
								<div class="caption">
									<h3>Jewelry</h3>
									<p>Like color? Choose from our standout collection of beautiful, affordable, and unique jewelry.</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img src="img/art.jpg" class="img-rounded" alt="">
								<div class="caption">
									<h3>Local &amp; African Art</h3>
									<p>Incredible art from St. Louis and faraway West Africa, highlighting a rich and diverse heritage.</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img src="img/products.jpg" class="img-rounded" alt="">
								<div class="caption">
									<h3>Hair, Body, and Skin Products</h3>
									<p>Brands include Diversity Naturals, Skylarlicious Naturals For Kids, Carol's Daughter, Miss Jessie's, and Mixed Chicks. Handcrafted Incense and Oils, Featuring Body Kandy.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include_once("inc/footer.php"); ?>
	</body>
</html>