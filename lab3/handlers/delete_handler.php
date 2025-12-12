<?php

include '../database/db_connection.php';
require '../jwt_helper.php';
session_start();


// Проверка дали JWT токенот постои и е валиден
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = connectDatabase();

    // Delete student by ID
    $stmt = $db->prepare("DELETE FROM cameras WHERE id = :id AND date >= date('now', '-7 days')");
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
