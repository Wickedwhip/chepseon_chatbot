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
?>
<form method="POST">
  <input type="password" name="password" placeholder="Enter password">
  <button type="submit">Login</button>
  <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</form>
