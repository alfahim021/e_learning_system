<?php
require_once __DIR__ . '/../database/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header('Location: index.php?page=profile');
                exit;
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "User not found.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - E-Learning</title>
</head>
<body>
<h2>Login</h2>

<?php
if (isset($_GET['msg'])) {
    echo "<p style='color:green;'>" . htmlspecialchars($_GET['msg']) . "</p>";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>

<form method="post" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="index.php?page=register">Register here</a>.</p>
</body>
</html>
