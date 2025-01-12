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
		<title>Librarian Login</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/librarianReg.css">
		
		<!--
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
		-->
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secLibrarianLogin{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 600px;
			}
			
			#librarianReg {
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
				include 'initial_header2.php';
			?>
			<section class="secLibrarianLogin">
			
			<!--form should be edited-->
				<form class="cd-form" id="librarianReg" method="POST" action="#">
		
					<legend>Librarian Login</legend>
				
					<div class="error-message" id="error-message">
						<p id="error"></p>
					</div>
					
					<div class="icon">
						<input class="l-user" type="text" name="l_user" placeholder="Username" required />
					</div>
					
					<div class="icon">
						<input class="l-pass" type="password" name="l_pass" placeholder="Password" required />
					</div>
					<div class="regbutton">
					<input type="submit" value="Login" name="l_login"/>
					</div>
				</form>
			</section>	
			<?php
				include 'initial_footer2.php';
			?>
		</div>
	</body>
	
	<!--php should be edited-->
	
	<?php
		
		if(isset($_POST['l_login']))
		{
			$query = $con->prepare("SELECT id FROM librarian WHERE username = ? AND password = ?;");
			$query->bind_param("ss", $_POST['l_user'], $_POST['l_pass']);
			$query->execute();
			$result=$query->get_result();
			if(mysqli_num_rows($result) != 1)
				echo error_without_field("Invalid username/password combination");
			else{
				$_SESSION['type'] = "librarian";
				$_SESSION['id'] = mysqli_fetch_array($result)[0];
				$_SESSION['username'] = $_POST['l_user'];
				header('Location: librarianHome.php');
			}
		}
		
	?>
	
</html>