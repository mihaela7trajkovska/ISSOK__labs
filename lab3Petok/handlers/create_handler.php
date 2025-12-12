<?php

// Include the database connection file
include '../database/db_connection.php';

// Check if the request method is POST to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values from the POST request, with basic validation
    $name = $_POST['name'] ?? '';
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $type = $_POST['type'] ?? '';




    // Connect to the SQLite database
    $db = connectDatabase();

    // Prepare and execute the insert statement
    $stmt = $db->prepare("INSERT INTO events (name, location, date,type) VALUES (:name, :location, :date,:type)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':location', $location, SQLITE3_TEXT);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':type', $type, SQLITE3_TEXT);


    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the view page
        header("Location: ../index.php");
    } else {
        echo "Error adding event: " . $db->lastErrorMsg();
    }

    // Close the database connection
    $db->close();
} else {
    // If not a POST request, display an error message
    echo "Invalid request method. Please submit the form to add a event.";
}
