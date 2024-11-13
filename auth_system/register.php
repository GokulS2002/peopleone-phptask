<?php
include 'config.php';
include 'csrf.php';

$usernameError = $emailError = $passwordError = $generalError = $successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        $generalError = "Invalid CSRF token. Please reload the page and try again.";
    } else {
        
        $username = htmlspecialchars($_POST['username']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        
        $disposableDomains = ['mailinator.com', 'tempmail.com', '10minutemail.com', 'fakeinbox.com'];
        $emailDomain = substr(strrchr($email, "@"), 1);

     
        if (empty($username)) {
            $usernameError = "Username is required.";
        } elseif (empty($email)) {
            $emailError = "Email is required.";
        } elseif (!$email) {
            $emailError = "Please enter a valid email address.";
        } elseif (in_array($emailDomain, $disposableDomains)) {
            $emailError = "Temporary or disposable email addresses are not allowed.";
        } elseif (empty($password)) {
            $passwordError = "Password is required.";
        } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[!@#$%^&*]/', $password)) {
            $passwordError = "Password must be at least 8 characters, include an uppercase letter and a special character.";
        } else {
         
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
            $stmt->execute(['username' => $username, 'email' => $email]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                if ($existingUser['username'] === $username) $usernameError = "Username already exists.";
                if ($existingUser['email'] === $email) $emailError = "Email already exists.";
            } else {
            
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $passwordHash])) {
                    $successMessage = "Registration successful! You can now <a href='login.php'>login here</a>.";
                    $username = '';
                    $email = '';
                    $password = '';
                } else {
                    $generalError = "An error occurred. Please try again.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="container card-container">
    <div class="card mx-auto p-4" style="max-width: 500px;">
        <h2 class="text-center mb-4">Create an Account</h2>

       
        <?php if ($generalError) : ?>
            <div class="alert alert-danger text-center"><?php echo $generalError; ?></div>
        <?php elseif ($successMessage) : ?>
            <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form id="registerForm" action="register.php" method="POST" novalidate>
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control <?php echo $usernameError ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                <div class="invalid-feedback"><?php echo $usernameError; ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?php echo $emailError ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                <div class="invalid-feedback"><?php echo $emailError; ?></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?php echo $passwordError ? 'is-invalid' : ''; ?>" id="password" name="password" required>
                <div class="invalid-feedback"><?php echo $passwordError; ?></div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script >
document.getElementById('registerForm').addEventListener('submit', function (event) {
    let isValid = true;

    const usernameField = document.getElementById('username');
    if (usernameField.value.trim() === '') {
        usernameField.classList.add('is-invalid');
        usernameField.nextElementSibling.textContent = 'Username is required.';
        isValid = false;
    } else {
        usernameField.classList.remove('is-invalid');
        usernameField.nextElementSibling.textContent = '';
    }

    
    const emailField = document.getElementById('email');
    if (emailField.value.trim() === '') {
        emailField.classList.add('is-invalid');
        emailField.nextElementSibling.textContent = 'Email is required.';
        isValid = false;
    } else {
        emailField.classList.remove('is-invalid');
        emailField.nextElementSibling.textContent = '';
    }

 
    const passwordField = document.getElementById('password');
    const password = passwordField.value.trim();
    if (password === '') {
        passwordField.classList.add('is-invalid');
        passwordField.nextElementSibling.textContent = 'Password is required.';
        isValid = false;
    } else if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*]/.test(password)) {
        passwordField.classList.add('is-invalid');
        passwordField.nextElementSibling.textContent = 'Password must be 8 characters long, with an uppercase letter and a special character.';
        isValid = false;
    } else {
        passwordField.classList.remove('is-invalid');
        passwordField.nextElementSibling.textContent = '';
    }

 
    if (!isValid) {
        event.preventDefault();
    }
});

</script>
 
</script>
</body>
</html>