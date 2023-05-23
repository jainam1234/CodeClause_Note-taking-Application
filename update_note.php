<?php
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $noteId = $_POST['noteId'];
  $updatedContent = $_POST['updatedContent'];

  
  $stmt = $conn->prepare("UPDATE notes SET content = ?, updated_at = NOW() WHERE id = ?");
  $stmt->bind_param("si", $updatedContent, $noteId);

  if ($stmt->execute()) {
    
    echo json_encode(['status' => 'success']);
  } else {
    
    echo json_encode(['status' => 'error']);
  }
} else {
  
  echo json_encode(['status' => 'error']);
}
