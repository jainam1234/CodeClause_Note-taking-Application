<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "write";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM notes";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        echo "Created at: " . $row["created_at"] . "<br>";
        echo "Updated at: " . $row["updated_at"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No notes found.";
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Note Taking Application</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Note Taking Application</h1>
    <div id="notes-container"></div>
    <form id="add-note-form">
      <input type="text" id="note-title" placeholder="Title">
      <textarea id="note-content" placeholder="Content"></textarea>
      <button type="submit" id="add-note-button">Add Note</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script.js"></script>
</body>
</html>

