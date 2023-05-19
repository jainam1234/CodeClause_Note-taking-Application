<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'write';

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
