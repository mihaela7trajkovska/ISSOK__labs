<?php

session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: /auth/login.php");
    exit;
}
?>

<form action="../handlers/create_handler.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />
    <label for="name">Location:</label>
    <input type="text" name="location" id="location" required>
    <br />
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>
    <br />
    <label for="amount">Price:</label>
    <input type="number" name="price" id="price" required>
    <br />
    <label for="type">Camera type</label>
    <select name="type" id="type">
        <option value="cash">internal</option>
        <option value="card">external</option>
    </select>
    <br />
    <button type="submit">Add Camera</button>
</form>