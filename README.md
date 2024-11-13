# PeopleOne - PHP Authentication System

A simple user authentication system implemented with PHP, MySQL, and Bootstrap. This system provides essential authentication features, including user registration, login, session management, and protection against CSRF attacks. The UI is built using Bootstrap for responsiveness and accessibility.

---

## Features

- **User Registration**: Users can create accounts with unique usernames, valid email addresses, and secure passwords.
- **User Login**: Login functionality with session-based authentication.
- **Logout**: Users can securely log out, destroying the session.
- **Password Security**: Passwords are hashed with `password_hash()` for secure storage.
- **CSRF Protection**: CSRF tokens are used to prevent cross-site request forgery attacks.
- **Input Validation**: Client-side and server-side validation for secure and clean data inputs.
- **Responsive Design**: The UI is built with Bootstrap, making it responsive and accessible.

---

## Database Setup

1. **Create a MySQL Database**:
   
   Create a new database (e.g., `auth_system`) on your MySQL server.

2. **Create the Users Table**:

   Run the following SQL command to create the `users` table:

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );



## Running Locally

### Prerequisites:
- **PHP 7.4+** (or higher)
- **MySQL database server**
- Local server environment (e.g., XAMPP, WAMP, MAMP, etc.)

### Step 1: Set Up the Server:
- Download and install a local server environment such as [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/).
- Start the Apache and MySQL services in your chosen server environment.

### Step 2: Place the Project Files:
- Copy the project files (including `index.php`, `login.php`, `register.php`, etc.) into the `htdocs` (XAMPP) or `www` (WAMP) directory.

### Step 3: Create the Database:
- Open phpMyAdmin (usually accessible at `http://localhost/phpmyadmin`).
- Create a new database (e.g., `auth_system`).
- Run the SQL script from the **Database Setup** section to create the necessary tables.

### Step 4: Configure the Database Connection:
- Open the `config.php` file and update it with your MySQL database credentials as described in the **Configure Database Connection** section.

### Step 5: Access the Application:
- Open your browser and visit `http://localhost/auth_system` to view the authentication system in action.



## Usage


### Register:

- Go to `register.php` to create a new account.
- Input validation ensures:
  - Usernames are unique.
  - Emails are valid and unique.
  - Passwords meet the complexity requirements.
- Temporary or disposable email domains (e.g., `mailinator.com`, `tempmail.com`) are blocked during registration.

### Login:

- Go to `login.php` and enter your username/email and password.
- If the credentials are correct, you’ll be redirected to `dashboard.php`.

### Dashboard:

- After logging in, you’ll have access to a personalized dashboard.
- The dashboard will display user-specific content, including recent activity and account details.

### Logout:

- Log out via the link in the sidebar to end the session.
- This will destroy the session and return you to the login page.

## Security Features

### Password Hashing:
- Passwords are securely hashed using PHP's `password_hash()` function before being stored in the database. This ensures that even if the database is compromised, passwords remain protected.

### CSRF Protection:
- All forms are protected with CSRF tokens. A unique CSRF token is generated and validated before processing form submissions, which prevents cross-site request forgery attacks.

### SQL Injection Prevention:
- All SQL statements use prepared statements with bound parameters, preventing SQL injection attacks. This ensures that user input is treated as data and not executable code.

---

## Code Highlights

### CSRF Token Generation and Validation:
- The `csrf.php` file contains functions for generating and validating CSRF tokens. A token is generated when the form is created and stored in the session. It is then validated upon form submission to ensure the request is legitimate.

### Session Management:
- PHP sessions are used to manage user authentication. When a user successfully logs in, a session is started, and the user’s information is stored in the session. This ensures that users must be logged in to access the dashboard and other protected pages.

### Username Uniqueness Validation:
- During registration, the system checks if the chosen username is already taken. If the username is already in use, the system provides an error message and prompts the user to choose a different one.

### Blocking Temporary Emails:
- The registration form blocks disposable or temporary email addresses (e.g., from services like `mailinator.com` and `tempmail.com`) to help prevent fake or spam registrations.

### Toggle Password Visibility:
- JavaScript is used in the login and registration forms to allow users to toggle password visibility. This improves the user experience by letting users see the password they are typing.
