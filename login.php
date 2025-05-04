
<?php
require_once 'config.php';

// Check if user is already logged in
if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$error = '';
$isAdminLogin = isset($_GET['admin']) && $_GET['admin'] == 1;

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = sanitizeInput($_POST['phone']);
    $password = $_POST['password'];
    
    if ($isAdminLogin) {
        // Admin login attempt
        $adminQuery = "SELECT * FROM admins WHERE phone_number = ?";
        $stmt = $conn->prepare($adminQuery);
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            
            // Verify password (in production use password_verify)
            if ($password === $admin['password']) {
                // Set session variables for admin
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['username'] = $admin['name'];
                $_SESSION['role'] = 'admin';
                
                // Redirect to dashboard
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid phone number or password";
            }
        } else {
            $error = "Invalid phone number or password";
        }
    } else {
        // Teacher login attempt
        $teacherQuery = "SELECT * FROM teachers WHERE phone_number = ?";
        $stmt = $conn->prepare($teacherQuery);
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $teacher = $result->fetch_assoc();
            
            // Verify password (in production use password_verify)
            if ($password === $teacher['password']) {
                // Set session variables
                $_SESSION['user_id'] = $teacher['id'];
                $_SESSION['username'] = $teacher['name'];
                $_SESSION['role'] = 'teacher';
                $_SESSION['subjects_taught'] = $teacher['subjects_taught'];
                $_SESSION['class_assigned'] = $teacher['class_assigned'];
                
                // Redirect to dashboard
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid phone number or password";
            }
        } else {
            $error = "Invalid phone number or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isAdminLogin ? 'Admin Login' : 'Teacher Login'; ?> - Emerald School Nexus</title>
    <meta name="description" content="School Management System - Login">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-page">
    <div class="login-header-actions">
        <?php if (!$isAdminLogin): ?>
            <a href="login.php?admin=1" class="btn btn-secondary admin-login-btn">
                <i class="fas fa-user-shield"></i> Admin Login
            </a>
        <?php else: ?>
            <a href="login.php" class="btn btn-secondary teacher-login-btn">
                <i class="fas fa-chalkboard-teacher"></i> Teacher Login
            </a>
        <?php endif; ?>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>Emerald School Nexus</h1>
                <p><?php echo $isAdminLogin ? 'Administrator Login' : 'Teacher Login'; ?></p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="login.php<?php echo $isAdminLogin ? '?admin=1' : ''; ?>" class="login-form">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <div class="form-group remember-me">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
            
            <div class="login-footer">
                <p>&copy; 2025 Emerald School Nexus. All rights reserved.</p>
            </div>
        </div>
    </div>
    
    <script src="assets/js/login.js"></script>
</body>
</html>
