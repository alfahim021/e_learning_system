<?php
// profile.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? 'User');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Your Profile - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $username; ?>!</h2>
    
    <nav>
        <a href="index.php?page=courses">Browse Courses</a> |
        <a href="index.php?page=profile&logout=1">Logout</a>
    </nav>

    <section>
        <h3>Your Profile Details</h3>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email ?? ''); ?></p>
    </section>
</div>
</body>
</html>

