<?php
	session_start();
	
	if(empty($_SESSION['type']));
	else if(strcmp($_SESSION['type'], "librarian") == 0)
		header("Location: ../librarian/librarianHome.php");
	else if(strcmp($_SESSION['type'], "member") == 0)
		header("Location: ../member/memberHome.php");
?>