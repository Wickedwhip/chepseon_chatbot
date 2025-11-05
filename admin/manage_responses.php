<?php
require_once "session.php";       // ensures session and login check
require_once "../db_connect.php"; // connects to DB

// Handle Add
if (isset($_POST['add'])) {
  $keyword = trim($_POST['keyword']);
  $response = trim($_POST['response']);

  if (!empty($keyword) && !empty($response)) {
    $stmt = $conn->prepare("INSERT INTO responses (keyword, response) VALUES (?, ?)");
    $stmt->bind_param("ss", $keyword, $response);
    $stmt->execute();
    $stmt->close();
  }
}

// Handle Delete
if (isset($_POST['delete'])) {
  $id = intval($_POST['id']);
  $conn->query("DELETE FROM responses WHERE id = $id");
}

// Fetch all responses
$result = $conn->query("SELECT * FROM responses ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Chatbot Responses</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
    h2 { color: #333; }
    form { margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #eee; }
    button { background: #007bff; color: white; border: none; padding: 6px 10px; cursor: pointer; border-radius: 4px; }
    button:hover { background: #0056b3; }
    a { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<h2>Manage Chatbot Responses</h2>

<form method="POST">
  <input type="text" name="keyword" placeholder="Keyword" required>
  <input type="text" name="response" placeholder="Response" required>
  <button type="submit" name="add">Add Response</button>
</form>

<table>
  <tr>
    <th>ID</th>
    <th>Keyword</th>
    <th>Response</th>
    <th>Action</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['keyword']) ?></td>
    <td><?= htmlspecialchars($row['response']) ?></td>
    <td>
      <form method="POST" style="display:inline;">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button name="delete" onclick="return confirm('Delete this response?');">Delete</button>
      </form>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<a href="logout.php">Logout</a>

</body>
</html>
