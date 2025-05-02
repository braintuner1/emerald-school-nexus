
<?php
require_once 'config.php';

// Uncomment to require login
// requireLogin();

// Page configuration
$pageTitle = 'Analytics - Emerald School Nexus';
$pageDescription = 'School Management System Analytics';
$pageHeader = 'Analytics';
$pageSubheader = 'View performance metrics and trends';

$additionalCSS = [];
$additionalJS = ['assets/js/analytics.js'];

// Include Chart.js in the header
$additionalJS[] = 'https://cdn.jsdelivr.net/npm/chart.js';

// Include the header
include 'includes/header.php';
?>

<!-- Analytics Tabs -->
<div class="tabs-container">
    <div class="tabs">
        <button class="tab-button active" data-tab="performance">Performance Overview</button>
        <button class="tab-button" data-tab="subjects">Subject Analysis</button>
        <button class="tab-button" data-tab="trends">Performance Trends</button>
    </div>
    
    <div class="tab-content">
        <!-- Performance Overview Tab -->
        <div id="performance" class="tab-pane active">
            <div class="card">
                <div class="card-content">
                    <h3>Class Performance Overview</h3>
                    <div class="chart-container">
                        <canvas id="classPerformanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Subject Analysis Tab -->
        <div id="subjects" class="tab-pane">
            <div class="card">
                <div class="card-content">
                    <h3>Subject Performance Analysis</h3>
                    <div class="chart-container">
                        <canvas id="subjectPerformanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Performance Trends Tab -->
        <div id="trends" class="tab-pane">
            <div class="card">
                <div class="card-content">
                    <h3>Performance Trends Over Terms</h3>
                    <div class="chart-container">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Analytics Cards -->
<div class="two-column-grid">
    <div class="card">
        <div class="card-content">
            <h3>Top Performing Students</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Average Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // In a real application, these would be fetched from the database
                    $topStudents = [
                        ['name' => 'Jane Doe', 'class' => 'Form 4A', 'score' => '92%'],
                        ['name' => 'John Smith', 'class' => 'Form 3B', 'score' => '89%'],
                        ['name' => 'Mary Johnson', 'class' => 'Form 4A', 'score' => '87%']
                    ];
                    
                    foreach($topStudents as $student):
                    ?>
                        <tr>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['class']; ?></td>
                            <td><?php echo $student['score']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card">
        <div class="card-content">
            <h3>Attendance Overview</h3>
            <div class="chart-container">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
