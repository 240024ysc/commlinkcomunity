<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    http_response_code(403);
    echo json_encode(["reply" => "ログインが必要です"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$message = $data["message"] ?? "";
$apiKey = "YOUR_GEMINI_API_KEY"; // ← Google Gemini APIキーをここに

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$apiKey";
$payload = json_encode([
  "contents" => [
    [
      "role" => "user",
      "parts" => [["text" => $message]]
    ]
  ]
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$reply = $data["candidates"][0]["content"]["parts"][0]["text"] ?? "AIから応答が得られませんでした";
echo json_encode(["reply" => $reply]);
