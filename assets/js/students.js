
document.addEventListener('DOMContentLoaded', function() {
  // Search functionality
  const searchInput = document.querySelector('.search-input input');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const tableRows = document.querySelectorAll('.students-table tbody tr');
      
      tableRows.forEach(row => {
        const studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const studentId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const studentClass = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (studentName.includes(searchTerm) || studentId.includes(searchTerm) || studentClass.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }
  
  // Class filter
  const classFilter = document.querySelector('.filters select');
  if (classFilter) {
    classFilter.addEventListener('change', function() {
      const filterValue = this.value.toLowerCase();
      const tableRows = document.querySelectorAll('.students-table tbody tr');
      
      if (filterValue === '') {
        // Show all rows if "All Classes" is selected
        tableRows.forEach(row => {
          row.style.display = '';
        });
        return;
      }
      
      tableRows.forEach(row => {
        const studentClass = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (studentClass.includes(filterValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }
  
  // Action button handlers
  const viewButtons = document.querySelectorAll('.view-btn');
  viewButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const studentId = row.querySelector('td:nth-child(1)').textContent;
      const studentName = row.querySelector('td:nth-child(2)').textContent;
      
      // In a real application, this would navigate to a student detail page
      alert(`Viewing student: ${studentName} (${studentId})`);
    });
  });
  
  const editButtons = document.querySelectorAll('.edit-btn');
  editButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const studentId = row.querySelector('td:nth-child(1)').textContent;
      const studentName = row.querySelector('td:nth-child(2)').textContent;
      
      // In a real application, this would open an edit form
      alert(`Editing student: ${studentName} (${studentId})`);
    });
  });
  
  // Color the performance bars based on score
  const performanceBars = document.querySelectorAll('.performance-fill');
  performanceBars.forEach(bar => {
    const score = parseInt(bar.textContent);
    if (score >= 80) {
      bar.style.backgroundColor = '#10b981'; // Green for excellent
    } else if (score >= 60) {
      bar.style.backgroundColor = '#f59e0b'; // Amber for average
    } else {
      bar.style.backgroundColor = '#ef4444'; // Red for poor
    }
  });
});
