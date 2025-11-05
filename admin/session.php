<?php
// session.php — included on all protected admin pages
session_start();

// Set idle timeout duration (e.g. 10 minutes)
$timeout_duration = 600; // seconds = 10 minutes

// Check if logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Check idle timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Session expired
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>
