<?php function DrawNavMain($navMainOn) { ?>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="topnavbar">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-left" href="/index.php">
							<img src="/img/diversity-gallery.png" alt="Diversity Gallery" class="img-responsive">
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<!--<li<?php if($navMainOn=="Products"){?> class="active"<?php } ?>><a href="/products/index.php">Products</a></li>-->
							<li<?php if($navMainOn=="Events"){?> class="active"<?php } ?>><a href="/events/index.php">Events</a></li>
							<li<?php if($navMainOn=="About"){?> class="active"<?php } ?>><a href="/about/index.php">About</a></li>
							<li<?php if($navMainOn=="Contact"){?> class="active"<?php } ?>><a href="/contact/index.php">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav><!-- /nav-main -->
			<div class="info-bar">
				<div class="container">
					<em>A St. Louis fixture since 2000</em>
				</div>
			</div>
<?php } ?>