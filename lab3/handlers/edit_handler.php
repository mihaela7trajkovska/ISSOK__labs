<?php

include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $price = intval($_POST['price']);
    $type = $_POST['type'];

    $db = connectDatabase();

    // Update student details
    $stmt = $db->prepare("UPDATE cameras SET name = :name, location = :location, date = :date,price = :price,type=:type WHERE id = :id");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':location', $location, SQLITE3_TEXT);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':price', $price, SQLITE3_INTEGER);
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
