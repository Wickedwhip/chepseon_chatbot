 <?php
// Database connection settings
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "chepseon_chatbot";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["reply" => "Database connection failed."]));
}
?>
