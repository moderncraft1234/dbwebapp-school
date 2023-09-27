<?php
// Include your database connection
$conn = mysqli_connect("192.168.4.123", "root","mysql","blogs");
//include auth sesion
include("auth_session.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');

    // Insert the post into the database
    $query = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    mysqli_query($conn, $query);
}
?>

    <!DOCTYPE html>
        <html lang="en">
                               <head>
                               <meta charset="UTF-8">
                               <title>Add Blog Post</title>
                               </head>
                               <body>
                               <h1>Add Blog Post</h1>
                               <form method="POST" action="add_post.php">
                               Title: <input type="text" name="title"><br>
                               Content: <textarea name="content"></textarea><br>
                               <input type="submit" value="Add Post">
                               </form>
                               <a href="blog.php">Back to Blog</a>
                               </body>
                               </html>
