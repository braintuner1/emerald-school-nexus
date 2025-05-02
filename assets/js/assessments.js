
document.addEventListener('DOMContentLoaded', function() {
  // Modal elements
  const modal = document.getElementById('assessmentModal');
  const openModalBtn = document.getElementById('createAssessmentBtn');
  const closeModalBtn = document.querySelector('.close-btn');
  const cancelBtn = document.getElementById('cancelBtn');
  const assessmentForm = document.getElementById('assessmentForm');
  
  // Tab functionality is handled in main.js
  
  // Open modal
  if (openModalBtn) {
    openModalBtn.addEventListener('click', function() {
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    });
  }
  
  // Close modal
  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
    });
  }
  
  if (cancelBtn) {
    cancelBtn.addEventListener('click', function() {
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
    });
  }
  
  // Close modal when clicking outside
  window.addEventListener('click', function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
    }
  });
  
  // Form submission
  if (assessmentForm) {
    assessmentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const title = document.getElementById('assessmentTitle').value;
      const subject = document.getElementById('subject').value;
      const dueDate = document.getElementById('dueDate').value;
      const maxMarks = document.getElementById('maxMarks').value;
      
      // Get selected classes
      const classCheckboxes = document.querySelectorAll('input[name="classes"]:checked');
      const selectedClasses = Array.from(classCheckboxes).map(cb => cb.value).join(', ');
      
      if (!selectedClasses) {
        alert('Please select at least one class');
        return;
      }
      
      // In a real application, this would submit the data to the server
      // For now, we'll just show an alert
      alert(`Assessment "${title}" for ${subject} created successfully!`);
      
      // Close the modal and reset form
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
      assessmentForm.reset();
      
      // In a real application, we would refresh the list or add the new assessment to the table
    });
  }
  
  // Action button handlers
  const editButtons = document.querySelectorAll('.edit-btn');
  editButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const assessmentName = row.querySelector('td:nth-child(1)').textContent;
      
      // In a real application, this would open an edit form with the assessment details
      alert(`Editing assessment: ${assessmentName}`);
    });
  });
  
  const viewButtons = document.querySelectorAll('.view-btn');
  viewButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const assessmentName = row.querySelector('td:nth-child(1)').textContent;
      
      // In a real application, this would navigate to an assessment detail page
      alert(`Viewing assessment: ${assessmentName}`);
    });
  });
  
  const reportButtons = document.querySelectorAll('.report-btn');
  reportButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const assessmentName = row.querySelector('td:nth-child(1)').textContent;
      
      // In a real application, this would generate or download a report
      alert(`Generating report for: ${assessmentName}`);
    });
  });
});
