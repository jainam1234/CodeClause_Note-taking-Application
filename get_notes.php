<?php
include 'db_connect.php';


$stmt = $conn->prepare("SELECT * FROM notes ORDER BY updated_at DESC");
$stmt->execute();


$result = $stmt->get_result();
$notes = [];

while ($row = $result->fetch_assoc()) {
  $notes[] = $row;
}


if (count($notes) > 0) {
  
  echo json_encode($notes);
} else {
  
  echo json_encode(['status' => 'empty']);
}
