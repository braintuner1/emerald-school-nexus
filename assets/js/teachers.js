
document.addEventListener('DOMContentLoaded', function() {
  // Mock data for teachers
  const mockTeachers = [
    {
      id: 'tch-1',
      staffId: 'TCH001',
      firstName: 'John',
      lastName: 'Smith',
      gender: 'Male',
      email: 'john.smith@emeraldschool.edu',
      subjectsTaught: ['Mathematics', 'Physics'],
      classAssigned: 'Form 4',
      joinDate: '2020-01-15'
    },
    {
      id: 'tch-2',
      staffId: 'TCH002',
      firstName: 'Mary',
      lastName: 'Johnson',
      gender: 'Female',
      email: 'mary.johnson@emeraldschool.edu',
      subjectsTaught: ['English', 'History'],
      classAssigned: 'Form 3',
      joinDate: '2020-02-10'
    },
    {
      id: 'tch-3',
      staffId: 'TCH003',
      firstName: 'Robert',
      lastName: 'Davis',
      gender: 'Male',
      email: 'robert.davis@emeraldschool.edu',
      subjectsTaught: ['Chemistry', 'Biology'],
      classAssigned: 'Form 2',
      joinDate: '2021-03-05'
    },
    {
      id: 'tch-4',
      staffId: 'TCH004',
      firstName: 'Sarah',
      lastName: 'Wilson',
      gender: 'Female',
      email: 'sarah.wilson@emeraldschool.edu',
      subjectsTaught: ['Geography', 'Social Studies'],
      classAssigned: 'Form 1',
      joinDate: '2021-04-20'
    },
    {
      id: 'tch-5',
      staffId: 'TCH005',
      firstName: 'Michael',
      lastName: 'Brown',
      gender: 'Male',
      email: 'michael.brown@emeraldschool.edu',
      subjectsTaught: ['Kiswahili', 'Social Studies'],
      classAssigned: '',
      joinDate: '2022-01-10'
    },
    {
      id: 'tch-6',
      staffId: 'TCH006',
      firstName: 'Emily',
      lastName: 'Taylor',
      gender: 'Female',
      email: 'emily.taylor@emeraldschool.edu',
      subjectsTaught: ['Mathematics', 'Physics'],
      classAssigned: '',
      joinDate: '2022-02-15'
    },
    {
      id: 'tch-7',
      staffId: 'TCH007',
      firstName: 'David',
      lastName: 'Anderson',
      gender: 'Male',
      email: 'david.anderson@emeraldschool.edu',
      subjectsTaught: ['English', 'History'],
      classAssigned: '',
      joinDate: '2022-05-20'
    },
    {
      id: 'tch-8',
      staffId: 'TCH008',
      firstName: 'Jessica',
      lastName: 'Thomas',
      gender: 'Female',
      email: 'jessica.thomas@emeraldschool.edu',
      subjectsTaught: ['Chemistry'],
      classAssigned: '',
      joinDate: '2022-06-10'
    },
    {
      id: 'tch-9',
      staffId: 'TCH009',
      firstName: 'Richard',
      lastName: 'Moore',
      gender: 'Male',
      email: 'richard.moore@emeraldschool.edu',
      subjectsTaught: ['Biology'],
      classAssigned: '',
      joinDate: '2022-08-15'
    },
    {
      id: 'tch-10',
      staffId: 'TCH010',
      firstName: 'Catherine',
      lastName: 'Clark',
      gender: 'Female',
      email: 'catherine.clark@emeraldschool.edu',
      subjectsTaught: ['Geography'],
      classAssigned: '',
      joinDate: '2022-09-20'
    },
    {
      id: 'tch-11',
      staffId: 'TCH011',
      firstName: 'James',
      lastName: 'Walker',
      gender: 'Male',
      email: 'james.walker@emeraldschool.edu',
      subjectsTaught: ['Physics'],
      classAssigned: '',
      joinDate: '2023-01-10'
    },
    {
      id: 'tch-12',
      staffId: 'TCH012',
      firstName: 'Linda',
      lastName: 'Hall',
      gender: 'Female',
      email: 'linda.hall@emeraldschool.edu',
      subjectsTaught: ['Mathematics'],
      classAssigned: '',
      joinDate: '2023-02-15'
    },
    {
      id: 'tch-13',
      staffId: 'TCH013',
      firstName: 'William',
      lastName: 'Young',
      gender: 'Male',
      email: 'william.young@emeraldschool.edu',
      subjectsTaught: ['English'],
      classAssigned: '',
      joinDate: '2023-03-20'
    },
    {
      id: 'tch-14',
      staffId: 'TCH014',
      firstName: 'Karen',
      lastName: 'White',
      gender: 'Female',
      email: 'karen.white@emeraldschool.edu',
      subjectsTaught: ['History'],
      classAssigned: '',
      joinDate: '2023-04-10'
    },
    {
      id: 'tch-15',
      staffId: 'TCH015',
      firstName: 'Thomas',
      lastName: 'Lewis',
      gender: 'Male',
      email: 'thomas.lewis@emeraldschool.edu',
      subjectsTaught: ['Geography'],
      classAssigned: '',
      joinDate: '2023-05-15'
    }
  ];

  let teachers = [...mockTeachers];
  let filteredTeachers = [...teachers];
  
  // DOM Elements
  const teacherSearch = document.getElementById('teacherSearch');
  const genderFilter = document.getElementById('genderFilter');
  const classFilter = document.getElementById('classFilter');
  const resetFiltersBtn = document.getElementById('resetFiltersBtn');
  const teachersTable = document.getElementById('teachersTable').querySelector('tbody');
  const addTeacherBtn = document.getElementById('addTeacherBtn');
  const addTeacherModal = document.getElementById('addTeacherModal');
  const closeModalBtn = document.querySelector('.close-modal');
  const cancelTeacherBtn = document.getElementById('cancelTeacherBtn');
  const saveTeacherBtn = document.getElementById('saveTeacherBtn');
  const addTeacherForm = document.getElementById('addTeacherForm');
  const subjectsContainer = document.getElementById('subjectsContainer');
  
  // Summary Elements
  const totalStaff = document.getElementById('totalStaff');
  const formTeachers = document.getElementById('formTeachers');
  const maleTeachers = document.getElementById('maleTeachers');
  const femaleTeachers = document.getElementById('femaleTeachers');
  const startRecord = document.getElementById('startRecord');
  const endRecord = document.getElementById('endRecord');
  const totalRecords = document.getElementById('totalRecords');
  
  // Initialize the page
  function init() {
    renderTeachers();
    updateSummary();
    setupEventListeners();
  }
  
  // Render teachers in the table
  function renderTeachers() {
    teachersTable.innerHTML = '';
    
    if (filteredTeachers.length === 0) {
      const row = document.createElement('tr');
      row.innerHTML = '<td colspan="8" class="text-center">No teachers found</td>';
      teachersTable.appendChild(row);
      return;
    }
    
    filteredTeachers.forEach(teacher => {
      const row = document.createElement('tr');
      
      // Format join date
      const joinDate = new Date(teacher.joinDate);
      const formattedDate = joinDate.toLocaleDateString('en-US', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
      
      row.innerHTML = `
        <td>${teacher.staffId}</td>
        <td>${teacher.firstName} ${teacher.lastName}</td>
        <td>${teacher.gender}</td>
        <td>${teacher.email}</td>
        <td>${teacher.subjectsTaught.join(', ')}</td>
        <td>${teacher.classAssigned || 'N/A'}</td>
        <td>${formattedDate}</td>
        <td>
          <div class="actions">
            <button class="btn-icon" title="Edit Teacher" data-id="${teacher.id}">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn-icon" title="View Details" data-id="${teacher.id}">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn-icon delete-btn" title="Delete Teacher" data-id="${teacher.id}">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </td>
      `;
      
      teachersTable.appendChild(row);
    });
    
    // Setup delete buttons
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const teacherId = this.getAttribute('data-id');
        if (confirm('Are you sure you want to delete this teacher?')) {
          deleteTeacher(teacherId);
        }
      });
    });
    
    // Update record counts
    totalRecords.textContent = teachers.length;
    startRecord.textContent = filteredTeachers.length > 0 ? '1' : '0';
    endRecord.textContent = filteredTeachers.length;
  }
  
  // Update summary statistics
  function updateSummary() {
    totalStaff.textContent = teachers.length;
    formTeachers.textContent = teachers.filter(teacher => teacher.classAssigned).length;
    maleTeachers.textContent = teachers.filter(teacher => teacher.gender === 'Male').length;
    femaleTeachers.textContent = teachers.filter(teacher => teacher.gender === 'Female').length;
  }
  
  // Setup event listeners
  function setupEventListeners() {
    // Search and filters
    teacherSearch.addEventListener('input', filterTeachers);
    genderFilter.addEventListener('change', filterTeachers);
    classFilter.addEventListener('change', filterTeachers);
    resetFiltersBtn.addEventListener('click', resetFilters);
    
    // Modal controls
    addTeacherBtn.addEventListener('click', openAddTeacherModal);
    closeModalBtn.addEventListener('click', closeAddTeacherModal);
    cancelTeacherBtn.addEventListener('click', closeAddTeacherModal);
    saveTeacherBtn.addEventListener('click', saveNewTeacher);
    
    // Subject select handling
    document.querySelector('.subject-select').addEventListener('change', handleSubjectSelect);
  }
  
  // Filter teachers based on search and filters
  function filterTeachers() {
    const searchTerm = teacherSearch.value.toLowerCase();
    const genderValue = genderFilter.value;
    const classValue = classFilter.value;
    
    filteredTeachers = teachers.filter(teacher => {
      // Search term filter
      const matchesSearch = !searchTerm ||
        teacher.firstName.toLowerCase().includes(searchTerm) || 
        teacher.lastName.toLowerCase().includes(searchTerm) ||
        teacher.staffId.toLowerCase().includes(searchTerm) ||
        teacher.email.toLowerCase().includes(searchTerm);
      
      // Gender filter
      const matchesGender = !genderValue || teacher.gender === genderValue;
      
      // Class filter
      let matchesClass = true;
      if (classValue === 'none') {
        matchesClass = !teacher.classAssigned;
      } else if (classValue) {
        matchesClass = teacher.classAssigned === classValue;
      }
      
      return matchesSearch && matchesGender && matchesClass;
    });
    
    renderTeachers();
  }
  
  // Reset all filters
  function resetFilters() {
    teacherSearch.value = '';
    genderFilter.value = '';
    classFilter.value = '';
    
    filteredTeachers = [...teachers];
    renderTeachers();
  }
  
  // Delete a teacher
  function deleteTeacher(id) {
    teachers = teachers.filter(teacher => teacher.id !== id);
    filteredTeachers = filteredTeachers.filter(teacher => teacher.id !== id);
    
    renderTeachers();
    updateSummary();
    
    // Show success message
    alert('Teacher successfully deleted');
  }
  
  // Open add teacher modal
  function openAddTeacherModal() {
    addTeacherModal.style.display = 'flex';
    addTeacherForm.reset();
    
    // Reset subjects container
    subjectsContainer.innerHTML = `
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
    `;
    
    // Add event listener to the new select
    document.querySelector('.subject-select').addEventListener('change', handleSubjectSelect);
  }
  
  // Close add teacher modal
  function closeAddTeacherModal() {
    addTeacherModal.style.display = 'none';
  }
  
  // Handle subject select change
  function handleSubjectSelect(e) {
    const selects = document.querySelectorAll('.subject-select');
    const lastSelect = selects[selects.length - 1];
    
    // If this is the last select and it has a value, add a new one
    if (e.target === lastSelect && e.target.value !== '') {
      const newRow = document.createElement('div');
      newRow.className = 'subject-row';
      newRow.innerHTML = `
        <select name="subjects[]" class="form-select subject-select">
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
      `;
      
      subjectsContainer.appendChild(newRow);
      
      // Add event listener to the new select
      newRow.querySelector('.subject-select').addEventListener('change', handleSubjectSelect);
    }
  }
  
  // Save new teacher
  function saveNewTeacher(e) {
    e.preventDefault();
    
    // Form validation
    if (!addTeacherForm.checkValidity()) {
      alert('Please fill in all required fields');
      return;
    }
    
    // Get form values
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const staffId = document.getElementById('staffId').value;
    const gender = document.getElementById('gender').value;
    const email = document.getElementById('email').value;
    const classAssigned = document.getElementById('classAssigned').value;
    
    // Get subjects
    const subjectSelects = document.querySelectorAll('.subject-select');
    const subjects = [];
    
    subjectSelects.forEach(select => {
      if (select.value) {
        subjects.push(select.value);
      }
    });
    
    // Create new teacher object
    const newTeacher = {
      id: `tch-${Date.now()}`,
      staffId,
      firstName,
      lastName,
      gender,
      email,
      subjectsTaught: subjects,
      classAssigned,
      joinDate: new Date().toISOString().split('T')[0]
    };
    
    // Add to teachers array
    teachers.push(newTeacher);
    filteredTeachers.push(newTeacher);
    
    // Re-render and update summary
    renderTeachers();
    updateSummary();
    
    // Close modal
    closeAddTeacherModal();
    
    // Show success message
    alert('Teacher added successfully');
  }
  
  // Initialize the page
  init();
});
