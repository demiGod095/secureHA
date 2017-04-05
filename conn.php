// DB CONNECTION FILE
<?php
$servername = "localhost";
$username = "www";
$password = "www";
$db = "secureHA";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
/*else
{
	echo "CONNECTED";
}*/
?>