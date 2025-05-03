
<?php
require_once 'config.php';
requireLogin();

// Set page variables
$pageTitle = 'Student Marks - Emerald School Nexus';
$pageDescription = 'Upload and manage student marks';
$pageHeader = 'Student Marks';
$pageSubheader = 'Upload and manage marks for assessments';
$additionalJS = ['assets/js/marks.js'];
$additionalCSS = ['assets/css/marks.css'];

// Add Action button
$headerAction = '<button class="btn btn-primary" id="saveMarksBtn">
                    <i class="fas fa-save"></i>
                    Save All Marks
                </button>';

include 'includes/header.php';
?>

<!-- Class and Subject Selection -->
<div class="card mb-6">
  <div class="card-content">
    <div class="filter-group-container">
      <div class="filter-group">
        <label for="termFilter">Term:</label>
        <select id="termFilter" class="form-select">
          <option value="1">Term 1</option>
          <option value="2">Term 2</option>
          <option value="3">Term 3</option>
        </select>
      </div>
      
      <div class="filter-group">
        <label for="yearFilter">Year:</label>
        <select id="yearFilter" class="form-select">
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
      </div>
      
      <div class="filter-group">
        <label for="classFilter">Class:</label>
        <select id="classFilter" class="form-select">
          <option value="">Select Class</option>
          <option value="Form 1">Form 1</option>
          <option value="Form 2">Form 2</option>
          <option value="Form 3">Form 3</option>
          <option value="Form 4">Form 4</option>
        </select>
      </div>
      
      <div class="filter-group">
        <label for="streamFilter">Stream:</label>
        <select id="streamFilter" class="form-select" disabled>
          <option value="">Select Stream</option>
        </select>
      </div>
      
      <div class="filter-group">
        <label for="subjectFilter">Subject:</label>
        <select id="subjectFilter" class="form-select" disabled>
          <option value="">Select Subject</option>
        </select>
      </div>
      
      <div class="filter-group">
        <label for="assessmentFilter">Assessment:</label>
        <select id="assessmentFilter" class="form-select" disabled>
          <option value="">Select Assessment</option>
        </select>
      </div>
    </div>

    <div class="mt-4">
      <button id="loadStudentsBtn" class="btn btn-secondary" disabled>
        <i class="fas fa-users"></i>
        Load Students
      </button>
    </div>
  </div>
</div>

<!-- Marks Table -->
<div class="card">
  <div class="card-content">
    <div id="marksTableContainer" class="marks-table-container hidden">
      <div class="table-responsive">
        <table id="marksTable" class="data-table marks-table">
          <thead>
            <tr>
              <th>Admission #</th>
              <th>Name</th>
              <th>Previous Mark</th>
              <th>Current Mark</th>
              <th>Grade</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody id="marksTableBody">
            <!-- Rows will be populated via JavaScript -->
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        <div class="alert alert-info">
          <i class="fas fa-info-circle"></i>
          <span>Enter marks between 0-100. Click "Save All Marks" when finished to submit.</span>
        </div>

        <div class="statistics-container mt-4">
          <div class="statistic-box">
            <span class="statistic-label">Class Average:</span>
            <span id="classAverage" class="statistic-value">--</span>
          </div>
          <div class="statistic-box">
            <span class="statistic-label">Highest Mark:</span>
            <span id="highestMark" class="statistic-value">--</span>
          </div>
          <div class="statistic-box">
            <span class="statistic-label">Lowest Mark:</span>
            <span id="lowestMark" class="statistic-value">--</span>
          </div>
        </div>
      </div>
    </div>
    
    <div id="noSelectionMessage" class="text-center py-8">
      <i class="fas fa-clipboard-list text-gray-400" style="font-size: 3rem;"></i>
      <p class="mt-4 text-gray-500">Select a class, stream, subject, and assessment to load students</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
