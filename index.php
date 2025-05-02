
<?php
require_once 'config.php';

// Uncomment to require login
// requireLogin();

// Page configuration
$pageTitle = 'Dashboard - Emerald School Nexus';
$pageDescription = 'School Management System Dashboard';
$pageHeader = 'Dashboard';
$pageSubheader = 'Welcome back to Emerald School Nexus';

$headerAction = '
    <button class="btn btn-primary">
        <i class="fas fa-check-square"></i>
        Generate Reports
    </button>
';

$additionalJS = [];

// Include the header
include 'includes/header.php';
?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card emerald-gradient">
        <div class="stat-info">
            <p class="stat-title">Total Students</p>
            <h3 class="stat-value">524</h3>
            <div class="stat-trend positive">
                <span>+5.2%</span>
                <span class="trend-label">from last term</span>
            </div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
    
    <div class="stat-card blue-gradient">
        <div class="stat-info">
            <p class="stat-title">Total Teachers</p>
            <h3 class="stat-value">42</h3>
        </div>
        <div class="stat-icon">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
    </div>
    
    <div class="stat-card amber-gradient">
        <div class="stat-info">
            <p class="stat-title">Assessments Completed</p>
            <h3 class="stat-value">8</h3>
            <div class="stat-trend positive">
                <span>+12.5%</span>
                <span class="trend-label">from last term</span>
            </div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-clipboard-check"></i>
        </div>
    </div>
    
    <div class="stat-card purple-gradient">
        <div class="stat-info">
            <p class="stat-title">Pending Reports</p>
            <h3 class="stat-value">3</h3>
        </div>
        <div class="stat-icon">
            <i class="fas fa-file-alt"></i>
        </div>
    </div>
</div>

<!-- Quick Access Cards -->
<h2 class="section-title">Quick Access</h2>
<div class="cards-grid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Students</h3>
            <div class="card-icon emerald-bg">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="card-content">
            <p>Manage student records, add new students, and view performance data.</p>
        </div>
        <div class="card-footer">
            <a href="students.php" class="btn btn-outline">Manage Students</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Assessments</h3>
            <div class="card-icon blue-bg">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
        <div class="card-content">
            <p>Create and manage assessments, input marks, and track performance.</p>
        </div>
        <div class="card-footer">
            <a href="assessments.php" class="btn btn-outline">Manage Assessments</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Report Cards</h3>
            <div class="card-icon amber-bg">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
        <div class="card-content">
            <p>Generate student report cards based on assessment results.</p>
        </div>
        <div class="card-footer">
            <a href="reports.php" class="btn btn-outline">Generate Reports</a>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<h2 class="section-title">Recent Activities</h2>
<div class="card activities-card">
    <div class="card-content">
        <ul class="activities-list">
            <?php
            // In a real application, these would be fetched from the database
            $activities = [
                [
                    'icon' => 'fas fa-book-open',
                    'icon_bg' => 'emerald-bg',
                    'title' => 'Mid-Term Assessments Created',
                    'description' => 'Form 3 mid-term assessment has been added',
                    'time' => '2 hours ago'
                ],
                [
                    'icon' => 'fas fa-users',
                    'icon_bg' => 'blue-bg',
                    'title' => 'New Students Added',
                    'description' => '5 new students have been added to Form 1C',
                    'time' => 'Yesterday'
                ],
                [
                    'icon' => 'fas fa-award',
                    'icon_bg' => 'amber-bg',
                    'title' => 'Reports Generated',
                    'description' => 'End-term reports for Form 4 have been generated',
                    'time' => '3 days ago'
                ]
            ];
            
            foreach($activities as $activity):
            ?>
                <li class="activity-item">
                    <div class="activity-icon <?php echo $activity['icon_bg']; ?>">
                        <i class="<?php echo $activity['icon']; ?>"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-title"><?php echo $activity['title']; ?></p>
                        <p class="activity-description"><?php echo $activity['description']; ?></p>
                        <p class="activity-time"><?php echo $activity['time']; ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
