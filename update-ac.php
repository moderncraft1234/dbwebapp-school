<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Account Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .form {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"] {
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
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        a:hover {
            color: #007bff;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <?php
    // Database connection code
$conn = mysqli_connect("127.0.0.1", "root", "mysql", "LoginSystem", 3306);
//require("db.php");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit();
    }

    // Get the logged-in user's username
    $username = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the new username and email from the form
        $newUsername = $_POST['new_username'];
        $newEmail = $_POST['new_email'];

        // Update the user's information in the database
        $updateSql = "UPDATE users SET username = '$newUsername', email = '$newEmail' WHERE username = '$username'";

        if (mysqli_query($conn, $updateSql)) {
            // Update successful
            $_SESSION['username'] = $newUsername; // Update the session username
            header("Location: dashboard.php"); // Redirect to account info page
            exit();
        } else {
            // Update failed
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="form">
        <h1>Update Account Info</h1>
        <form method="post" action="update-ac.php">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" required><br><br>

            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" required><br><br>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
