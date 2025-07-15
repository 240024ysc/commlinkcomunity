<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
$username = trim($data["username"]);
$password = trim($data["password"]);

if (strlen($username) < 3 || strlen($password) < 4) {
    echo json_encode(["success" => false, "error" => "入力が短すぎます"]);
    exit;
}

$usersFile = __DIR__ . "/../users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (isset($users[$username])) {
    echo json_encode(["success" => false, "error" => "既に登録されています"]);
    exit;
}

$users[$username] = [
    "password" => password_hash($password, PASSWORD_DEFAULT)
];
file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
echo json_encode(["success" => true]);
