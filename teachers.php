
<?php
require_once 'config.php';
requireLogin();

// Set page variables
$pageTitle = 'Teachers - Emerald School Nexus';
$pageDescription = 'School Management System Teachers';
$pageHeader = 'Teachers';
$pageSubheader = 'Manage teacher records';
$additionalJS = ['assets/js/teachers.js'];

// Add New Teacher action button
$headerAction = '<button class="btn btn-primary" id="addTeacherBtn">
                    <i class="fas fa-plus-circle"></i>
                    Add New Teacher
                </button>';

include 'includes/header.php';
?>

<!-- Search and Filters -->
<div class="card mb-6">
  <div class="card-content">
    <div class="search-filter-container">
      <div class="search-input-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="teacherSearch" placeholder="Search teachers..." class="search-input">
      </div>
      
      <div class="filter-container">
        <div class="filter-group">
          <label for="genderFilter">Gender:</label>
          <select id="genderFilter" class="form-select">
            <option value="">All</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        
        <div class="filter-group">
          <label for="classFilter">Class Assigned:</label>
          <select id="classFilter" class="form-select">
            <option value="">All</option>
            <option value="Form 1">Form 1</option>
            <option value="Form 2">Form 2</option>
            <option value="Form 3">Form 3</option>
            <option value="Form 4">Form 4</option>
            <option value="none">None</option>
          </select>
        </div>
        
        <button class="btn btn-outline" id="resetFiltersBtn">
          <i class="fas fa-times"></i>
          Reset
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Teachers Table -->
<div class="card">
  <div class="card-content">
    <div class="table-responsive">
      <table class="data-table" id="teachersTable">
        <thead>
          <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Subjects Taught</th>
            <th>Class Assigned</th>
            <th>Join Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Teacher records will be inserted here via JavaScript -->
        </tbody>
      </table>
    </div>
    
    <div class="pagination-container">
      <div class="pagination">
        <button class="pagination-btn" disabled>
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="pagination-btn active">1</button>
        <button class="pagination-btn">2</button>
        <button class="pagination-btn">3</button>
        <button class="pagination-btn">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      <div class="pagination-info">
        Showing <span id="startRecord">1</span> to <span id="endRecord">10</span> of <span id="totalRecords">15</span> teachers
      </div>
    </div>
  </div>
</div>

<!-- Teacher Summary -->
<div class="card mt-8">
  <div class="card-header">
    <h3 class="card-title">Teacher Summary</h3>
    <p class="card-description">Overview of teaching staff</p>
  </div>
  <div class="card-content">
    <div class="summary-grid">
      <div class="summary-box emerald-gradient">
        <p class="summary-label">Total Staff</p>
        <p class="summary-value" id="totalStaff">0</p>
      </div>
      <div class="summary-box blue-gradient">
        <p class="summary-label">Form Teachers</p>
        <p class="summary-value" id="formTeachers">0</p>
      </div>
      <div class="summary-box amber-gradient">
        <p class="summary-label">Male</p>
        <p class="summary-value" id="maleTeachers">0</p>
      </div>
      <div class="summary-box purple-gradient">
        <p class="summary-label">Female</p>
        <p class="summary-value" id="femaleTeachers">0</p>
      </div>
    </div>
  </div>
</div>

<!-- Add Teacher Modal -->
<div id="addTeacherModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Add New Teacher</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="addTeacherForm">
        <div class="form-row">
          <div class="form-group">
            <label for="firstName">First Name *</label>
            <input type="text" id="firstName" name="firstName" class="form-input" required>
          </div>
          <div class="form-group">
            <label for="lastName">Last Name *</label>
            <input type="text" id="lastName" name="lastName" class="form-input" required>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="staffId">Staff ID *</label>
            <input type="text" id="staffId" name="staffId" class="form-input" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender *</label>
            <select id="gender" name="gender" class="form-select" required>
              <option value="">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" class="form-input" required>
        </div>
        
        <div class="form-group">
          <label>Subjects Taught *</label>
          <div id="subjectsContainer">
            <div class="subject-row">
              <select name="subjects[]" class="form-select subject-select" required>
                <option value="">Select subject</option>
                <option value="Mathematics">Mathematics</option>
                <option value="English">English</option>
                <option value="Kiswahili">Kiswahili</option>
                <option value="Science">Science</option>
                <option value="Social Studies">Social Studies</option>
                <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Biology">Biology</option>
                <option value="Geography">Geography</option>
                <option value="History">History</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="classAssigned">Class Assigned</label>
          <select id="classAssigned" name="classAssigned" class="form-select">
            <option value="">None</option>
            <option value="Form 1">Form 1</option>
            <option value="Form 2">Form 2</option>
            <option value="Form 3">Form 3</option>
            <option value="Form 4">Form 4</option>
          </select>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" id="cancelTeacherBtn">Cancel</button>
      <button class="btn btn-primary" id="saveTeacherBtn">Save Teacher</button>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
