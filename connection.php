<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "royalairline";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // echo"connection done";
}

?>