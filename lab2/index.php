<?php
include 'db_connection.php';
$db = connectDatabase();

$query = "SELECT * FROM movies";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Movie List</h1>
    <a href="add_movie_form.php">Add New Movie</a>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Genre</th>
        <th>Release Year</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($movie = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($movie['id']); ?></td>
                <td><?= htmlspecialchars($movie['title']); ?></td>
                <td><?= htmlspecialchars($movie['genre']); ?></td>
                <td><?= htmlspecialchars($movie['release_year']); ?></td>
                <td>
                    <form action="delete_movie.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $movie['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_movie_form.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $movie['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No movies found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
