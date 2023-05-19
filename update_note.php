<?php
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the note ID and updated content from the request body
  $noteId = $_POST['noteId'];
  $updatedContent = $_POST['updatedContent'];

  // Prepare and execute the SQL query to update the note in the database
  $stmt = $conn->prepare("UPDATE notes SET content = ?, updated_at = NOW() WHERE id = ?");
  $stmt->bind_param("si", $updatedContent, $noteId);

  if ($stmt->execute()) {
    // Note updated successfully
    echo json_encode(['status' => 'success']);
  } else {
    // Error updating note
    echo json_encode(['status' => 'error']);
  }
} else {
  // Invalid request method
  echo json_encode(['status' => 'error']);
}
