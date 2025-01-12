 <!--empty page with nessessary background-->
<?php
	require "../db_connection.php";
	require "../display_mess.php";
	require "verify_member.php";
?>

<html>
	<head>
		<title>My_PDF</title>
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
				<!--background-image: url("images/background.jpg");-->
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