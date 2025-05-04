
<?php
// Database configuration
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'emerald_school';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set session parameters
session_start();

// Helper functions
function sanitizeInput($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

// Authentication check
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        // Save the requested URL for redirection after login
        if (!empty($_SERVER['REQUEST_URI']) && !in_array(basename($_SERVER['REQUEST_URI']), ['login.php', 'logout.php'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        }
        header("Location: login.php");
        exit;
    }
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Require admin role
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        setFlashMessage('error', 'Access denied. Admin privileges required.');
        header("Location: index.php");
        exit;
    }
}

// Check if user has permission to access a specific subject
function hasSubjectPermission($subject) {
    if (isAdmin()) {
        return true;
    }
    
    if (!isset($_SESSION['subjects_taught'])) {
        return false;
    }
    
    $allowedSubjects = explode(',', $_SESSION['subjects_taught']);
    return in_array($subject, $allowedSubjects);
}

// Check if user has permission to access a specific class
function hasClassPermission($class) {
    if (isAdmin()) {
        return true;
    }
    
    if (!isset($_SESSION['class_assigned'])) {
        return false;
    }
    
    $allowedClasses = explode(',', $_SESSION['class_assigned']);
    return in_array($class, $allowedClasses);
}

// Flash messages
function setFlashMessage($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlashMessage() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

// Check if the current page requires authentication
$publicPages = ['login.php', 'assets', 'logout.php'];
$currentPage = basename($_SERVER['PHP_SELF']);
$isPublicPage = false;

// Check if current page is public
foreach ($publicPages as $page) {
    if (strpos($currentPage, $page) === 0) {
        $isPublicPage = true;
        break;
    }
}

// Force login for non-public pages
if (!$isPublicPage && !isLoggedIn()) {
    requireLogin();
}
?>
