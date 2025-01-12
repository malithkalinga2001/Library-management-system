<?php
	include "db_connection.php";
	
	if(empty($_SESSION['type']));
	else if(strcmp($_SESSION['type'], "librarian") == 0)
		header("Location: librarian/librarianHome.php");
	else if(strcmp($_SESSION['type'], "member") == 0)
		header("Location: member/memberHome.php");
?>

<html>
	<head>
		<title>Login</title>
		<!--<link rel="stylesheet" type="text/css" href="css/basic.css">-->
		<link rel="stylesheet" type="text/css" href="css/login.css">
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secLogin{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 600px;
			}
				
	</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'header.php';
			?>
			<section class="secLogin">
				<center>
				<div id="allTheThings">
					<div id="member">
						<a id="loga" href="member/memberLogin.php">
							<img src="images/ic_member.svg" width="250px" height="auto"/><br />
							&nbsp;Member
						</a>
					</div>
					<div id="verticalLine">
						<div id="librarian">
							<a id="loga" id="librarian-link" href="librarian/librarianLogin.php">
								<img src="images/ic_librarian.svg" width="250px" height="auto" /><br />
								&nbsp;&nbsp;&nbsp;Librarian
							</a>
						</div>
					</div>
				</div>
				</center>
			</section>	
			<?php
				include 'footer.php';
			?>
		</div>
	</body>
</html>