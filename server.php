<?php
// 🧩 Enable error reporting (for development — remove on production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 🧩 Return JSON
header("Content-Type: application/json");

// 🧩 Connect to database
require_once "db_connect.php";

// 🧩 Make sure we got a message
if (isset($_POST['message'])) {
    $userMessage = strtolower(trim($_POST['message']));
    $botReply = "";

    // 🔍 Match keyword from database
    $stmt = $conn->prepare("SELECT response FROM responses WHERE ? LIKE CONCAT('%', keyword, '%') LIMIT 1");
    $stmt->bind_param("s", $userMessage);
    $stmt->execute();
    $stmt->bind_result($botReply);
    $stmt->fetch();
    $stmt->close();

    // 🧠 Default fallback if nothing found
    if (empty($botReply)) {
        $botReply = "Sorry, I didn’t get that. Try asking about 'courses', 'fees', or 'contacts'.";
    }

    // 🪣 Log the conversation (store question and reply)
    $log = $conn->prepare("INSERT INTO chat_logs (user_message, bot_reply) VALUES (?, ?)");
    $log->bind_param("ss", $userMessage, $botReply);
    $log->execute();
    $log->close();

    // ✅ Respond to frontend
    echo json_encode(["reply" => $botReply]);

} else {
    // 🚫 No message received
    echo json_encode(["reply" => "No message received."]);
}

// 🧹 Close DB connection
$conn->close();
?>
