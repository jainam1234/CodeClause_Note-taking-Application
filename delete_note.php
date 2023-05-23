<?php
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $noteId = $_POST['noteId'];

  
  $stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
  $stmt->bind_param("i", $noteId);

  if ($stmt->execute()) {
    
    echo json_encode(['status' => 'success']);
  } else {
    
    echo json_encode(['status' => 'error']);
  }
} else {
  
  echo json_encode(['status' => 'error']);
}
