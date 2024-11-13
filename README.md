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

