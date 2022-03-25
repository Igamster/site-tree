<?php

function connectDB()
{
    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'test';
    $connect = mysqli_connect($host, $user, $password, $dbname);
    if (mysqli_connect_errno()) {
        return false;
    } else {
        return $connect;
    }
}
