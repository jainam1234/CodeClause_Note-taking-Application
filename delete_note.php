<?php
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the note ID from the request body
  $noteId = $_POST['noteId'];

  // Prepare and execute the SQL query to delete the note from the database
  $stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
  $stmt->bind_param("i", $noteId);

  if ($stmt->execute()) {
    // Note deleted successfully
    echo json_encode(['status' => 'success']);
  } else {
    // Error deleting note
    echo json_encode(['status' => 'error']);
  }
} else {
  // Invalid request method
  echo json_encode(['status' => 'error']);
}
