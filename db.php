<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("127.0.0.1","root","mysql","LoginSystem",3306);
    // Check connection
    if (!$con){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>
