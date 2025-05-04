
<?php
require_once '../config.php';
requireLogin();

// Check if required parameters are provided
if (!isset($_GET['class']) || !isset($_GET['term']) || !isset($_GET['year'])) {
    echo json_encode(['error' => 'All parameters are required']);
    exit;
}

$class = sanitizeInput($_GET['class']);
$term = sanitizeInput($_GET['term']);
$year = sanitizeInput($_GET['year']);

// Get assessments from the database
// For this example, we'll return mock data
$assessments = ['Mid-Term Exam', 'End-Term Exam', 'CAT 1', 'CAT 2'];

echo json_encode(['assessments' => $assessments]);
?>
