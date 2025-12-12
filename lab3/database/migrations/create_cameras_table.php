<?php
include '../db_connection.php';
$db = connectDatabase();

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS cameras (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    location TEXT UNIQUE NOT NULL,
    date DATE NOT NULL,
    price REAL NOT NULL,
    type TEXT NOT NULL
);
SQL;

if ($db->exec($createTableQuery)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}

$db->close();
