<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'] ?? '';
  if ($password === 'chepseon@2025') {
    $_SESSION['logged_in'] = true;
    header('Location: manage_responses.php');
    exit;
  } else {
    $error = "Incorrect password.";
  }
}
   if (isset($_GET['timeout'])): ?>
  <p style="color:red;">Session expired due to inactivity. Please log in again.</p>
<?php endif;  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Chepseon TVC Chatbot</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background: #e0f2f1;
      font-family: 'Poppins', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      text-align: center;
      width: 320px;
    }
    .login-box h2 {
      margin-bottom: 20px;
      color: #004d40;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }
    .login-box button {
      background: #00796b;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 500;
    }
    .login-box button:hover {
      background: #009688;
    }
    .login-box p {
      color: red;
      margin-top: 10px;
      font-size: 0.9rem;
    }
    .back-link {
      display: inline-block;
      margin-top: 15px;
      color: #00796b;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }
    .back-link:hover {
      color: #004d40;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>
    <form method="POST">
      <input type="password" name="password" placeholder="Enter password" required>
      <button type="submit">Login</button>
      <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    </form>
    <a href="../index.html" class="back-link">← Back to Chatbot</a>
  </div>
</body>
</html>
