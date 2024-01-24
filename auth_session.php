<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: index2.php");
        exit();
    }
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
