<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "write";

// Create a new mysqli instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform the query
$sql = "SELECT * FROM notes";
$result = $conn->query($sql);

// Check if there are any notes
if ($result->num_rows > 0) {
    // Output data of each row
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

// Close the database connection
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


