 <!--empty page with nessessary background-->
<?php
	require "../db_connection.php";
	require "../display_mess.php";
	require "verify_member.php";
?>

<html>
	<head>
		<title>member</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/Mybooks.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secMember{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 100%;
			}
			
			.boby img {
			  width: 70%;
			  position: absolute;
			  margin: auto;
			  left: 0;
			  right: 0;
			  top: 0;
			  bottom: 0;
			  cursor: pointer;
			}
			#imgaaa{
				width: 17%;
				height:35%;
				border: none;
				border-radius: .5em;
				float: center;
				cursor: pointer;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				-webkit-appearance: none;
				-moz-appearance: none;
				-ms-appearance: none;
				-o-appearance: none;
				appearance: none;
			}
			#imgaaa:active {
			  -webkit-transform: scale(0.9);
			  -moz-transform: scale(0.9);
			  -ms-transform: scale(0.9);
			  -o-transform: scale(0.9);
			  transform: scale(0.9);
			}
			.headbox{
				width: 73%;
				height: 7%;
				background: rgba(0, 0, 0, .8);
				top: 20%;
				bottom: 30%;
				font-size: 20px;
				padding-top: 0.8%;
				color: white;
				
			}
			div#scroll.scroll{
				background: rgba(0, 0, 0, .8);
				width: 70%;
				margin: 10% auto;
				height: 70%;
				overflow: hidden;
				overflow-y: scroll;
				padding: 50px 20px;
				margin-top: 1%;
			}
			
			.btn{
				background: black;
				outline: none;
				border: 1px solid white;
				color: white;
				width: 50%;
				padding: 7px 15px;
				font-size: large;
				cursor: pointer;
				transition: 0.3s ease;
				margin-top: -13%;
			}
			.btn:hover{
				background: white;
				color: black;
			}
			
			.cd-form .error-message {
				display: none;
				margin-top: -2%;
				margin-bottom: 2%;
			}
			.cd-form .success-message {
				display: none;
				margin-top: -2%;
				margin-bottom: 2%;
			}

			.cd-form .error-message p {
			  background: #e94b35;
			  color: #ffffff;
			  font-size: 15px;
			  text-align: center;
			  -webkit-font-smoothing: antialiased;
			  -moz-osx-font-smoothing: grayscale;
			  border-radius: .25em;
			  padding: 16px;
			}

			.cd-form .success-message p {
			  background: #4caf50;
			  color: #ffffff;
			  font-size: 15px;
			  text-align: center;
			  -webkit-font-smoothing: antialiased;
			  -moz-osx-font-smoothing: grayscale;
			  border-radius: .25em;
			  padding: 16px;
			  margin-top: -2%;
			  margin-bottom: 2%;
			}

			.cd-form .error-field {
			  border-color: #e94b35 !important;
			}
			
			#allTheThings3{
				background: rgba(0, 0, 0, .1000);
				width: 100%;
				margin-top: -360px;
				padding-top: 20px;
				z-index: 1000;
				position: fixed;
				display: block;
			}
	</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'memberHeader.php';
			?>
			<section class="secMember"><br/><br/>
				<center>
				<div id="allTheThings2">
				
				<?php
						$query = $con->prepare("SELECT book_isbn FROM book_issue_log WHERE member = ?;");
						$query->bind_param("s", $_SESSION['username']);
						$query->execute();
						$result = $query->get_result();
						$rows = mysqli_num_rows($result);
						if($rows == 0)
							echo "<h2 align='center'>No books currently issued</h2>";
						else
						{
							echo "<form class='cd-form' method='POST' action='#'>";
							echo "<legend>My books</legend>";
							echo "<div class='success-message' id='success-message'>
									<p id='success'></p>
								</div>";
							echo "<div class='error-message' id='error-message'>
									<p id='error'></p>
								</div>";
							echo"<table width='100%' cellpadding='10' cellspacing='10'>
									<tr>
										<th></th>
										<th>ISBN<hr></th>
										<th>Title<hr></th>
										<th>Author<hr></th>
										<th>Category<hr></th>
										<th>Due Date<hr></th>
									</tr>";
							for($i=0; $i<$rows; $i++)
							{
								$isbn = mysqli_fetch_array($result)[0];
								if($isbn != NULL)
								{
									$query = $con->prepare("SELECT title, author, category FROM book WHERE Bid = ?;");
									$query->bind_param("s", $isbn);
									$query->execute();
									$innerRow = mysqli_fetch_array($query->get_result());
									echo "<tr>
											<td>
												<label class='control control--checkbox'>
													<input type='checkbox' name='cb_book".$i."' value='".$isbn."'>
													<div class='control__indicator'></div>
												</label>
											</td>";
									echo "<td>".$isbn."</td>";
									for($j=0; $j<3; $j++)
										echo "<td>".$innerRow[$j]."</td>";
									$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
									$query->bind_param("ss", $_SESSION['username'], $isbn);
									$query->execute();
									echo "<td>".mysqli_fetch_array($query->get_result())[0]."</td>";
									echo "</tr>";
								}
							}
							echo "</table><br />";
							echo "<input type='submit' name='b_return' value='Return selected books' /><br/><br/>";
							echo "<input type='submit' name='read_pdf' value='Read the Book'/>";
							echo "</form>";
						}
						
						if(isset($_POST['b_return']))
						{
							$books = 0;
							for($i=0; $i<$rows; $i++)
								if(isset($_POST['cb_book'.$i]))
								{
									$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
									$query->bind_param("ss", $_SESSION['username'], $_POST['cb_book'.$i]);
									$query->execute();
									$due_date = mysqli_fetch_array($query->get_result())[0];
									
									$query = $con->prepare("SELECT DATEDIFF(CURRENT_DATE, ?);");
									$query->bind_param("s", $due_date);
									$query->execute();
									$days = (int)mysqli_fetch_array($query->get_result())[0];
									
									$query = $con->prepare("DELETE FROM book_issue_log WHERE member = ? AND book_isbn = ?;");
									$query->bind_param("ss", $_SESSION['username'], $_POST['cb_book'.$i]);
									if(!$query->execute())
										die(error_without_field("ERROR: Couldn\'t return the books"));
									
									if($days > 0)
									{
										$penalty = 5*$days;
										$query = $con->prepare("SELECT price FROM book WHERE isbn = ?;");
										$query->bind_param("s", $_POST['cb_book'.$i]);
										$query->execute();
										$price = mysqli_fetch_array($query->get_result())[0];
										if($price < $penalty)
											$penalty = $price;
										$query = $con->prepare("UPDATE member SET balance = balance - ? WHERE username = ?;");
										$query->bind_param("ds", $penalty, $_SESSION['username']);
										$query->execute();
										echo '<script>
												document.getElementById("error").innerHTML += "A penalty of Rs. '.$penalty.' was charged for keeping book '.$_POST['cb_book'.$i].' for '.$days.' days after the due date.<br />";
												document.getElementById("error-message").style.display = "block";
											</script>';
									}
									$books++;
								}
							if($books > 0)
							{
								echo '<script>
										document.getElementById("success").innerHTML = "Successfully returned '.$books.' books";
										document.getElementById("success-message").style.display = "block";
									</script>';
								$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
								$query->bind_param("s", $_SESSION['username']);
								$query->execute();
								
								$balance = (int)mysqli_fetch_array($query->get_result())[0];
								if($balance < 0)
									header("Location: ../logout.php");
							}
							else
								echo error_without_field("Please select a book to return");
						}
					?>
					<div id="allTheThings3">
						<?php
								//reading pdf*************************************************
								
								if(isset($_POST['read_pdf']))
								{
								?>
								<h2>Reading Books</h2>
								<style type = "text/css">
									#allTheThings2{
										height: 80%;
									}
									#allTheThings3{
										height: 100%;
										background: rgba(0, 0, 0, 5);
										
									}
								</style>
								<?php
									for($i=0; $i<$rows; $i++){
										if(isset($_POST['cb_book'.$i]))
										{
											$query = $con->prepare("SELECT pdfUrl FROM book WHERE Bid = ?;");
											$query->bind_param("s",$_POST['cb_book'.$i]);
											$query->execute();
											$sql = mysqli_fetch_array($query->get_result())[0];
											?>
												<iframe src="../librarian/import/webpdf/<?php echo $sql; ?>" width="98%" height="100%"></iframe>
											<?php
										}
									}
								}
						?>
				</div>
				</center>
			</section>
			<?php
				include 'memberFooter.php';
			?>
		</div>
	</body>	
</html>
<!--
<input type='button' />
-->
