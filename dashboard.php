<?php
// Start the session
session_start();

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
    header("Location: index2.php"); // Redirect to the login page if not logged in
    exit();
}

// Get the logged-in user's username
$username = $_SESSION['username'];

// Query to retrieve user information using a prepared statement
$sql = "SELECT id, username, email FROM users WHERE username = ?";
$stmt = mysqli_prepare($con, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "s", $username);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    // Bind the result
    mysqli_stmt_bind_result($stmt, $dbId, $dbUsername, $dbEmail);

    // Fetch the user's information
    if (mysqli_stmt_fetch($stmt)) {
        // Output user information
        $row['id'] = $dbId;
        $row['username'] = $dbUsername;
        $row['email'] = $dbEmail;
    } else {
        die("User not found.");
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    die("Error: " . mysqli_error($con));
}

// Close the database connection
mysqli_close($con);
?>

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
    <main>
        <section class="account-info">
            <h2>Your Account Information</h2>
            <p><strong>Account ID:</strong> <?php echo $row['id']; ?> </p>
                <p><strong>Username:</strong>  <?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        </section>
    </main>
    <div class="form">

        <p>Hey, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</p>
        <p>Welcome to account settings</p>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="blog.php">Blog</a></p>
         <p><a href="update-ac.php">Update Account Info</a></p>
         <p><a href="index.php">HomePage</a></p>
    </div>
</body>
</html>
