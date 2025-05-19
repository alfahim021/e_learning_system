<?php
require_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$user_id = $_SESSION['user_id'];

$result = $mysqli->query("SELECT * FROM courses");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_id'])) {
    $course_id = (int)$_POST['course_id'];

    $stmt = $mysqli->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $stmt->close();

        $stmt = $mysqli->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses - E-Learning</title>
</head>
<body>
<h2>Courses</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Course Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    <?php while ($course = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($course['name']); ?></td>
        <td><?php echo htmlspecialchars($course['description']); ?></td>
        <td>
            <form method="post" action="">
                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                <input type="submit" value="Enroll">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="index.php?page=profile">Back to Profile</a></p>
</body>
</html>
