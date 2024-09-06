<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invoice_system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
