<?php
header('Content-type : application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');

include '../connect.php';
include '../auth.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$auth = new Auth();
$auth->login($username, $password, $conn);
echo json_encode(['message' => $auth->messageAuth()]);

?>