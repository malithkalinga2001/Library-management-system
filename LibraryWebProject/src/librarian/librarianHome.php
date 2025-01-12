<!--empty page with nessessary background-->
<?php
	require "../db_connection.php";
	require "verify_librarian.php";
	//require "header_librarian.php";
?>
<html>
	<head>
		<title>librarian</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secLibrarian{
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
				include 'librarianHeader.php';
			?>
			<section class="secLibrarian">
				<center>
				<div id="allTheThings">
				
					<a href="pending_reg.php">
						<input type="button" value="Pending registrations" />
					</a>
							
					<a class="librarianBox" href="pending_books.php">
						<input class="b" type="button" value="Pending book requests" />
					</a>
							
					<a class="librarianBox" href="insertBooks.php">
						<input class="b" type="button" value="Add a new book" />
					</a>
							
					<a class="librarianBox" href="update_copies.php">
						<input class="b" type="button" value="Update copies of a book" />
					</a>
							
					<a class="librarianBox" href="updateBalance.php">
						<input class="b" type="button" value="Update balance of a member" />
					</a>
							
						
				</div>
				</center>
			</section>	
			<?php
				include 'librarianFooter.php';
			?>
		</div>
	</body>
</html>