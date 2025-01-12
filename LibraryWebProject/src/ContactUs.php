<?php
	
	require "display_mess.php";
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<link rel="stylesheet" type="text/css" href="css/basic.css">
	<link rel="stylesheet" type="text/css" href="css/contactUs.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type=text/css>
	p {
	text-align: justify;
	color: #fff;
	font-family: "Times New Roman"
	}
		
	.secContact{
		margin-top: 0px;
		background-image: url("images/background.jpg");
		background-size: cover;
		height: 620px;
	}
	.error-message {
		display: none;
	}

	.error-message p {
	  background: #e94b35;
	  color: #ffffff;
	  font-size: 15px;
	  text-align: center;
	  -webkit-font-smoothing: antialiased;
	  -moz-osx-font-smoothing: grayscale;
	  border-radius: .25em;
	  padding: 16px;
	}

	.success-message p {
	  background: #4caf50;
	  color: #ffffff;
	  font-size: 15px;
	  text-align: center;
	  -webkit-font-smoothing: antialiased;
	  -moz-osx-font-smoothing: grayscale;
	  border-radius: .25em;
	  padding: 16px;
	}
	.container2{
		padding-bottom: 40px;
	}
	.contact {
		height: 65%;
	}
	.inputBox p {
		font-size: 15px;
		color:red;
		height: 15px;
	}
	</style>
</head>

<body>
	<div class="adjust">
<!--This is showing the navigation bar-->
		<?php
			include 'header.php';
		?>
		<section class="secContact">
			<div class="contact">
				<div class="content">
					<h2><b>Contact Us</b></h2>
					<p><br/>Feel free to get in touch with me. I am always 
					open to discussing new projects, creative ideas or 
					opprtunities to be part of your vision</p>
				</div>
				<div class="container2">
					<div class="contactInfo2">
						<div class="box">
							<div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i><!--this one got from fontawesomeicon website and it will give the icon of location--></div>
							<div class="text">
								<h3>Address</h3>
								<p>1st mile post,<br/>Kapugollawa Road,<br/>Horowpothana</p>
							</div>
						</div>
						<div class="box">
							<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i><!--this one got from fontawesomeicon website and it will give the icon of phone--></div>
							<div class="text">
								<h3>Phone</h3>
								<p>077-9930337</p>
							</div>
						</div>
						<div class="box">
							<div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i><!--this one got from fontawesomeicon website and it will give the icon of email--></div>
							<div class="text">
								<h3>Email</h3>
								<p>malithkalinga2001@gmail.com</p>
							</div>
						</div>
					</div>
					<div class="contactForm" id="form">
						<form class="cd-form" action="#" method="POST">
							<h2>Send Message</h2>
							<div class="error-message" id="error-message">
								<p id="error"></p>
							</div>
							<div class="inputBox">
								<input type="text" name="name" id="name">
								<span>Full Name</span>
								<p></p>
							</div>
							<div class="inputBox">
								<input type="text" name="email" id="email">
								<span>Email</span>
								<p></p>
							</div>
							<div class="inputBox">
								<textarea name="message" id="message"></textarea>
								<span>Type your Message...</span>
								<p></p>
							</div>
							<div class="inputBox">
								<input type="submit" name="contact" value="Send">
							</div>
						</form>
						<script defer src="script/contactScript.js"></script>
					</div>
				</div>
			</div>
		</section>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
	<?php
		if(isset($_POST['contact'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$subject = "library web project email";
			$message = $_POST['name'];
			
			$mailheader = "From:".$name."<".$email.">\r/n";
			$recipient = "malithkalinga2001@gmail.com";
			
			mail($recipient, $subject, $message, $mailheader);
			
			echo success("Message Successfully sent, reply will be sent to your email.");
		}
		else{
			
		}
	?>
</html>