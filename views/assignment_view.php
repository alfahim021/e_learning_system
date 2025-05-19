<?php
// assignment_view.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$assignments = $assignments ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Your Assignments - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Your Submitted Assignments</h2>

    <?php if (empty($assignments)): ?>
        <p>No assignments submitted yet.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Submission Date</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['submitted_at']); ?></td>
                    <td><a href="uploads/<?php echo rawurlencode($assignment['file_name']); ?>" target="_blank">Download</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="index.php?page=profile">Back to Profile</a></p>
</div>
</body>
</html>
