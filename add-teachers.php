
<?php
require_once 'config.php';
requireLogin();

// Set page variables
$pageTitle = 'Add Teachers - Emerald School Nexus';
$pageDescription = 'Add new teachers to the system';
$pageHeader = 'Add Teachers';
$pageSubheader = 'Create new teacher records';
$additionalJS = ['assets/js/add-teachers.js'];

include 'includes/header.php';
?>

<div class="card mb-6">
  <div class="card-content">
    <div class="form-container">
      <form id="addTeacherForm">
        <!-- Personal Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Personal Information</h3>
          
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
          
          <div class="form-row">
            <div class="form-group">
              <label for="dateOfBirth">Date of Birth</label>
              <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-input">
            </div>
            <div class="form-group">
              <label for="joinDate">Join Date *</label>
              <input type="date" id="joinDate" name="joinDate" class="form-input" required>
            </div>
          </div>
        </div>
        
        <!-- Contact Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Contact Information</h3>
          
          <div class="form-row">
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number *</label>
              <input type="tel" id="phone" name="phone" class="form-input" required>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group full-width">
              <label for="address">Residential Address</label>
              <textarea id="address" name="address" class="form-textarea"></textarea>
            </div>
          </div>
        </div>
        
        <!-- Professional Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Professional Information</h3>
          
          <div class="form-row">
            <div class="form-group">
              <label for="qualification">Highest Qualification *</label>
              <select id="qualification" name="qualification" class="form-select" required>
                <option value="">Select qualification</option>
                <option value="Certificate">Certificate</option>
                <option value="Diploma">Diploma</option>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="PhD">PhD</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="specialization">Specialization *</label>
              <input type="text" id="specialization" name="specialization" class="form-input" required>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="experience">Years of Experience *</label>
              <input type="number" id="experience" name="experience" min="0" class="form-input" required>
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
          </div>
        </div>
        
        <!-- Teaching Subjects Section -->
        <div class="form-section">
          <h3 class="form-section-title">Teaching Subjects</h3>
          <p class="section-description">Select subjects taught by this teacher</p>
          
          <div class="form-row">
            <div class="form-group full-width">
              <div class="subjects-container" id="subjectsContainer">
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
                  <button type="button" class="btn btn-outline btn-small add-subject-btn">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Additional Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Additional Information</h3>
          
          <div class="form-row">
            <div class="form-group full-width">
              <label for="notes">Notes</label>
              <textarea id="notes" name="notes" class="form-textarea" placeholder="Any additional information about the teacher"></textarea>
            </div>
          </div>
        </div>
        
        <div class="form-actions">
          <button type="reset" class="btn btn-outline">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Teacher</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bulk Teacher Upload -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Bulk Teacher Upload</h3>
    <p class="card-description">Upload multiple teacher records at once</p>
  </div>
  <div class="card-content">
    <form id="bulkUploadForm">
      <div class="form-group">
        <label for="csvFile">Upload CSV File</label>
        <div class="file-upload-container">
          <input type="file" id="csvFile" name="csvFile" accept=".csv" class="file-input">
          <label for="csvFile" class="file-label">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Choose CSV file</span>
          </label>
          <span class="file-name" id="fileName">No file selected</span>
        </div>
        <small class="form-text">Download a <a href="#" class="text-link">template CSV file</a> to see the required format.</small>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>Upload Teachers</button>
      </div>
    </form>
  </div>
</div>

<style>
  .form-container {
    max-width: 100%;
  }
  
  .form-section {
    margin-bottom: 2rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1.5rem;
    background-color: #fff;
  }
  
  .form-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #10b981;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 0.75rem;
  }
  
  .section-description {
    color: #6b7280;
    margin-top: -1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
  }
  
  .form-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -0.75rem 1.5rem;
  }
  
  .form-group {
    flex: 1;
    padding: 0 0.75rem;
    min-width: 250px;
  }
  
  .full-width {
    flex-basis: 100%;
  }
  
  .form-textarea {
    width: 100%;
    min-height: 100px;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    resize: vertical;
  }
  
  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
  }
  
  .file-upload-container {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 0.5rem;
  }
  
  .file-input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  
  .file-label {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background-color: #f3f4f6;
    color: #4b5563;
    border-radius: 0.375rem;
    cursor: pointer;
    font-weight: 500;
    border: 1px solid #d1d5db;
    transition: all 0.2s;
  }
  
  .file-label:hover {
    background-color: #e5e7eb;
  }
  
  .file-label i {
    margin-right: 0.5rem;
  }
  
  .file-name {
    color: #6b7280;
    font-size: 0.875rem;
  }
  
  .subjects-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  
  .subject-row {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }
  
  .subject-select {
    flex: 1;
  }
  
  .btn-small {
    padding: 0.375rem 0.5rem;
    font-size: 0.875rem;
  }
  
  .text-link {
    color: #10b981;
    text-decoration: none;
    font-weight: 500;
  }
  
  .text-link:hover {
    text-decoration: underline;
  }
</style>

<?php include 'includes/footer.php'; ?>
