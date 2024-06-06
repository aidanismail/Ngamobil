<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index_login.php");
    exit();
}

// User is logged in, display protected content
echo "Welcome, " . htmlspecialchars($_SESSION['first_name']) . " " . htmlspecialchars($_SESSION['last_name']) . "!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Protected Page</title>
</head>
<body>
  <h1>Protected Content</h1>
  <p>Only logged-in users can see this.</p>
  <a href="logout.php">Logout</a>
</body>
</html>
