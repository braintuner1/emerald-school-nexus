
<?php
require_once 'config.php';

// Uncomment to require login
// requireLogin();

// Page configuration
$pageTitle = 'Students - Emerald School Nexus';
$pageDescription = 'School Management System - Students';
$pageHeader = 'Students';
$pageSubheader = 'Manage student records and information';

$headerAction = '
    <button class="btn btn-primary" id="addStudentBtn">
        <i class="fas fa-plus"></i>
        Add New Student
    </button>
';

$additionalCSS = ['assets/css/students.css'];
$additionalJS = ['assets/js/students.js'];

// Include the header
include 'includes/header.php';
?>

<!-- Search and Filter -->
<div class="card search-filter-card">
    <div class="card-content">
        <div class="search-filter">
            <div class="search-input">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search students..." id="studentSearch" />
            </div>
            
            <div class="filters">
                <select id="classFilter">
                    <option value="">All Classes</option>
                    <option value="form1">Form 1</option>
                    <option value="form2">Form 2</option>
                    <option value="form3">Form 3</option>
                    <option value="form4">Form 4</option>
                </select>
                
                <button class="btn btn-outline">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Students Table -->
<div class="card">
    <div class="card-content">
        <table class="data-table students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Performance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // In a real application, these would be fetched from the database
                $students = [
                    ['id' => 'ST12345', 'name' => 'John Doe', 'gender' => 'Male', 'class' => 'Form 3A', 'performance' => 75],
                    ['id' => 'ST12346', 'name' => 'Jane Smith', 'gender' => 'Female', 'class' => 'Form 4B', 'performance' => 92],
                    ['id' => 'ST12347', 'name' => 'Michael Johnson', 'gender' => 'Male', 'class' => 'Form 2C', 'performance' => 68],
                    ['id' => 'ST12348', 'name' => 'Sarah Williams', 'gender' => 'Female', 'class' => 'Form 1A', 'performance' => 81],
                    ['id' => 'ST12349', 'name' => 'David Brown', 'gender' => 'Male', 'class' => 'Form 3B', 'performance' => 63]
                ];
                
                foreach($students as $student):
                ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['gender']; ?></td>
                        <td><?php echo $student['class']; ?></td>
                        <td>
                            <div class="performance-bar">
                                <div class="performance-fill" style="width: <?php echo $student['performance']; ?>%;"><?php echo $student['performance']; ?>%</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn view-btn" data-id="<?php echo $student['id']; ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn edit-btn" data-id="<?php echo $student['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
