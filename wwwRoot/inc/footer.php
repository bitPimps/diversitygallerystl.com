<footer class="footer">
			<div class="social-container">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<nav class="nav-social">
								<a href="https://www.facebook.com/Diversity-Gallery-165486336802109/" class="facebook" target="_blank" title="Diversity Gallery on Facebook">
									<i class="fa fa-3x fa-facebook-official" aria-hidden="true"></i> <span class="sr-only">Diversity Gallery  on Facebook</span>
								</a>
								<a href="https://www.instagram.com/diversitygallerystl/" class="instagram" target="_blank" title="Diversity Gallery  on Instagram">
									<i class="fa fa-3x fa-instagram" aria-hidden="true"></i> <span class="sr-only">Diversity Gallery  on Instagram</span>
								</a>
							</nav>
							<a name="joinUpdates"></a>
							<?php
							$currUrl = htmlspecialchars($_SERVER["REQUEST_URI"]);
							if ($currUrl != "/contact/index.php") {
								$inc_path_root = $_SERVER['DOCUMENT_ROOT'];
								include_once($inc_path_root . "/inc/form-join.php");
							}
							?>
						</div>
						<div class="col-sm-4">
							<ul class="hours">
								<li><span class="days">Tue-Thu:</span> By Appointment.<br /><small>Please call us at 314-721-3361 to confirm someone will be available to service you.</small></li>
								<li><span class="days">Fri:</span> 1PM - 5PM</li>
								<li><span class="days">Sat:</span> 11PM - 4PM</li>
								<li><span class="days">Sun-Mon:</span> Closed</li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="phone">
								<li>Phone: <a href="tel:+13147213361">314.721.3361</a></li>
								<li>Fax: 314.721.4044</li>
							</ul>
							<address>
								<a href="https://goo.gl/maps/eVLZvHGKZf62" target="_blank">
								1010 N. Sarah St.<br />
								St. Louis, MO 63113
								</a>
							</address>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright-container">
				<div class="container">
					<p><small>&copy; Copyright Diversity Gallery <?php echo date("Y"); ?> | All rights reserved</small></p>
				</div>
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
		<script>
			$(window).scroll(function() {
				if ($(document).scrollTop() > 50) {
					$('.navbar-left > img').addClass('shrink');
					$('.navbar-nav').addClass('shrink');
				} else {
					$('.navbar-left > img').removeClass('shrink');
					$('.navbar-nav').removeClass('shrink');
				}
			});
			WebFontConfig = {
				google: {
					families: ['Cabin', 'Lato', 'Raleway']
				}
			};
			(function(d) {
				var wf = d.createElement('script'), s = d.scripts[0];
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
				wf.async = true;
				s.parentNode.insertBefore(wf, s);
			})(document);
		</script>