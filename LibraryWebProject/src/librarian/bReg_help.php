<?php
require_once 'pdffile.php';
function send2(){
	$z = send1();
	return $z;
}
$z = send2();
$y = $z;
		if(isset($_POST['b_add']) || isset($_FILES['cover']))
		{
			echo "<pre>";
			print_r($_FILES['cover']);
			echo "</pre>";
			
			$img_name = $_FILES['cover']['name'];
			$img_size = $_FILES['cover']['size'];
			$tmp_name = $_FILES['cover']['tmp_name'];
			$error = $_FILES['cover']['error'];
			if($error === 0){
				if($img_size > 125000){
					
					$em = "file is too large";
					header("Location: insertBooks.php?error=$em");
				}
				else{
					$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);
					$allowed_exs = array("jpg", "jpeg", "png");
					
					if(in_array($img_ex_lc, $allowed_exs)){
						$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
						$img_upload_path = 'import/webcover/'.$new_img_name;
						move_uploaded_file($tmp_name, $img_upload_path);
						
						//insert into database
							$query = $con->prepare("SELECT isbn FROM book WHERE isbn = ?;");
							$query->bind_param("s", $_POST['b_isbn']);
							$query->execute();
							
								
							if(mysqli_num_rows($query->get_result()) != 0)
								echo error_with_field("A book with that ISBN already exists", "b_isbn");
							else
							{
								$query = $con->prepare("INSERT INTO book(isbn, title, author, category, price, copies, coverUrl, pdfUrl) VALUES(?, ?, ?, ?, ?, ?, '$new_img_name','$y');");//isbn, title, author, category, price, copies, coverUrl
								$query->bind_param("ssssdd", $_POST['b_isbn'], $_POST['b_title'], $_POST['b_author'], $_POST['b_category'], $_POST['b_price'], $_POST['b_copies']);
								
								if(!$query->execute()){
									die(error_without_field("ERROR: Couldn't add book"));
								}
								echo success("Successfully added book");
								
							}
						
					}
					else{
						$em = "you cant upload this file";
						header("Location: insertBooks.php?error=$em");
					}
				}
			}
			else{
				$em = "Unknown error occured";
				header("Location: insertBooks.php?error=$em");
			}
			
		}
	
	?>