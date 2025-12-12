<?php
include '../db_connection.php';

$db = connectDatabase();

$query = 'CREATE TABLE IF NOT EXISTS events(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        location TEXT NOT NULL,
        date DATE NOT NULL,
        type TEXT NOT NULL
    );';

$db->exec($query);