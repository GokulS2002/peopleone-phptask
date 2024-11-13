document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
});
document.getElementById('loginForm').addEventListener('submit', function (event) {

    document.getElementById('identifierError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    let isValid = true;

    const identifierField = document.getElementById('identifier');
    if (identifierField.value.trim() === '') {
        document.getElementById('identifierError').textContent = 'Please enter your username or email.';
        isValid = false;
    }

 
    const passwordField = document.getElementById('password');
    if (passwordField.value.trim() === '') {
        document.getElementById('passwordError').textContent = 'Please enter your password.';
        isValid = false;
    }

  
    if (!isValid) {
        event.preventDefault();
    }
});