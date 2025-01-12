<!--member registration (first develop this)-->

<!--empty page with nessessary background-->
<?php
	require "../db_connection.php";
	require "../display_mess.php";
	
?>
<html>
	<head>
		<title>member registration</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/memberReg.css">
		
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secMember{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 750px;
			}
			
			 .icon p {
				 font-size: 15px;
				 color:red;
				 visibility: hidden;
				 height: 0px;
			 }

			 .error p {
				 visibility: visible;
			 }
		</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'initial_header.php';
			?>
			<section class="secMember">
				<form class="cd-form" id="form" method="POST" action="#" >
					<legend>Enter your details</legend>
					
						<div class="error-message" id="error-message">
							<p id="error"></p>
						</div>
						
						<div class="icon">
							<input class="m-user" type="text" name="m_user" id="m_user" placeholder="Username" />
							<p>*</p>
						</div>
						
						<div class="icon">
							<input class="m-pass" type="password" name="m_pass" id="passwd" placeholder="Password" />
							<p>*</p>
						</div>
						
						<div class="icon">
							<input class="m-name" type="text" name="m_name" placeholder="Full Name" />
							<p>*</p>
						</div>
						
						<div class="icon">
							<input class="m-email" type="email" name="m_email" id="m_email" placeholder="Email" />
							<p>*</p>
						</div>
						
						<div class="icon">
							<input class="m-balance" type="number" name="m_balance" id="m_balance" placeholder="Initial Balance" />
							<p>*</p>
						</div>
						<div class="regbutton">
						<input type="submit" name="m_register" value="Register" />
						</div>
				</form>
				<script defer src="javaScript/member_reg.js"></script>
			</section>	
			<?php
				include 'initial_footer.php';
			?>
		</div>
	</body>
	<?php
		if(isset($_POST['m_register']))
		{
			if($_POST['m_balance'] < 500)
				echo error_with_field("You need a balance of at least 500 to open an account", "m_balance");
			else
			{
				$query = $con->prepare("(SELECT username FROM member WHERE username = ?) UNION (SELECT username FROM pending_memreg WHERE username = ?);");
				$query->bind_param("ss", $_POST['m_user'], $_POST['m_user']);
				$query->execute();
				if(mysqli_num_rows($query->get_result()) != 0)
					echo error_with_field("The username you entered is already taken", "m_user");
				else
				{
					$query = $con->prepare("(SELECT email FROM member WHERE email = ?) UNION (SELECT email FROM pending_memreg WHERE email = ?);");
					$query->bind_param("ss", $_POST['m_email'], $_POST['m_email']);
					$query->execute();
					if(mysqli_num_rows($query->get_result()) != 0)
						echo error_with_field("An account is already registered with that email", "m_email");
					else
					{
						$query = $con->prepare("INSERT INTO pending_memreg(username, password, name, email, balance) VALUES(?, ?, ?, ?, ?);");
						$query->bind_param("ssssd", $_POST['m_user'], sha1($_POST['m_pass']), $_POST['m_name'], $_POST['m_email'], $_POST['m_balance']);
						if($query->execute())
							echo success("Details recorded. You will be notified on the email ID provided when your details have been verified");
						else
							echo error_without_field("Couldn\'t record details. Please try again later");
					}
				}
			}
		}
	?>
</html>