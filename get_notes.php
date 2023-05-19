<?php
include 'db_connect.php';

// Prepare and execute the SQL query to fetch all notes from the database
$stmt = $conn->prepare("SELECT * FROM notes ORDER BY updated_at DESC");
$stmt->execute();

// Fetch the result and store it as an associative array
$result = $stmt->get_result();
$notes = [];

while ($row = $result->fetch_assoc()) {
  $notes[] = $row;
}

// Check if there are any notes
if (count($notes) > 0) {
  // Send the notes as JSON response
  echo json_encode($notes);
} else {
  // Send a JSON response with a status message
  echo json_encode(['status' => 'empty']);
}
