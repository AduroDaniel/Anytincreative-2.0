<?php

	$flag = TRUE;

	$con = mysqli_connect('127.0.0.1', 'anytincr_aduro', '53DfBvb*C@Q!1Vbz#Sx', 'anytincr_wes', '3306');

	if(!$con)
	{
		echo 'Not Connected To Server';
	}

	if(!mysqli_select_db($con, 'anytincr_wes')) {
		echo 'Database Not Selected';
	}

	$Name = $_POST['name'];
	$Email = $_POST['email'];
	$Fileupload = 'image/' .$_FILES['fileupload'];
	$Phone = $_POST['phone'];

	if(preg_match("!image!", $_FILES['fileupload']['type'])){
		
		if(copy($_FILES['fileupload']['tmp_name'],$image_path)){
			
		}
	}
	else{
		echo 'Please upload only JPG or PNG!';
	}

	if($_FILES['fileupload']["size"] > 5000000) {
		echo 'Sorry, your file is too large.<br>';
		$flag = FALSE;
	}
	else {
		echo 'File size Ok<br>';
	}

	// DO NOT TRUST $_FILES['upfile']['mime'] value
	// Check MIME Type by yourself
	//You can check for particular types - see documentation
	//Files smaller than 11 Bytes generate a particular error
	if((exif_imagetype($_FILES['fileupload']['tmp_name']))) {
		echo 'File is an image';
	}
	else {
		$flag = FALSE;
		echo 'File not an image';
	}

	$sql = "INSERT INTO Applicants (name, email, image_path, phone) VALUES ('$Name', '$Email', '$Fileupload', '$Phone')";

	if(!mysqli_query($con,$sql))
	{
		echo 'Not Submitted';
	}
	else {
		echo 'Submitted';
	}
	
	header("refresh: 3; url = anytincreative.com");

?>