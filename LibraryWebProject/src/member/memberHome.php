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
			
	</style>
	</head>
	<body>
		<div class="adjust">
			<?php
				include 'memberHeader.php';
			?>
			<section class="secMember">
				<center>
				<div id="allTheThings">
				<br/><br/>
					<div class="headbox">
						<h2 id="boxh2">Book List</h2><h3>Select one book at a time in order to request.</h3>
					</div>
					
					<form class='cd-form' method='POST' action='#'>
					
					<div class="scroll" id="scroll">
					<div class="error-message" id="error-message">
						<p id="error"></p>
					</div>
							<?php
								$query = $con->query("SELECT * FROM book ORDER BY Bid DESC");
								$qry = mysqli_query($con,"select * from book ORDER BY Bid DESC");
								$q = mysqli_num_rows($qry);
								
								$qry = $con->prepare("SELECT * FROM book ORDER BY Bid");
								$qry->execute();
								$result = $qry->get_result();
								if(!$result)
									die("ERROR: Couldn't fetch books");
								$rows = mysqli_num_rows($result);
								if($rows == 0)
									echo "<h2 align='center'>No books available</h2>";
								else
								{
									for($i=0;$i<$q;$i++){
										
										while($row = $query->fetch_assoc()){
											$imgUrl = "../librarian/import/webcover/".$row["coverUrl"];
										
											$rowss = mysqli_fetch_array($result);										
											echo"
												<a id='abb' href=''>
													<img id='imgaaa' src='$imgUrl' alt='' />
													<input type='checkbox' name='rd_book' value=".$rowss[0]."/>
												</a>
											";
										}
									}
									
								}	
							?>
					</div>
					<div class="btclass">
					<input class="btn" type='submit' name='m_request' value='Request book' />
					</div>
					</form>
					
				</div>
				</center>
			</section>	
			<?php
				include 'memberFooter.php';
			?>
		</div>
	</body>
	<?php 
		if(isset($_POST['m_request'])){
			if(empty($_POST['rd_book'])){
				echo error_without_field("Please select a book to issue");
			}
			else{
					$query = $con->prepare("SELECT copies FROM book WHERE Bid = ?;");
					$query->bind_param("s", $_POST['rd_book']);
					$query->execute();
					$copies = mysqli_fetch_array($query->get_result())[0];
					
					if($copies == 0){
						echo error_without_field("No copies of the selected book are available");
					}
					else
					{
						$query = $con->prepare("SELECT request_id FROM pending_book_requests WHERE member = ?;");
						$query->bind_param("s", $_SESSION['username']);
						$query->execute();
						if(mysqli_num_rows($query->get_result()) == 1){
							echo error_without_field("You can only request one book at a time");
						}
						else
						{
							$query = $con->prepare("SELECT book_isbn FROM book_issue_log WHERE member = ?;");
							$query->bind_param("s", $_SESSION['username']);
							$query->execute();
							$result = $query->get_result();
							if(mysqli_num_rows($result) >= 3){
								echo error_without_field("You cannot issue more than 3 books at a time");
								echo "You cannot issue more than 3 books at a time";
							}
							else
							{
								$rows = mysqli_num_rows($result);
								for($i=0; $i<$rows; $i++)
									if(strcmp(mysqli_fetch_array($result)[0], $_POST['rd_book']) == 0)
										break;
								if($i < $rows){
									echo error_without_field("You have already issued a copy of this book");
								}
								else
								{
									$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
									$query->bind_param("s", $_SESSION['username']);
									$query->execute();
									$memberBalance = mysqli_fetch_array($query->get_result())[0];
									echo "balance is: ".$memberBalance."<br/>";
									
									$query = $con->prepare("SELECT price FROM book WHERE Bid = ?;");
									$query->bind_param("s", $_POST['rd_book']);
									$query->execute();
									$bookPrice = mysqli_fetch_array($query->get_result())[0];
									if($memberBalance < $bookPrice){
										echo error_without_field("You do not have sufficient balance to issue this book");
									}
									else
									{
										$query = $con->prepare("INSERT INTO pending_book_requests(member, book_isbn) VALUES(?, ?);");
										$query->bind_param("ss", $_SESSION['username'], $_POST['rd_book']);
										if(!$query->execute()){
											echo error_without_field("ERROR: Couldn\'t request book");
											echo "ERROR: Couldn\'t request book";
										}
										else{
											echo success("Book successfully requested. You will be notified by email when the book is issued to your account");
										}
									}
								}
							}
						}
					}
				}
		}
		
	?>
</html>
<!--
<input type='button' />
-->