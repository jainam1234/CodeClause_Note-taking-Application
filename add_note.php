<?php
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the note details from the request body
  $title = $_POST['title'];
  $content = $_POST['content'];

  // Prepare and execute the SQL query to insert the note into the database
  $stmt = $conn->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $content);
  
  if ($stmt->execute()) {
    // Note added successfully
    echo json_encode(['status' => 'success']);
  } else {
    // Error adding note
    echo json_encode(['status' => 'error']);
  }
} else {
  // Invalid request method
  echo json_encode(['status' => 'error']);
}
