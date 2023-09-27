<?php
// Include your database connection
//include auth sesion
include("auth_session.php");

// Create a database connection
$conn = mysqli_connect("192.168.4.123", "root","mysql","blogs");



// Fetch blog posts from the database
$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// Fetch comments for each post
function fetchComments($post_id) {
    global $conn;
    $query = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at ASC";
    return mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin: 0;
        }

        p {
            margin: 20px 0;
        }

        h2 {
            font-size: 24px;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        h3 {
            font-size: 20px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <meta charset="UTF-8">
    <title>Blog</title>
</head>
<body>
    <h1>Blog</h1>
            <h2>logged in as <?php echo $_SESSION['username']; ?> </h2>
    <?php
    // Inside your while loop where you display blog posts
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>{$row['title']}</h2>";
        echo "<p>{$row['content']}</p>";

        // Display comments
        $comments = fetchComments($row['id']);
        echo "<h3>Comments</h3>";
        echo "<ul>";
        while ($comment = mysqli_fetch_assoc($comments)) {
            echo "<li>" . htmlspecialchars($comment['name'], ENT_QUOTES, 'UTF-8') . " says: " . htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8') . "</li>";
        }
        echo "</ul>";

        // Comment form
        echo "<form method='POST' action='add_comment.php'>";
        echo "<input type='hidden' name='post_id' value='{$row['id']}'>"; // Include the post_id
        echo "Comment: <textarea name='comment'></textarea><br>";
        echo "<input type='submit' value='Submit Comment'>";
        echo "</form>";
    }

    ?>

    <a href="add_post.php">Add a new post</a>
    <a href="index.php">back to index</a>
</body>
</html>
