<?php
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$message=$_POST['message'];

		$to='adurodaniel@gmail.com';
		$subject='Form Submission';
		$message="Name: ".$name."\n".$phone."\n". "Wrote the following: "."\n\n".$msg;
		$headers="From: "$email;

		if(mail($to, $subject, $message, $header)){
			echo "<h1>Sent Successfully! Thank you"." ".$name.", We will contact you shortly!</h1>;
		}
		else{
			echo "Something went wrong!";
		}
	}
?>