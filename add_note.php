<?php
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $title = $_POST['title'];
  $content = $_POST['content'];

  
  $stmt = $conn->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $content);
  
  if ($stmt->execute()) {
    
    echo json_encode(['status' => 'success']);
  } else {
    
    echo json_encode(['status' => 'error']);
  }
} else {
  
  echo json_encode(['status' => 'error']);
}
