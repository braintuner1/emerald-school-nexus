
<?php
require_once 'config.php';
requireLogin();

// Set page variables
$pageTitle = 'Add Students - Emerald School Nexus';
$pageDescription = 'Add new students to the system';
$pageHeader = 'Add Students';
$pageSubheader = 'Create new student records';
$additionalJS = ['assets/js/add-students.js'];

include 'includes/header.php';
?>

<div class="card mb-6">
  <div class="card-content">
    <div class="form-container">
      <form id="addStudentsForm">
        <!-- Student Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Student Information</h3>
          
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
              <label for="admissionNumber">Admission Number *</label>
              <input type="text" id="admissionNumber" name="admissionNumber" class="form-input" required>
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
              <label for="dateOfBirth">Date of Birth *</label>
              <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-input" required>
            </div>
            <div class="form-group">
              <label for="admissionDate">Admission Date *</label>
              <input type="date" id="admissionDate" name="admissionDate" class="form-input" required>
            </div>
          </div>
        </div>
        
        <!-- Class Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Class Information</h3>
          
          <div class="form-row">
            <div class="form-group">
              <label for="class">Class *</label>
              <select id="class" name="class" class="form-select" required>
                <option value="">Select class</option>
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
              </select>
            </div>
            <div class="form-group">
              <label for="stream">Stream *</label>
              <select id="stream" name="stream" class="form-select" required>
                <option value="">Select stream</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Parent/Guardian Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Parent/Guardian Information</h3>
          
          <div class="form-row">
            <div class="form-group">
              <label for="parentName">Parent/Guardian Name *</label>
              <input type="text" id="parentName" name="parentName" class="form-input" required>
            </div>
            <div class="form-group">
              <label for="parentPhone">Phone Number *</label>
              <input type="tel" id="parentPhone" name="parentPhone" class="form-input" required>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="parentEmail">Email Address</label>
              <input type="email" id="parentEmail" name="parentEmail" class="form-input">
            </div>
            <div class="form-group">
              <label for="relationship">Relationship *</label>
              <select id="relationship" name="relationship" class="form-select" required>
                <option value="">Select relationship</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Guardian">Guardian</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group full-width">
              <label for="address">Residential Address *</label>
              <textarea id="address" name="address" class="form-textarea" required></textarea>
            </div>
          </div>
        </div>
        
        <!-- Additional Information Section -->
        <div class="form-section">
          <h3 class="form-section-title">Additional Information</h3>
          
          <div class="form-row">
            <div class="form-group full-width">
              <label for="healthInfo">Health Information</label>
              <textarea id="healthInfo" name="healthInfo" class="form-textarea" placeholder="Any health conditions, allergies or medical requirements"></textarea>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group full-width">
              <label for="notes">Additional Notes</label>
              <textarea id="notes" name="notes" class="form-textarea" placeholder="Any other relevant information"></textarea>
            </div>
          </div>
        </div>
        
        <div class="form-actions">
          <button type="reset" class="btn btn-outline">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bulk Student Upload -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Bulk Student Upload</h3>
    <p class="card-description">Upload multiple student records at once</p>
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
        <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>Upload Students</button>
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
