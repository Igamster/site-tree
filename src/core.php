<?php
 include 'includeTemplate.php';
 include 'authorization.php';
 include 'connectDB.php';
 include 'describe_tree.php';
session_start();
if (!empty($_COOKIE['Email_User']) && userAvthorizatoin()) {
    setcookie("Email_User", $_COOKIE['Email_User'], time() + 60 * 60 * 24 * 30, '/');
}
