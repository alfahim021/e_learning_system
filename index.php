<?php
require_once 'config.php';

$page = $_GET['page'] ?? 'login';

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php?page=login');
    exit;
}

switch ($page) {
    case 'register':
        require_once 'controllers/RegistrationController.php';
        break;
    case 'login':
        require_once 'controllers/LoginController.php';
        break;
    case 'profile':
        require_once 'controllers/ProfileController.php';
        break;
    case 'courses':
        require_once 'controllers/CourseController.php';
        break;
    default:
        echo "Page not found.";
}
?>
