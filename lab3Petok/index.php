<?php
include './database/db_connection.php';
session_start();
require 'jwt_helper.php';

// Проверка дали JWT токенот постои и е валиден
if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ./pages/auth/login.php");
    exit;
}
// Connect to the SQLite database
$db = connectDatabase();

// Fetch all students from the database
$query = "SELECT * FROM events";
$result = $db->query($query);

if (!$result) {
    die("Error fetching events: " . $db->lastErrorMsg());
}
?>

<body>
<div>
    <h1>Events List</h1>
    <a href="./pages/create.php">
        Add Event
    </a>
    <a href="./handlers/auth/logout_handler.php">
        Одјави се
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Date</th>

        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($event = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['id']); ?></td>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['location']); ?></td>
                <td><?php echo htmlspecialchars($event['date']); ?></td>

                <td><?php echo htmlspecialchars($event['type']); ?></td>
                <td>
                    <?php if ($event['type'] !='private'): ?>
                        <form action="./handlers/delete_handler.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php else:?>
                    <p>„Приватен настан не може да се избрише.“</p>
                    <?php endif ?>
                    <form action="./pages/edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No events found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
