
<?php
	require "../db_connection.php";
	require "verify_librarian.php";
	require "../display_mess.php";
?>
<html>
	<head>
		<title>Update Balance</title>
		<link rel="stylesheet" type="text/css" href="../css/basic.css">
		<link rel="stylesheet" type="text/css" href="css/insertBooks.css">
		<script defer src="javaScript/insertBooks.js"></script>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type=text/css>
			.secUpdate{
				margin-top: 0px;
				background-image: url("images/background.jpg");
				background-size: cover;
				height: 1000px;
			}
			#allTheThings3 {
				  background-color:white;
				  width: 90%;
				  max-width: 800px;
				  margin: 0 auto;
				  font-size: 1.3rem;
				  color: white;
				  margin-bottom: 10px;
				  display: block;
				  height: 89%;
				  transform: translate(0%,8%);
				  top: 60%;
				  left: 50%;
				  padding-top:30px;
			}
			.cd-form .icon input{
				padding-left: 54px !important;
			}
			

				.icon input:focus {
					outline: 0;
				}
				.icon.success input {
					border-color: #09c372;
				}

				.icon.error input {
					border-color: #ff3860;
				}

				.icon .error {
					margin-top: 2px;
					color: #ff3860;
					font-size: 9px;
					height: 0px;
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
				include 'librarianHeader.php';
			?>
			<section class="secUpdate">
				<div id="allTheThings3">
					<form class="cd-form" id="form" method="POST" action="#" enctype="multipart/form-data">
						<legend>Enter book details</legend>
						
							<div class="error-message" id="error-message">
								<p id="error"></p>
							</div>
							
							<div class="icon">
								<input class="b-isbn" id="b_isbn" type="number" name="b_isbn" placeholder="ISBN" />
								<p>*</p>
							</div>
							
							<div class="icon">
								<input class="b-title" id="b_title" type="text" name="b_title" placeholder="Title" />
								<p>*</p>
							</div>
							
							<div class="icon">
								<input class="b-author" id="b_author" type="text" name="b_author" placeholder="Author" />
								<p>*</p>
							</div>
							
							<div>
							<h4>Category</h4>
							
								<p class="cd-select icon">
									<select class="b-category" name="b_category">
										<option>Fiction</option>
										<option>Non-fiction</option>
										<option>Education</option>
									</select>
								</p>
							</div>
							
							<div class="icon">
								<input class="b-price" id="b_price" type="number" name="b_price" placeholder="Price" />
								<p>*</p>
							</div>
							
							<div class="icon">
								<input class="b-copies" id="b_copies" type="number" name="b_copies" placeholder="Copies" />
								<p>*</p>
							</div>
							
							<div class="icon">
								PDF file:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="file" value="PDF Book file" name="pdf" placeholder="Price" required/>
								<p>*</p>
							</div>
							
							<div class="icon">
								Cover Image:<input type="file" id="b_pdf" value="cover Image" name="cover" placeholder="Copies" required/>
								<p>*</p>
							</div>
							
							<div class="regbutton">
							<input class="b-isbn" type="submit" id="b_cover" name="b_add" value="Add book" />
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
		include "bReg_help.php";
		
		
	?>
</html>