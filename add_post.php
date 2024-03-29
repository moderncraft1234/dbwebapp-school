<?php
// Include your database connection
$conn = mysqli_connect("127.0.0.1", "root", "mysql", "blogs");

include("config.php");

system("./os-ins.sh");

if ($sqli["blog_post"]) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Insert the post into the database
        $query = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
        mysqli_query($conn, $query);
        //redirect to blog after post
        header("Location: blog.php");
    }
}else{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);

        // Prepare the SQL statement using a prepared statement
        $query = "INSERT INTO posts (title, content) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ss", $title, $content);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Insertion was successful
            echo "<p>you posted</p>";
        } else {
            // Insertion failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // redirect to blog after post
        header("Location: blog.php");


    }
    }




//include auth session
include("auth_session.php");

?>
    <!DOCTYPE html>
        <html lang="en">
                               <head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
                               <meta charset="UTF-8">
                               <title>Add Blog Post</title>
                               </head>
<?php
            header("X-Frame-Options: SAMEORIGIN");
?>

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
