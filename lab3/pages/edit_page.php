<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: /auth/login.php");
    exit;
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    // Fetch the current details of the student
    $stmt = $db->prepare("SELECT * FROM cameras WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $camera = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid camera ID.");
}
?>
<h1>Update Camera</h1>

<?php if ($camera) : ?>
    <form action="../handlers/edit_handler.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($camera['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($camera['name']); ?>" required>
        <br>
        <label for="date">Location:</label>
        <input type="date" name="location" id="location" value="<?php echo htmlspecialchars($camera['location']); ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($camera['date']); ?>" required>
        <br>
        <label for="amount">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($camera['price']); ?>" required>
        <br>
        <label for="type">Camera type</label>
        <select name="type" id="type">
            <option <?php echo htmlspecialchars($camera['type']) === 'internal' ? 'selected=true' : ''; ?> value="internal">internal</option>
            <option <?php echo htmlspecialchars($camera['type']) === 'external' ? 'selected=true' : ''; ?> value="external">external</option>
        </select>
        <br/>
        <button type="submit">Update Camera</button>
    </form>
<?php else: ?>
    <p>Camera not found.</p>
<?php endif; ?>
