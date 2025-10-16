<?php

$hostname = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'todo_list';

$conn = new mysqli($hostname, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    echo 'Connection Failed';
    die('Connection Failed : ' . $conn->connect_error);
}
?>