<?php
// courses.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$courses = $courses ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Courses - E-Learning System</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Available Courses</h2>

    <?php if (empty($courses)): ?>
        <p>No courses available currently.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Enroll</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo htmlspecialchars($course['name']); ?></td>
                    <td><?php echo htmlspecialchars($course['description']); ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="course_id" value="<?php echo (int)$course['id']; ?>">
                            <button type="submit">Enroll</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="index.php?page=profile">Back to Profile</a></p>
</div>
</body>
</html>
