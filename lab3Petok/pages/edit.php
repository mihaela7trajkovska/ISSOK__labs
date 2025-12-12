<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

// Проверка дали JWT токенот постои и е валиден
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ./auth/login.php");
    exit;
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    // Fetch the current details of the student
    $stmt = $db->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $event = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid event ID.");
}
?>

<h1>Update events</h1>

<?php if ($event): ?>
    <form action="" method="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
        <br>
        <label for="name">Location:</label>
        <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
        <br>

        <label for="type">type</label>
        <select name="type" id="type">
            <option <?php echo htmlspecialchars($event['type']) === 'private' ? 'selected=true' : ''; ?> value="private">private</option>
            <option <?php echo htmlspecialchars($event['type']) === 'public' ? 'selected=true' : ''; ?> value="public">public</option>
        </select>
        <br/>
        <button type="submit">Update Event</button>
    </form>
<?php else: ?>
    <p>Event not found.</p>
<?php endif; ?>
