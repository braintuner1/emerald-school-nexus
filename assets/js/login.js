
document.addEventListener('DOMContentLoaded', function() {
  // Simple password visibility toggle
  const passwordField = document.getElementById('password');
  
  if (passwordField) {
    // Create eye icon for password toggle
    const eyeIcon = document.createElement('i');
    eyeIcon.className = 'fas fa-eye password-toggle';
    eyeIcon.style.position = 'absolute';
    eyeIcon.style.right = '1rem';
    eyeIcon.style.top = '50%';
    eyeIcon.style.transform = 'translateY(-50%)';
    eyeIcon.style.cursor = 'pointer';
    eyeIcon.style.color = '#666';
    
    // Add the eye icon to the password field container
    passwordField.parentNode.style.position = 'relative';
    passwordField.parentNode.appendChild(eyeIcon);
    
    // Toggle password visibility on click
    eyeIcon.addEventListener('click', function() {
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.className = 'fas fa-eye-slash password-toggle';
      } else {
        passwordField.type = 'password';
        eyeIcon.className = 'fas fa-eye password-toggle';
      }
    });
  }
  
  // Form validation example
  const loginForm = document.querySelector('.login-form');
  
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      // This is a frontend validation example
      // The actual authentication happens in the PHP file
      
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value;
      
      if (username === '') {
        e.preventDefault();
        alert('Please enter your username');
        return;
      }
      
      if (password === '') {
        e.preventDefault();
        alert('Please enter your password');
        return;
      }
      
      // If all validations pass, the form will submit normally
    });
  }
});
