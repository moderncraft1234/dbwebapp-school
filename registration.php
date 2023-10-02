<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>

<?php
     header("X-Frame-Options: SAMEORIGIN");
?>

</head>
<body>
<?php
require('db.php');

function hashPassword($password) {
    return hash('sha256', $password);
}
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = hashPassword($password);

    // Check if the email and username is already registered
    $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($con, $email_check_query);
    $result2 = mysqli_query($con, $user_check_query);
    $emailcheck = mysqli_fetch_assoc($result);
    $usercheck = mysqli_fetch_assoc($result2);
    if ($usercheck) {

        echo "<p>username already in use <a href='registration.php'>register again pls</a></p>";
    }

    if ($emailcheck) {
        echo "<div class='form'>
              <h3>email already in use please use a different email</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
              </div>";
    } else {
        $create_datetime = date("Y-m-d H:i:s");

        // Use prepared statements to insert data
        $stmt = $con->prepare("INSERT INTO `users` (username, password, email, create_datetime) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $create_datetime);

        if ($stmt->execute()) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Registration failed. Please try again later.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        }

        $stmt->close();
    }


    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if (!mysqli_query($link, "SET a=1")) {
        printf("sqli prevented this is the following sql error: %s\n", mysqli_error($link));
}


} else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Address" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
}
?>
</body>
</html>
