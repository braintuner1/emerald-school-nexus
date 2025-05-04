
<?php
require_once '../config.php';
requireLogin();

// Check if user is a teacher
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    echo json_encode(['success' => false, 'message' => 'Access denied. Only teachers can save marks.']);
    exit;
}

// Get JSON data from POST request
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['marks']) || !is_array($data['marks'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data format']);
    exit;
}

$marks = $data['marks'];

// In a real application, you would validate and save the marks to the database
// For this example, we'll just return success

echo json_encode(['success' => true, 'message' => 'Marks saved successfully']);
?>
