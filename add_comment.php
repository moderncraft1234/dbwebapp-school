<?php
// Include your database connection
$conn = mysqli_connect("192.168.4.123", "root", "mysql", "blogs");
// Include auth session
include("auth_session.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $name = $_SESSION['username'];
    $comment = $_POST['comment'];

    // Check if $post_id is not null or empty
    if (!empty($post_id)) {
        // Create a prepared statement
        $query = "INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "iss", $post_id, $name, $comment);

            // Execute the query
            mysqli_stmt_execute($stmt);

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else {
        // Handle the case where post_id is null or empty
        echo "Error: 'post_id' cannot be null or empty.";
    }
}

// Redirect back to the blog page
header("Location: blog.php");
exit();
?>
