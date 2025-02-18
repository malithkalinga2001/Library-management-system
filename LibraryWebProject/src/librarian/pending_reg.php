<!--empty page with nessessary background-->
<?php
	require "../db_connection.php";
	require "verify_librarian.php";
	require "../display_mess.php";
?>
<html>
	<head>
		<title>librarian</title>
		<link rel="stylesheet" type="text/css" href="css/pendingRegis.css">
		
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
				<div id="allTheThings2">
					<?php
						$query = $con->prepare("SELECT username, name, email, balance FROM pending_memreg");
						$query->execute();
						$result = $query->get_result();
						$rows = mysqli_num_rows($result);
						if($rows == 0)
							echo "<h2 align='center'>No registrations pending</h2>";
						else
						{
							echo "<form class='cd-form' method='POST' action='#'>";
							echo "<div class='error-message' id='error-message'>
									<p id='error'></p>
								</div><br/>";
							echo "<legend>Pending registrations</legend>";
							
							echo "<table width='100%' cellpadding=10 cellspacing=10>
									<tr>
										<th></th>
										<th>Username<hr></th>
										<th>Name<hr></th>
										<th>Email<hr></th>
										<th>Balance<hr></th>
									</tr>";
							for($i=0; $i<$rows; $i++)
							{
								$row = mysqli_fetch_array($result);
								echo "<tr>";
								echo "<td>
										<label class='control control--checkbox'>
											<input type='checkbox' name='cb_".$i."' value='".$row[0]."' />
											<div class='control__indicator'></div>
										</label>
									</td>";
								$j;
								for($j=0; $j<3; $j++)
									echo "<td>".$row[$j]."</td>";
								echo "<td>$".$row[$j]."</td>";
								echo "</tr>";
							}
							echo "</table><br /><br />";
							echo "<div style='float: right;'>";
							echo "<input type='submit' value='Delete selected' name='l_delete' />&nbsp;&nbsp;&nbsp;&nbsp;";
							echo "<input type='submit' value='Confirm selected' name='l_confirm' />";
							echo "</div>";
							echo "</form>";
						}
						
						$header = 'From: <malithkalinga2001@gmail.com>' . "\r\n";
						
						if(isset($_POST['l_confirm']))
						{
							$members = 0;
							for($i=0; $i<$rows; $i++)
							{
								if(isset($_POST['cb_'.$i]))
								{
									$username =  $_POST['cb_'.$i];
									$query = $con->prepare("SELECT * FROM pending_memreg WHERE username = ?;");
									$query->bind_param("s", $username);
									$query->execute();
									$row = mysqli_fetch_array($query->get_result());
									
									$query = $con->prepare("INSERT INTO member(username, password, name, email, balance) VALUES(?, ?, ?, ?, ?);");
									$query->bind_param("ssssd", $username, $row[1], $row[2], $row[3], $row[4]);
									if(!$query->execute())
										die(error_without_field("ERROR: Couldn\'t insert values"));
									$members++;
									
									$to = $row[3];
									$subject = "Library membership accepted";
									$message = "Your membership has been accepted by the library. You can now issue books using your account.";
									mail($to, $subject, $message, $header);
								}
							}
							if($members > 0)
								echo success("Successfully added ".$members." members");
							else
								echo error_without_field("No registration selected");
						}
						
						if(isset($_POST['l_delete']))
						{
							$requests = 0;
							for($i=0; $i<$rows; $i++)
							{
								if(isset($_POST['cb_'.$i]))
								{
									$username =  $_POST['cb_'.$i];
									$query = $con->prepare("SELECT email FROM pending_memreg WHERE username = ?;");
									$query->bind_param("s", $username);
									$query->execute();
									$email = mysqli_fetch_array($query->get_result())[0];
									
									$query = $con->prepare("DELETE FROM pending_memreg WHERE username = ?;");
									$query->bind_param("s", $username);
									if(!$query->execute())
										die(error_without_field("ERROR: Couldn\'t delete values"));
									$requests++;
									
									$to = $email;
									$subject = "Library membership rejected";
									$message = "Your membership has been rejected by the library. Please contact a librarian for further information.";
									mail($to, $subject, $message, $header);
								}
							}
							if($requests > 0)
								echo success("Successfully deleted ".$requests." requests");
							else
								echo error_without_field("No registration selected");
						}
					?>
				</div>
				</center>
			</section>	
			<?php
				include 'librarianFooter.php';
			?>
		</div>
	</body>
</html>