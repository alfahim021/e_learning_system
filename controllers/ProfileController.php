<?php
require_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$stmt = $mysqli->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - E-Learning</title>
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
<p>Email: <?php echo htmlspecialchars($email); ?></p>

<p><a href="index.php?page=courses">View Courses</a></p>
<p><a href="index.php?page=login&logout=1">Logout</a></p>

<?php
// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php?page=login');
    exit;
}
?>
</body>
</html>
