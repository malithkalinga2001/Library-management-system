<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- swiper css link  -->
		<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
		
		<!-- font awesome cdn link  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

		
		
		<style type=text/css>
		
			.homepagec{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 1000px;
				width: device-width;
			}
			
		</style>
</head>
	<body>
		<div class="adjust">
			<?php
				include 'header.php';
			?>
			<section class="homepagec" id="homepage">
				<div class="homeAd" align="center">
				<br/><br/><br/>
					<div class="boxes">
						<div class="homeAdBox1">
							<h2>Welcome to City Library</h2>
						</div>
						<div class="homeAdBox2">
							<div class="swiper home-slider">
								<div class="swiper-wrapper">
									<div class="swiper-slide slide" style="background:url(images/slide1.jpg) no-repeat">
										<div class="Slidecontent">
										   <span class="slideSpan">education, access, sustainability</span>
										   <h3>Provides great events</h3>
										   <a href="events.php" class="btn">discover more</a>
										</div>
									</div>

									<div class="swiper-slide slide" style="background:url(images/slide2.jpg) no-repeat">
										<div class="Slidecontent">
										   <span class="slideSpan">education, access, sustainability</span>
										   <h3>get to know about us</h3>
										   <a href="AboutUs.php" class="btn">discover more</a>
										</div>
									</div>

									<div class="swiper-slide slide" style="background:url(images/slide3.jpg) no-repeat">
										<div class="Slidecontent">
										   <span class="slideSpan">education, access, sustainability</span>
										   <h3>Providing excellent connection</h3>
										   <a href="ContactUs.php" class="btn">discover more</a>
										</div>
									</div>
								</div>
							
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
									
							</div>
						</div>
						<div class="homeAdBox3">
							<div class="homeAdBoxSub1">
								<h2>vision</h2>
								<p><br/>
								To develop and enhance the capability of the library resources and services in meet the demands of the curricular,  instructional, 
								and research programs of the academic community by providing regular funding to yearly acquisition of library materials.
								</p>
							</div>
							<div class="homeAdBoxSub2">
								<h2>mission</h2>
								<p><br/>
								The mission is to provide college students with the information they need to achieve their highest academic potential and help them 
								acquire research skills necessary for lifelong learning. To support teaching faculty & administrative staff and to participate in 
								interactive information to exchange within the wider library / educational community. 
								</p>
							</div>
							<div class="homeAdBoxSub3">
								<h2>values</h2>
								<p><br/>
								access<br/>
								confidentiality/privacy<br/>
								democracy<br/>
								diversity<br/>
								education and lifelong learning<br/>
								intellectual freedom, preservation<br/>
								the public good, professionalism<br/>
								service<br/>
								social responsibility<br/>
								and sustainability<br/>
								
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>	
			<?php
				include 'footer.php';
			?>
		</div>
	<!-- swiper js link  -->
	<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

	<!-- custom js file link  -->
	<script src="script/homeScript.js"></script>

	</body>
</html>