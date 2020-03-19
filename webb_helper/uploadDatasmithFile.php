<?php
	$s_targetDirectory = "./uploads/";
	$s_targetFileName = $s_targetDirectory . "datasmith.udatasmith";
	$b_uploadStatus = 1;
	$s_fileType = strtolower(pathinfo($s_targetDirectory . basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));


	$s_allowedFileType = "udatasmith";
	$i_allowedfileSize = 500000; // Allowed File Size in kB.

	$s_uploadMessage = "";

	if(isset($_POST["submit"])){
	    $b_uploadStatus = 1;
	}

	if ($_FILES["fileToUpload"]["size"] > $i_allowedfileSize){
		$b_uploadStatus = 0;
		$s_uploadMessage = "Upload Error: File is too large.";
	}

	if($s_fileType != $s_allowedFileType){
		$b_uploadStatus = 0;
	    $s_uploadMessage = "Upload Error: File is not an .udatasmith type."; 
	}

	if ($b_uploadStatus == 0){
	    echo '<script>' . 'console.log("' . $s_uploadMessage . '");' . '</script>';
	    echo '<script> location.replace("./index.php?status=fileNotUploaded");</script>';
	}

	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $s_targetFileName);
	$s_uploadMessage = "Upload Status: The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
	echo '<script>' . 'console.log("' . $s_uploadMessage . '");' . '</script>';

	echo '<script> location.replace("./index.php?status=fileUploaded");</script>';
?>