<?php
	//create connection
	$con = mysqli_connect('localhost', 'root', '', 'library_web_project');
	
	//check connection
	if(mysqli_connect_errno()){
		echo "Faild to connect:".mysqli_connect_error();
	}
	/*
	else{
		echo "connected successfully";
	}
	*/
?>