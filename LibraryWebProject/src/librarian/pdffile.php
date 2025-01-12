<?php
function send1(){
	static $z;
		if(isset($_POST['b_add']) || isset($_FILES['pdf']))
		{
			echo "<pre>";
			print_r($_FILES['pdf']);
			echo "</pre>";
			
			$img_name = $_FILES['pdf']['name'];
			$img_size = $_FILES['pdf']['size'];
			$tmp_name = $_FILES['pdf']['tmp_name'];
			$error = $_FILES['pdf']['error'];
			if($error === 0){
				if($img_size > 125000){
					
					$em = "file is too large";
					header("Location: insertBooks.php?error=$em");
				}
				else{
					$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);
					$allowed_exs = array("pdf");
					
					if(in_array($img_ex_lc, $allowed_exs)){
						$new_img_name = uniqid("PDF-", true).'.'.$img_ex_lc;
						$img_upload_path = 'import/webpdf/'.$new_img_name;
						move_uploaded_file($tmp_name, $img_upload_path);
						
						$x = $new_img_name;
						$z = &$x;
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
	return $z;
}
send1();
?>