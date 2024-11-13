<?php
    include 'config.php';
    include 'csrf.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    $loginError = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!validate_csrf_token($_POST['csrf_token'])) {
            die("Invalid CSRF token");
        }
        

        $identifier = htmlspecialchars($_POST['identifier']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :identifier OR email = :identifier");
        $stmt->execute(['identifier' => $identifier]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $loginError = "Invalid credentials";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container card-container rounded">
        <div class="card mx-auto p-4" style="max-width: 500px;">
            <h2 class="text-center mb-4">Login</h2>
            <form id="loginForm" action="login.php" method="POST" novalidate>
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

                <div class="mb-3">
                    <label for="identifier" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" id="identifier" name="identifier" required>
                    <div class="text-danger" id="identifierError"></div> <!-- Error message container -->
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div class="text-danger" id="passwordError"></div> <!-- Error message container -->
                </div>

                <!-- Display login error if any -->
                <?php if ($loginError) { echo "<div class='text-danger text-center mb-3'>$loginError</div>"; } ?>

                <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Sign up here</a></p>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
    </body>
    </html>