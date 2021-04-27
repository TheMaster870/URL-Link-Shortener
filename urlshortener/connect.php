<?php
    $DBServerName = "localhost";
    $DBUserName = "DBuserName";
    $DBPassword = "DBpassword";
    $DBName = "DBname";
    $conn = new mysqli($DBServerName, $DBUserName, $DBPassword, $DBName);
    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
?>