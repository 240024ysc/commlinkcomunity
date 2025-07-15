<?php
session_start();
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$username = trim($data["username"]);
$password = trim($data["password"]);

$usersFile = __DIR__ . "/../users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (isset($users[$username]) && password_verify($password, $users[$username]["password"])) {
    $_SESSION["user_id"] = $username;
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "ユーザー名またはパスワードが無効です"]);
}
