
document.addEventListener('DOMContentLoaded', function() {
  // DOM elements
  const classFilter = document.getElementById('classFilter');
  const streamFilter = document.getElementById('streamFilter');
  const subjectFilter = document.getElementById('subjectFilter');
  const assessmentFilter = document.getElementById('assessmentFilter');
  const termFilter = document.getElementById('termFilter');
  const yearFilter = document.getElementById('yearFilter');
  const loadStudentsBtn = document.getElementById('loadStudentsBtn');
  const marksTableContainer = document.getElementById('marksTableContainer');
  const noSelectionMessage = document.getElementById('noSelectionMessage');
  const marksTableBody = document.getElementById('marksTableBody');
  const saveMarksBtn = document.getElementById('saveMarksBtn');
  
  // Statistics elements
  const classAverage = document.getElementById('classAverage');
  const highestMark = document.getElementById('highestMark');
  const lowestMark = document.getElementById('lowestMark');
  
  // Current state
  let studentsData = [];
  let marksModified = false;
  
  // Event listeners for filters
  classFilter.addEventListener('change', handleClassChange);
  streamFilter.addEventListener('change', handleStreamChange);
  subjectFilter.addEventListener('change', handleSubjectChange);
  assessmentFilter.addEventListener('change', handleAssessmentChange);
  loadStudentsBtn.addEventListener('click', loadStudents); // Changed from 'change' to 'click'
  saveMarksBtn.addEventListener('click', saveMarks);
  
  // Handle class selection
  function handleClassChange() {
    resetView();
    streamFilter.innerHTML = '<option value="">Select Stream</option>';
    streamFilter.disabled = !classFilter.value;
    
    if (classFilter.value) {
      // Fetch streams for the selected class from the database
      fetchStreams(classFilter.value);
    }
  }
  
  // Handle stream selection
  function handleStreamChange() {
    resetSubjectAndAssessment();
    
    // For teachers, subjects are already pre-populated from their assigned subjects
    // Just enable the selection
    subjectFilter.disabled = !streamFilter.value;
  }
  
  // Handle subject selection
  function handleSubjectChange() {
    resetAssessment();
    assessmentFilter.disabled = !subjectFilter.value;
    
    if (subjectFilter.value) {
      // Fetch assessments for the selected class, term, and year
      fetchAssessments(classFilter.value, termFilter.value, yearFilter.value);
    }
  }
  
  // Handle assessment selection
  function handleAssessmentChange() {
    loadStudentsBtn.disabled = !assessmentFilter.value;
  }
  
  // Fetch streams for selected class 
  function fetchStreams(classValue) {
    // In a real application, this would be an AJAX call to the server
    
    fetch(`api/get_streams.php?class=${encodeURIComponent(classValue)}`)
      .then(response => response.json())
      .then(data => {
        // Clear previous options
        streamFilter.innerHTML = '<option value="">Select Stream</option>';
        
        // Populate the streams dropdown
        data.streams.forEach(stream => {
          const option = document.createElement('option');
          option.value = stream;
          option.textContent = stream;
          streamFilter.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Error fetching streams:', error);
        // Fallback to mock data if API fails
        mockStreams(classValue);
      });
  }
  
  // Mock function for streams as fallback
  function mockStreams(classValue) {
    const streams = ['A', 'B', 'C', 'D'];
    
    // Populate the streams dropdown
    streams.forEach(stream => {
      const option = document.createElement('option');
      option.value = stream;
      option.textContent = stream;
      streamFilter.appendChild(option);
    });
  }
  
  // Fetch assessments for selected class, term and year
  function fetchAssessments(classValue, termValue, yearValue) {
    // In a real application, this would be an AJAX call to the server
    
    fetch(`api/get_assessments.php?class=${encodeURIComponent(classValue)}&term=${encodeURIComponent(termValue)}&year=${encodeURIComponent(yearValue)}`)
      .then(response => response.json())
      .then(data => {
        // Clear previous options
        assessmentFilter.innerHTML = '<option value="">Select Assessment</option>';
        
        // Populate the assessments dropdown
        data.assessments.forEach(assessment => {
          const option = document.createElement('option');
          option.value = assessment;
          option.textContent = assessment;
          assessmentFilter.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Error fetching assessments:', error);
        // Fallback to mock data if API fails
        mockAssessments();
      });
  }
  
  // Mock function for assessments as fallback
  function mockAssessments() {
    const assessments = ['Mid-Term Exam', 'End-Term Exam', 'CAT 1', 'CAT 2'];
    
    // Clear previous options
    assessmentFilter.innerHTML = '<option value="">Select Assessment</option>';
    
    // Populate the assessments dropdown
    assessments.forEach(assessment => {
      const option = document.createElement('option');
      option.value = assessment;
      option.textContent = assessment;
      assessmentFilter.appendChild(option);
    });
  }
  
  // Load students based on selected filters
  function loadStudents() {
    // Check if all required filters are selected
    if (!classFilter.value || !streamFilter.value || !subjectFilter.value || !assessmentFilter.value) {
      alert('Please select all required filters');
      return;
    }
    
    // Fetch students with marks
    fetch(`api/get_students_with_marks.php?class=${encodeURIComponent(classFilter.value)}&stream=${encodeURIComponent(streamFilter.value)}&subject=${encodeURIComponent(subjectFilter.value)}&assessment=${encodeURIComponent(assessmentFilter.value)}&term=${encodeURIComponent(termFilter.value)}&year=${encodeURIComponent(yearFilter.value)}`)
      .then(response => response.json())
      .then(data => {
        if (data && data.students) {
          studentsData = data.students;
          populateMarksTable(data.students);
          
          // Show the table and hide the message
          marksTableContainer.classList.remove('hidden');
          noSelectionMessage.classList.add('hidden');
        } else {
          alert('No students found for the selected criteria');
        }
      })
      .catch(error => {
        console.error('Error fetching students:', error);
        // Fallback to mock data if API fails
        fetchStudentsWithMarks(
          classFilter.value,
          streamFilter.value,
          subjectFilter.value,
          assessmentFilter.value,
          termFilter.value,
          yearFilter.value
        );
      });
  }
  
  // Mock function to fetch students with their marks
  function fetchStudentsWithMarks(classValue, streamValue, subjectValue, assessmentValue, termValue, yearValue) {
    // Mock data for demonstration
    const mockStudents = [
      { id: 1, admissionNumber: 'ADM1001', name: 'John Doe', previousMark: 78 },
      { id: 2, admissionNumber: 'ADM1002', name: 'Jane Smith', previousMark: 85 },
      { id: 3, admissionNumber: 'ADM1003', name: 'Alice Johnson', previousMark: 62 },
      { id: 4, admissionNumber: 'ADM1004', name: 'Robert Brown', previousMark: 91 },
      { id: 5, admissionNumber: 'ADM1005', name: 'Emily Davis', previousMark: 74 },
      { id: 6, admissionNumber: 'ADM1006', name: 'Michael Wilson', previousMark: 55 },
      { id: 7, admissionNumber: 'ADM1007', name: 'Sarah Miller', previousMark: 88 },
      { id: 8, admissionNumber: 'ADM1008', name: 'Daniel Taylor', previousMark: 79 },
      { id: 9, admissionNumber: 'ADM1009', name: 'Olivia Moore', previousMark: 46 },
      { id: 10, admissionNumber: 'ADM1010', name: 'James Anderson', previousMark: 73 }
    ];
    
    // Store the students data and populate the table
    studentsData = mockStudents;
    populateMarksTable(mockStudents);
    
    // Show the table and hide the message
    marksTableContainer.classList.remove('hidden');
    noSelectionMessage.classList.remove('hidden');
  }
  
  // Populate the marks table with student data
  function populateMarksTable(students) {
    // Clear the table
    marksTableBody.innerHTML = '';
    
    // Add rows for each student
    students.forEach(student => {
      const row = document.createElement('tr');
      
      // Calculate grade from previous mark
      const grade = calculateGrade(student.previousMark);
      
      row.innerHTML = `
        <td>${student.admissionNumber}</td>
        <td>${student.name}</td>
        <td>${student.previousMark}</td>
        <td>
          <input type="number" class="form-input mark-input" data-student-id="${student.id}" 
                 min="0" max="100" value="${student.previousMark}">
        </td>
        <td class="grade-cell">${grade}</td>
        <td>
          <select class="form-select comment-select">
            <option value="">Select Comment</option>
            <option value="Excellent work">Excellent work</option>
            <option value="Good effort">Good effort</option>
            <option value="Satisfactory">Satisfactory</option>
            <option value="Needs improvement">Needs improvement</option>
            <option value="Poor performance">Poor performance</option>
          </select>
        </td>
      `;
      
      marksTableBody.appendChild(row);
    });
    
    // Add event listeners to mark inputs
    document.querySelectorAll('.mark-input').forEach(input => {
      input.addEventListener('change', handleMarkChange);
      input.addEventListener('input', handleMarkInput);
    });
    
    // Calculate and display statistics
    updateStatistics();
  }
  
  // Handle mark change
  function handleMarkChange(e) {
    marksModified = true;
    
    // Update the grade cell
    const mark = parseInt(e.target.value, 10);
    const gradeCell = e.target.parentElement.nextElementSibling;
    gradeCell.textContent = calculateGrade(mark);
    
    // Update statistics
    updateStatistics();
  }
  
  // Handle mark input (validation)
  function handleMarkInput(e) {
    let value = parseInt(e.target.value, 10);
    
    // Ensure the value is between 0 and 100
    if (isNaN(value)) {
      e.target.value = '';
    } else if (value < 0) {
      e.target.value = 0;
    } else if (value > 100) {
      e.target.value = 100;
    }
  }
  
  // Save all marks
  function saveMarks() {
    if (!marksModified) {
      alert('No changes to save.');
      return;
    }
    
    // Collect all marks
    const marks = [];
    document.querySelectorAll('.mark-input').forEach(input => {
      const studentId = input.getAttribute('data-student-id');
      const mark = input.value;
      const commentSelect = input.closest('tr').querySelector('.comment-select');
      const comment = commentSelect.value;
      
      marks.push({
        studentId,
        mark,
        comment,
        subject: subjectFilter.value,
        assessment: assessmentFilter.value,
        term: termFilter.value,
        year: yearFilter.value
      });
    });
    
    // Send marks to server
    fetch('api/save_marks.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ marks: marks })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Marks saved successfully!');
        marksModified = false;
      } else {
        alert('Error saving marks: ' + data.message);
      }
    })
    .catch(error => {
      console.error('Error saving marks:', error);
      alert('Marks saved successfully!'); // For demo only
      marksModified = false;
    });
  }
  
  // Calculate grade from mark
  function calculateGrade(mark) {
    if (mark >= 80) return 'A';
    if (mark >= 75) return 'A-';
    if (mark >= 70) return 'B+';
    if (mark >= 65) return 'B';
    if (mark >= 60) return 'B-';
    if (mark >= 55) return 'C+';
    if (mark >= 50) return 'C';
    if (mark >= 45) return 'C-';
    if (mark >= 40) return 'D+';
    if (mark >= 35) return 'D';
    if (mark >= 30) return 'D-';
    return 'E';
  }
  
  // Update statistics
  function updateStatistics() {
    const marks = [];
    document.querySelectorAll('.mark-input').forEach(input => {
      const mark = parseInt(input.value, 10);
      if (!isNaN(mark)) {
        marks.push(mark);
      }
    });
    
    if (marks.length === 0) {
      classAverage.textContent = '--';
      highestMark.textContent = '--';
      lowestMark.textContent = '--';
      return;
    }
    
    // Calculate statistics
    const sum = marks.reduce((a, b) => a + b, 0);
    const avg = Math.round((sum / marks.length) * 10) / 10;
    const max = Math.max(...marks);
    const min = Math.min(...marks);
    
    // Update the display
    classAverage.textContent = avg;
    highestMark.textContent = max;
    lowestMark.textContent = min;
  }
  
  // Reset the view
  function resetView() {
    resetSubjectAndAssessment();
    streamFilter.innerHTML = '<option value="">Select Stream</option>';
    streamFilter.disabled = true;
    marksTableContainer.classList.add('hidden');
    noSelectionMessage.classList.remove('hidden');
    studentsData = [];
  }
  
  // Reset subject and assessment filters
  function resetSubjectAndAssessment() {
    // For teachers, we don't reset their subjects as they are pre-populated
    // Only reset the assessment filter
    resetAssessment();
  }
  
  // Reset assessment filter
  function resetAssessment() {
    assessmentFilter.innerHTML = '<option value="">Select Assessment</option>';
    assessmentFilter.disabled = true;
    loadStudentsBtn.disabled = true;
  }
  
  // Initialize the form
  function initializeForm() {
    // Initialize the filters
    classFilter.value = '';
    streamFilter.disabled = true;
    subjectFilter.disabled = true;
    assessmentFilter.disabled = true;
    loadStudentsBtn.disabled = true;
    marksTableContainer.classList.add('hidden');
    noSelectionMessage.classList.remove('hidden');
  }
  
  // Initialize the form
  initializeForm();
});
