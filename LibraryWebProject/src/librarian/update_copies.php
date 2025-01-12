
<?php
	require "../db_connection.php";
	require "verify_librarian.php";
	require "../display_mess.php";
?>
<html>
	<head>
		<title>Update Copies</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/updateCopy.css">
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secUpdate{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 600px;
			}
			#allTheThings3 {
				  background-color:black;
				  width: 90%;
				  max-width: 800px;
				  margin: 0 auto;
				  font-size: 1.3rem;
				  color: white;
				  margin-bottom: 10px;
				  display: block;
				  height: 80%;
				  transform: translate(0%,8%);
				  top: 60%;
				  left: 50%;
				  padding-top:30px;
				  background: rgba(0, 0, 0, 0.8);
			}
			.cd-form input, .cd-form select {
				  font-family: "Open Sans", sans-serif;
				  font-size: 0.9rem;
				  color: #f1f4f7;
			}
			.cd-form .icon input{
				padding-left: 54px !important;
			}
			
		</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'librarianHeader.php';
			?>
			<section class="secUpdate">
				<div id="allTheThings3">
					<form class="cd-form" method="POST" action="#">
						<legend>Enter the details</legend>
						
							<div class="error-message" id="error-message">
								<p id="error"></p>
							</div>
							
							<div class="icon">
								<input class="b-isbn" type='text' name='b_isbn' id="b_isbn" placeholder="Book ISBN" required />
							</div>
								
							<div class="icon">
								<input class="b-copies" type="number" name="b_copies" placeholder="Copies to add" required />
							</div>
							<div class="regbutton">		
							<input type="submit" name="b_add" value="Add Copies" />
							</div>
					</form>
				</div>
			</section>	
			<?php
				include 'librarianFooter.php';
			?>
		</div>
	</body>
	
	<?php
		if(isset($_POST['b_add']))
		{
			$query = $con->prepare("SELECT isbn FROM book WHERE isbn = ?;");
			$query->bind_param("s", $_POST['b_isbn']);
			$query->execute();
			if(mysqli_num_rows($query->get_result()) != 1)
				echo error_with_field("Invalid ISBN", "b_isbn");
			else
			{
				$query = $con->prepare("UPDATE book SET copies = copies + ? WHERE isbn = ?;");
				$query->bind_param("ds", $_POST['b_copies'], $_POST['b_isbn']);
				if(!$query->execute())
					die(error_without_field("ERROR: Couldn\'t add copies"));
				echo success("Copies successfully updated");
			}
		}
	?>
	
</html>
