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
<?php
    header("X-Frame-Options: SAMEORIGIN");
?>

    <meta charset="UTF-8">
    <title>Add Blog Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .toolbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .toolbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .toolbar a:hover {
            color: #007bff;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            animation: slideIn 1s ease-in-out;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-10%);
            }
            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="index.php">Home</a>
        <a href="add_post.php">Add Post</a>
            <p>logged in as <?php echo $_SESSION['username']; ?> </p>
    </div>

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
<p>add posts to fill the page</p>

</body>
</html>
