<!DOCTYPE html>
<html>
<head>
<?php
    header("X-Frame-Options: SAMEORIGIN");
?>

    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
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
    // Enter your host name, database username, password, and database name.
    // If you have not set a database password on localhost, then set it to an empty string.
    //$con = mysqli_connect("192.168.4.123", "root", "mysql", "LoginSystem", 3306);
    require("db.php");

    // Check connection
    if (!$con) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: index2.php"); // Redirect to login page if not logged in
        exit();
    }

    // Get the logged-in user's username
    $username = $_SESSION['username'];

    // Query to retrieve user information
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    // Fetch the user's information
    $row = mysqli_fetch_assoc($result);
    ?>

    <main>
        <section class="account-info">
            <h2>Your Account Information</h2>
            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <!-- Add more user details as needed -->
        </section>
    </main>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>Welcome to account settings</p>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="blog.php">Blog</a></p>
         <p><a href="update-ac.php">update acount info</a></p>
         <p><a href="index.php">HomePage</a></p>
    </div>
</body>
</html>