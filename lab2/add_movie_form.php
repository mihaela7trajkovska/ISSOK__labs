<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Movie</title>
</head>
<body>
<h1>Add New Movie</h1>
<form action="add_movie.php" method="POST">
    <label>Title:</label>
    <input type="text" name="title" required><br><br>

    <label>Genre:</label>
    <input type="text" name="genre" required><br><br>

    <label>Release Year:</label>
    <input type="number" name="release_year" required><br><br>

    <button type="submit">Add Movie</button>
</form>
</body>
</html>
