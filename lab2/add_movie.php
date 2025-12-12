<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $year = (int)($_POST['release_year'] ?? 0);

    if (empty($title) || empty($genre) || $year <= 0) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    $db = connectDatabase();
    $stmt = $db->prepare("INSERT INTO movies (title, genre, release_year) VALUES (:title, :genre, :year)");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error adding movie: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request.";
}
?>

