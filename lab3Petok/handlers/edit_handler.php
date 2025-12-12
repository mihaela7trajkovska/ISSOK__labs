<?php

include '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $location = $_POST['email'];
    $date = $_POST['email'];
    $type = $_POST['email'];


    $db = connectDatabase();

    // Update student details
    $stmt = $db->prepare("UPDATE events SET name = :name, location = :location, date=:date,type=:type WHERE id = :id");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':location', $location, SQLITE3_TEXT);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':type', $type, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();

    // Redirect back to the view page
    header("Location: ../index.php");
    exit();
} else {
    echo "Invalid request.";
}
