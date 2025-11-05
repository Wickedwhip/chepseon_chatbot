<?php
require_once "session.php";
require_once "../db_connect.php";

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
$responses = $conn->query("SELECT * FROM responses ORDER BY id DESC");

// ====== ANALYTICS SECTION ======

// Total messages
$totalMessages = $conn->query("SELECT COUNT(*) AS total FROM chat_logs")->fetch_assoc()['total'] ?? 0;

// Unique keywords (approx by user_message distinct count)
$uniqueKeywords = $conn->query("SELECT COUNT(DISTINCT user_message) AS unique_count FROM chat_logs")->fetch_assoc()['unique_count'] ?? 0;

// Most asked keyword
$mostAsked = $conn->query("SELECT user_message, COUNT(*) AS freq FROM chat_logs GROUP BY user_message ORDER BY freq DESC LIMIT 1")->fetch_assoc();
$mostAskedKeyword = $mostAsked['user_message'] ?? 'N/A';
$mostAskedCount = $mostAsked['freq'] ?? 0;

// Last message timestamp
$lastMessage = $conn->query("SELECT created_at FROM chat_logs ORDER BY created_at DESC LIMIT 1")->fetch_assoc();
$lastMessageTime = $lastMessage['created_at'] ?? 'N/A';

// Data for chart (top 5 most asked)
$chartData = [];
$chartQuery = $conn->query("SELECT user_message, COUNT(*) AS count FROM chat_logs GROUP BY user_message ORDER BY count DESC LIMIT 5");
while ($row = $chartQuery->fetch_assoc()) {
    $chartData[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Chatbot Responses</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 0; }
    .container { width: 90%; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h2 { color: #333; margin-bottom: 10px; }
    .analytics { display: flex; justify-content: space-between; flex-wrap: wrap; margin-bottom: 30px; }
    .box { flex: 1; min-width: 200px; background: #007bff; color: #fff; padding: 15px; border-radius: 8px; margin: 10px; text-align: center; }
    .box h3 { margin: 0; font-size: 1.2em; }
    .box p { margin: 5px 0 0; font-size: 1.5em; font-weight: bold; }
    form { margin-bottom: 20px; }
    input[type="text"] { padding: 8px; margin-right: 5px; width: 25%; border: 1px solid #ccc; border-radius: 4px; }
    button { background: #007bff; color: #fff; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; }
    button:hover { background: #0056b3; }
    table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #eee; }
    a { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
    a:hover { text-decoration: underline; }
    .chart-container { width: 100%; margin: 20px auto; }
  </style>
</head>
<body>

<div class="container">
  <h2>📊 Chatbot Analytics</h2>
  <div class="analytics">
    <div class="box">
      <h3>Total Messages</h3>
      <p><?= $totalMessages ?></p>
    </div>
    <div class="box" style="background:#17a2b8;">
      <h3>Unique Keywords</h3>
      <p><?= $uniqueKeywords ?></p>
    </div>
    <div class="box" style="background:#28a745;">
      <h3>Most Asked Keyword</h3>
      <p><?= htmlspecialchars($mostAskedKeyword) ?> (<?= $mostAskedCount ?>x)</p>
    </div>
    <div class="box" style="background:#6f42c1;">
      <h3>Last Message</h3>
      <p><?= $lastMessageTime ?></p>
    </div>
  </div>

  <div class="chart-container">
    <canvas id="topKeywordsChart"></canvas>
  </div>

  <hr>

  <h2>💬 Manage Chatbot Responses</h2>
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
    <?php while ($row = $responses->fetch_assoc()): ?>
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

</div>

<script>
  const ctx = document.getElementById('topKeywordsChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_column($chartData, 'user_message')) ?>,
      datasets: [{
        label: 'Top 5 Most Asked Keywords',
        data: <?= json_encode(array_column($chartData, 'count')) ?>,
        backgroundColor: ['#007bff','#17a2b8','#28a745','#ffc107','#dc3545']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: true, text: 'Top 5 Most Asked Questions' }
      }
    }
  });
</script>

</body>
</html>
