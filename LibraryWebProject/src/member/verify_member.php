<!--doubt with that-->
<?php
	session_start();
	
	if(empty($_SESSION['type']))
		header("Location: ../member/memberHome.php");
	
	else if(strcmp($_SESSION['type'], "librarian") == 0)
		header("Location: ../librarian/ibrarianHome.php");
?>
