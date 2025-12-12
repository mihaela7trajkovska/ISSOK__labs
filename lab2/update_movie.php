<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = intval($_POST['release_year']);

    $db = connectDatabase();
    $stmt = $db->prepare("UPDATE movies SET title = :title, genre = :genre, release_year = :year WHERE id = :id");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_INTEGER);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    $db->close();
    header("Location: index.php");
    exit;
} else {
    echo "Invalid request.";
}
?>
