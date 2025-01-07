<?php
$servername = "localhost";
$username = "root";
$password = ""; // Adjust according to your setup
$dbname = "bubblebop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
