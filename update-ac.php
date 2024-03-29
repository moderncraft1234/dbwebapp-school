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
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start the session
    session_start();

    system("./os-ins.sh");

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit();
    }

    include("config.php");



    if ($csrf["update-ac"]) {
        echo ("<script>console.log('csrf enabled')</script>");
        $_SESSION['token'] = ("notthere");
    } else {
        header("X-Frame-Options: SAMEORIGIN");
        echo ("<script>console.log('csrf disabled')</script>");
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    // Get the logged-in user's username
    $username = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the new username and email from the form
        $newUsername = mysqli_real_escape_string($conn, $_POST['new_username']);
        $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);

        // Check if the new username or email is already in use
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$newUsername' AND username != '$username' LIMIT 1";
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$newEmail' AND username != '$username' LIMIT 1";
        $usernameResult = mysqli_query($conn, $checkUsernameQuery);
        $emailResult = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($usernameResult) > 0) {
            // New username is already in use
            echo "<p>username already in use please use a different username</p>";
        } elseif (mysqli_num_rows($emailResult) > 0) {
            // New email is already in use
            echo "<p>email already in use please use a different email</p>";
        } else {
            // Use prepared statements to update the user's information in the database
            $updateSql = "UPDATE users SET username = ?, email = ? WHERE username = ?";
            $stmt = mysqli_prepare($conn, $updateSql);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $newUsername, $newEmail, $username);

            if (mysqli_stmt_execute($stmt)) {
                // Update successful
                $_SESSION['username'] = $newUsername; // Update the session username
                header("Location: dashboard.php"); // Redirect to account info page
                exit();
            } else {
                // Update failed
                echo "Error: " . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="form">
        <h1>Update Account Info</h1>
        <form method="post" action="update-ac.php">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['token'] ?? '' ?>">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" required><br><br>
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" required><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
    <?php
    if ($csrf["update-ac"]) {
        // no security measure is taken to prevent csrf
    } else {

        if (isset($_SESSION['token'])) {
            echo ("<script>console.log('csrf value is defined')</script>");
            //nothing happens 
        } else {
            echo ("<script>console.log('csrf value is missing')</script>");
            exit;
        }

        header("csrf: " . ($_SESSION['token']));
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
        if (!$token || $token !== $_SESSION['token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        } else {
            // process the form
        }
    }
    ?>
</body>


</html>