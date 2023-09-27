<!DOCTYPE html>
<html>
<head>
<?php
    header("X-Frame-Options: SAMEORIGIN");
?>

    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
require('db.php');
session_start();

function hashPassword($password) {
    return hash('sha256', $password);
}

// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    
    $hashed_password = hashPassword($password); // Hash the password using SHA-256

    // Check user exists in the database
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='$hashed_password'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);
    
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        // Redirect to user dashboard page
        header("Location: index.php");
    } else {
        echo "<div class='form'>
              <h3>Incorrect Username/password.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
              </div>";
    }
} else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
    </form>
<?php
}
?>
</body>
</html>
