<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

include '../connect.php';
include '../auth.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');

if (empty($username) || empty($password)) {
    echo json_encode(["ok" => false, "message" => "Username dan password tidak boleh kosong"]);
    exit;
}

$auth = new Auth();
$auth->login($username, $password, $conn);

$response = [
    "ok" => $auth->message === "Login successful",
    "message" => $auth->message
];

echo json_encode($response);

?>