<?php
// Include the database connection file
include './database/db_connection.php';

session_start();
require 'jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ./pages/auth/login.php");

    exit;
}
// Connect to the SQLite database
$db = connectDatabase();

// Fetch all students from the database
$query = "SELECT * FROM cameras";
$result = $db->query($query);

if (!$result) {
    die("Error fetching students: " . $db->lastErrorMsg());
}
?>

<body>
<div>
    <h1>Camera List</h1>
    <a href="./pages/create_page.php">
        Add Expense
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
        <th>Price</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($camera = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($camera['id']); ?></td>
                <td><?php echo htmlspecialchars($camera['name']); ?></td>
                <td><?php echo htmlspecialchars($camera['location']); ?></td>
                <td><?php echo htmlspecialchars($camera['date']); ?></td>
                <td><?php echo htmlspecialchars($camera['price']); ?></td>
                <td><?php echo htmlspecialchars($camera['type']); ?></td>
                <td>
                    <?php $diff = (new DateTime())->diff(new DateTime($camera['date']))->days;
                    if ($diff <= 7): ?>
                        <form action="./handlers/delete_handler.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $camera['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php  else: ?>
                        <p>The camera cannot be deleted (it was installed more than 7 days ago).</p>
                    <?php  endif;?>
                    <form action="pages/edit_page.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $camera['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No expenses found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
