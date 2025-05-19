<?php
// login.php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php?page=profile');
    exit;
}

$errors = $errors ?? [];
$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Login - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Login to Your Account</h2>

    <?php if ($msg): ?>
        <div class="alert success"><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="alert error">
            <?php foreach ($errors as $error) echo "<p>" . htmlspecialchars($error) . "</p>"; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" novalidate>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password" />

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="index.php?page=register">Register here</a></p>
</div>
</body>
</html>
