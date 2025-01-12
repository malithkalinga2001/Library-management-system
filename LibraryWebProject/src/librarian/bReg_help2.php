<?php

function abc(){
	if(isset($_POST['b_add']) || isset($_FILES['pdf']))
		{
			/*pdf*/
			echo "<pre>";
			print_r($_FILES['pdf']);
			echo "</pre>";
			
			$pdf_name = $_FILES['pdf']['name'];
			$pdf_size = $_FILES['pdf']['size'];
			$tmp_name_pdf = $_FILES['pdf']['tmp_name'];
			$error2 = $_FILES['pdf']['error'];
			
			if($error2 === 0){
				if($pdf_size > 20000){
					
				}
				else{
					
					$pdf_ex = pathinfo($pdf_name, PATHINFO_EXTENSION);
					$pdf_ex_lc = strtolower($pdf_ex);
					
					$allowed_exs_pdf = array("pdf", "PDF");
					
					
						
					if(in_array($pdf_ex_lc, $allowed_exs_pdf)){
						/*pdf*/
							$new_pdf_name = uniqid("PDF-", true).'.'.$pdf_ex_lc;
							$pdf_upload_path = 'import/webpdf/'.$new_pdf_name;
							move_uploaded_file($tmp_name_pdf, $pdf_upload_path);
							return $new_pdf_name;
						
							/*insert into database
								$query = $con->prepare("SELECT isbn FROM book WHERE isbn = ?;");
								$query->bind_param("s", $_POST['b_isbn']);
								$query->execute();
									
								if(mysqli_num_rows($query->get_result()) != 0)
									echo error_with_field("A book with that ISBN already exists", "b_isbn");
								else
								{
									$query = $con->prepare("UPDATE book SET	pdfUrl = '$new_pdf_name' where Bid=18;");
									
									if(!$query->execute())
										die(error_without_field("ERROR: Couldn't add book"));
									echo success("Successfully added book");
								}
							*/
							
							
				}
					
				}
			}
			
		}
		
		
}
   $value =abc();		
?>






<?php
$statusMsg = "";

//file upload path
$targetDir = "import/webpdf/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir.$fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST['b_add']) && !empty($_FILES["file"]["name"])){
	
	//allow certion file format
	$allowTypes = array('pdf');
	if(in_array($fileType,$allowTypes)){
		
		//upload files to server
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath)){
			$statusMsg = "The file ".$fileName." has been uploaded.";
		}
		else{
			$statusMsg = "Sorry, only pdf file can be uploaded";
		}
	}
	else{
		$statusMsg = "Please select a file to upload";
	}
}
//display status message
echo $statusMsg;
?>