
<?php
require_once '../config.php';
requireLogin();

// Check if required parameters are provided
if (!isset($_GET['class']) || !isset($_GET['stream']) || !isset($_GET['subject']) || 
    !isset($_GET['assessment']) || !isset($_GET['term']) || !isset($_GET['year'])) {
    echo json_encode(['error' => 'All parameters are required']);
    exit;
}

$class = sanitizeInput($_GET['class']);
$stream = sanitizeInput($_GET['stream']);
$subject = sanitizeInput($_GET['subject']);
$assessment = sanitizeInput($_GET['assessment']);
$term = sanitizeInput($_GET['term']);
$year = sanitizeInput($_GET['year']);

// Get students and their marks from the database
// For this example, we'll return mock data
$students = [
    ['id' => 1, 'admissionNumber' => 'ADM1001', 'name' => 'John Doe', 'previousMark' => 78],
    ['id' => 2, 'admissionNumber' => 'ADM1002', 'name' => 'Jane Smith', 'previousMark' => 85],
    ['id' => 3, 'admissionNumber' => 'ADM1003', 'name' => 'Alice Johnson', 'previousMark' => 62],
    ['id' => 4, 'admissionNumber' => 'ADM1004', 'name' => 'Robert Brown', 'previousMark' => 91],
    ['id' => 5, 'admissionNumber' => 'ADM1005', 'name' => 'Emily Davis', 'previousMark' => 74],
    ['id' => 6, 'admissionNumber' => 'ADM1006', 'name' => 'Michael Wilson', 'previousMark' => 55],
    ['id' => 7, 'admissionNumber' => 'ADM1007', 'name' => 'Sarah Miller', 'previousMark' => 88],
    ['id' => 8, 'admissionNumber' => 'ADM1008', 'name' => 'Daniel Taylor', 'previousMark' => 79],
    ['id' => 9, 'admissionNumber' => 'ADM1009', 'name' => 'Olivia Moore', 'previousMark' => 46],
    ['id' => 10, 'admissionNumber' => 'ADM1010', 'name' => 'James Anderson', 'previousMark' => 73]
];

echo json_encode(['students' => $students]);
?>
