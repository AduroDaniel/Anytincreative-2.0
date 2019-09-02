<?php
$servername = "localhost";
$username = "anytincr_aduro";
$password = "53DfBvb*C@Q!1Vbz#Sx";
$dbname = "anytincr_wes";

$conn = new mysqli($servername, $username, $password, $dbname); // Create connection
if ($conn->connect_error) {     // Check connection
    die("Connection failed: " . $conn->connect_error);
} 

$firstname = mysqli_real_escape_string($conn, $_POST['name']);
$lastname = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['amount']);
$phone = mysqli_real_escape_string($conn, $_POST['times']);

if (strlen($times) > 200000) {  $times = "";    }

$sql = "INSERT INTO usertimes (name,date,amount,times)
VALUES ('$name', CURDATE(), '$amount', '$times') ON DUPLICATE KEY UPDATE    
date=CURDATE(), amount='$amount', times='$times'";

if ($conn->query($sql) === TRUE) {
    echo "Page saved!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>