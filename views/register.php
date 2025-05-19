<?php
// register.php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php?page=profile');
    exit;
}

$errors = $errors ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Register - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Create a New Account</h2>

    <?php if ($errors): ?>
        <div class="alert error">
            <?php foreach ($errors as $error) echo "<p>" . htmlspecialchars($error) . "</p>"; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" novalidate>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required placeholder="Choose a username" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Your email address" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Create a password" />

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Re-enter password" />

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="index.php?page=login">Login here</a></p>
</div>
</body>
</html>
