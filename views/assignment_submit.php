<?php
// assignment_submit.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$errors = $errors ?? [];
$success_msg = $success_msg ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Submit Assignment - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Submit Assignment</h2>

    <?php if ($success_msg): ?>
        <div class="alert success"><?php echo htmlspecialchars($success_msg); ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="alert error">
            <?php foreach ($errors as $error) echo "<p>" . htmlspecialchars($error) . "</p>"; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" novalidate>
        <label for="assignment_title">Title:</label>
        <input type="text" id="assignment_title" name="title" required placeholder="Assignment title" />

        <label for="assignment_file">Upload File:</label>
        <input type="file" id="assignment_file" name="file" required accept=".pdf,.doc,.docx,.txt" />

        <button type="submit">Submit</button>
    </form>

    <p><a href="index.php?page=profile">Back to Profile</a></p>
</div>
</body>
</html>
