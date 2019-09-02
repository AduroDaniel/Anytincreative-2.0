<?php

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

	$sql = "INSERT INTO Applicants (name, email, image_path, phone) VALUES ('$Name', '$Email', '$Fileupload', '$Phone')";

	if(!mysqli_query($con,$sql))
	{
		echo 'Not Submitted';
	}
	else {
		echo 'Submitted';
	}
	
	header("refresh:2; url=index.html");

?>