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
	$Fileupload = $_POST['fileupload'];
	$Phone = $_POST['phone'];

	$sql = "INSERT INTO Applicants (full name,email,image_path,phone) VALUES ('$Name', '$Email', '$Fileupload', '$Phone')";

	if(!mysqli_query($con,$sql))
	{
		echo 'Not Inserted';
	}
	else {
		echo 'Inserted';
	}

	header("refresh:2; url=prodesignmasterclass.html");

?>