<?php
include 'db_connection.php';

if (!isset($_GET['id'])) {
    die("Invalid movie ID.");
}

$id = intval($_GET['id']);
$db = connectDatabase();

$stmt = $db->prepare("SELECT * FROM movies WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();
$movie = $result->fetchArray(SQLITE3_ASSOC);
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Movie</title>
</head>
<body>
<h1>Update Movie</h1>

<?php if ($movie): ?>
    <form action="update_movie.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($movie['id']); ?>">

        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($movie['title']); ?>" required><br><br>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($movie['genre']); ?>" required><br><br>

        <label>Release Year:</label>
        <input type="number" name="release_year" value="<?= htmlspecialchars($movie['release_year']); ?>" required><br><br>

        <button type="submit">Update Movie</button>
    </form>
<?php else: ?>
    <p>Movie not found.</p>
<?php endif; ?>
</body>
</html>

