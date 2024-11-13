##Auth System
A simple user authentication system implemented with PHP, MySQL, and Bootstrap. This system provides essential authentication features, including user registration, login, session management, and protection against CSRF attacks. The UI is built using Bootstrap for responsiveness and accessibility.

Features
     User Registration: Users can create accounts with unique usernames, valid email addresses, and secure passwords.
     User Login: Login functionality with session-based authentication.
     Logout: Users can securely log out, destroying the session.
     Password Security: Passwords are hashed with password_hash() for secure storage.
     CSRF Protection: CSRF tokens are used to prevent cross-site request forgery attacks.
     Input Validation: Client-side and server-side validation for secure and clean data inputs.
     Responsive Design: The UI is built with Bootstrap, making it responsive and accessible.



Configure Database Connection:

    Update config.php with your database credentials.

            Start Local Server:
                   Use XAMPP, WAMP, or a similar tool to start your local server and access the project at http://localhost/auth_system.


Usage
             Register:

                 Go to register.php to create a new account.
                 Input validation ensures usernames and emails are unique, with password complexity requirements.
                 Temporary/disposable email domains are blocked during registration.

             Login:

                  Go to login.php and enter your username/email and password.
                  If valid, you’ll be redirected to dashboard.php.
             Dashboard:

                 After logging in, access personalized content on the dashboard, including recent activity and user details.
             Logout:

                  Log out via the link in the sidebar to end the session and return to the login page.

Security Features
            Password Hashing: Passwords are hashed using password_hash() for secure storage.
            CSRF Protection: Forms are protected with a CSRF token generated in csrf.php.
            SQL Injection Prevention: All SQL statements use prepared statements to prevent injection attacks.
        
Code Highlights
            CSRF Token Generation and Validation:
            csrf.php contains functions for generating and validating CSRF tokens.
            Session Management:
                  Sessions are initialized and managed to control user access to dashboard.php.
            Username Uniqueness Validation:
                  The registration form checks if the username is already taken and provides a notification if so.
            Blocking Temporary Emails:
                  Temporary or disposable email domains (e.g., mailinator.com, tempmail.com) are blocked during registration for security and integrity.
            Toggle Password Visibility:
                  JavaScript provides users the ability to toggle password visibility in the login and registration forms.
