<!--need to make changes-->

<?php
	require "../db_connection.php";
	require "../display_mess.php";
	require "../verify_logged_out.php";
	/*require "../header.php";
	*/
?>
<html>
	<head>
		<title>Member Login</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/memberReg.css">
		<!--
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
		-->
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secMemberLogin{
				margin-top: 0px;
				background-image: url("../images/background.jpg");
				background-size: cover;
				height: 600px;
			}
			
			#memberReg {
			  background-color:white;
			  width: 80%;
			  max-width: 500px;
			  margin: 0 auto;
			  font-size: 1.3rem;
			  color: #94aab0;
			  margin-bottom: 10px;
			  display: block;
			  height: 65%;
			  transform: translate(0%,25%);
			  top: 60%;
			  left: 50%;
			}
	</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'initial_header.php';
			?>
			<section class="secMemberLogin">
			
			<!--form should be edited-->
				<form class="cd-form"  id="memberReg" method="POST" action="#">
		
					<legend>Member Login</legend>
					
					<div class="error-message" id="error-message">
						<p id="error"></p>
					</div>
					
					<div class="icon">
						<input class="m-user" type="text" name="m_user" placeholder="Username" required />
					</div>
					
					<div class="icon">
						<input class="m-pass" type="password" name="m_pass" placeholder="Password" required />
					</div>
					<div class="regbutton">
					<input type="submit" value="Login" name="m_login" />
					</div>
					<br /><br />
					
					<p align="center">Don't have an account?&nbsp;<a href="member_reg.php">Sign up</a>
				</form>
			</section>	
			<?php
				include 'initial_footer.php';
			?>
		</div>
	</body>
	
	<!--php should be edited-->
	
	<?php
	
		if(isset($_POST['m_login']))
		{
			$query = $con->prepare("SELECT id, balance FROM member WHERE username = ? AND password = ?;");
			$query->bind_param("ss", $_POST['m_user'], sha1($_POST['m_pass']));
			$query->execute();
			$result = $query->get_result();
			
			if(mysqli_num_rows($result) != 1)
				echo error_without_field("Invalid username/password combination");
			else 
			{
				$resultRow = mysqli_fetch_array($result);
				$balance = $resultRow[1];
				if($balance < 0)
					echo error_without_field("Your account has been suspended. Please contact a librarian for further information");
				else
				{
					$_SESSION['type'] = "member";
					$_SESSION['id'] = $resultRow[0];
					$_SESSION['username'] = $_POST['m_user'];
					header('Location: memberHome.php');
				}
			}
		}
	
	?>
	
</html>