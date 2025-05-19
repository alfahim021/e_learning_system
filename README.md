# E-Learning System

A simple, modular PHP-based E-Learning system implementing user registration, login, profile management, course enrollment, and assignment submission features following MVC principles.

## Features

- User registration and login with secure password hashing
- User profile view and management
- List of courses with enrollment functionality
- Assignment submission and viewing
- Clean and organized MVC project structure

## Folder Structure

e_learning_system/
├── config.php # Database and app configuration
├── index.php # Main router and entry point
├── controllers/ # Request handling controllers
│ ├── CourseController.php
│ ├── LoginController.php
│ ├── ProfileController.php
│ └── RegistrationController.php
├── database/
│ ├── db.php # Database connection setup
│ └── schema.sql # Database schema (create tables)
├── models/ # Data model classes encapsulating DB logic
│ ├── Assignment.php
│ ├── Course.php
│ ├── Enrollment.php
│ └── User.php
├── views/ # HTML/PHP view templates
│ ├── assignment_submit.php
│ ├── assignment_view.php
│ ├── courses.php
│ ├── login.php
│ ├── profile.php
│ └── register.php
├── assets/ # Static files (CSS, JS, images)
│ ├── css/
│ │ └── style.css
│ └── js/
│ └── script.js
└── README.md # Project documentation

markdown
Copy

## Installation and Setup

1. Clone or download the repository.

2. Import the database schema:  
   - Use tools like **phpMyAdmin** or **MySQL CLI**.  
   - Run the SQL commands from `database/schema.sql` to create the database and tables.

3. Place the project folder in your PHP server root directory (`htdocs` for XAMPP).

4. Start your local server and visit:  
   `http://localhost/e_learning_system/index.php`

## Usage

- Register a new account or login with existing credentials.  
- Browse courses and enroll.  
- Submit assignments and view submissions.  
- Manage your profile.

## Dependencies

- PHP 7.4 or higher  
- MySQL / MariaDB  
- A local development server like XAMPP, WAMP, or MAMP

## Security Notes

- Passwords are hashed securely using PHP's `password_hash()`.  
- Prepared statements prevent SQL injection.  
- Session management protects user authentication.

## Contributing

Feel free to fork and submit pull requests. For bugs or feature requests, please open an issue.

## License

This project is open-source and free to use.

## Contact

For questions or help, email: alfahim021@gmail.com
