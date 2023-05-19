<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Validate inputs (add your own validation)

    $sql = "UPDATE notes SET title='$title', content='$content', updated_at=NOW() WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect back to the main page
        exit;
    } else {
        echo 'Error updating note: ' . $conn->connect_error;
    }
} else {
    $id = $_GET['id'];

    $sql = "SELECT * FROM notes WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
    } else {
        echo 'Note not found.';
        exit;
    }
}

$conn->close();
?>
