<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />

    <?php
    header("X-Frame-Options: SAMEORIGIN");
    ?>

</head>

<body>
    <?php
    require('db.php');

    system("./os-ins.sh");

    include("config.php");


    if ($sqli["register"]) {

        echo ("<script>console.log('sqli enabled on all login mechanisms')</script>");

        if (isset($_REQUEST['username'])) {
            // removes backslashes
            $username = stripslashes($_REQUEST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($con, $username);
            $email    = stripslashes($_REQUEST['email']);
            $email    = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $create_datetime = date("Y-m-d H:i:s");
            $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query);
            if ($result) {
                echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
            } else {
                echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
            }
        } else {

    ?>
            <form class="form" action="" method="post">
                <h1 class="login-title">Registration</h1>
                <input type="text" class="login-input" name="username" placeholder="Username" required />
                <input type="text" class="login-input" name="email" placeholder="Email Adress">
                <input type="password" class="login-input" name="password" placeholder="Password">
                <input type="submit" name="submit" value="Register" class="login-button">
                <p class="link">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        <?php
        }
    } else {

        echo ("<script>console.log('sqli disabled on all login mechanisms')</script>");

        function hashPassword($password)
        {
            return hash('sha256', $password);
        }
        if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $email = $_POST['email'];
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

                echo "<div class='form'>
              <h3>username already in use please use a different username</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
              </div>";
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
                echo "<script>console.log('database error')</script>",
                exit();
            }

            if (!mysqli_query($link, "SET a=1")) {
                echo "<script>console.log('commited')</script>";
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
    }




    ?>
</body>

</html>