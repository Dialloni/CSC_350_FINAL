# PHP Judging Application

This is a PHP-based web application designed for judges to evaluate projects and submit grades. The application includes features for both judges and admins, allowing for secure login, grade submission, and grade management.

## Features
- **Judge Dashboard**:
  - Submit grades for various evaluation criteria.
  - Add comments for each evaluation.
  - View submitted grades dynamically.
  - Calculate total scores automatically.

- **Admin Dashboard**:
  - View all submitted grades.
  - Manage judges and their evaluations.

- **Dynamic Total Calculation**:
  - Automatically calculates the total score based on the grades entered by the judge.

- **Secure Login**:
  - Separate login for judges and admins.
  - Admin credentials are hardcoded for simplicity.

## Technologies Used
- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Styling**: Custom CSS with modern design elements.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/php-judging-app.git

## Project Structure
```
php-judging-app/
├── public/                     # Publicly accessible files
│   ├── index.php               # Main entry point for the application
│   ├── login.php               # Login form for judges and admins
│   ├── register.php            # Registration form for judges
│   ├── judge_dashboard.php     # Grading interface for judges
│   ├── admin_dashboard.php     # Admin interface for managing grades and users
│   ├── styles.css              # CSS styles for the application
│   └── logout.php              # Logout functionality
├── src/                        # Source files for backend logic
│   ├── db/
│   │   └── connection.php      # Database connection setup
│   ├── controllers/
│   │   ├── authController.php  # User authentication functions
│   │   ├── judgeController.php # Judge-related operations
│   │   └── adminController.php # Admin-related operations
│   └── models/
│       ├── Judge.php           # Judge model
│       ├── Admin.php           # Admin model
│       └── Grade.php           # Grade model
├── database/                   # Database-related files
│   └── schema.sql              # SQL schema for database setup
├── config/                     # Configuration files
│   └── config.php              # Configuration settings (e.g., database credentials)
├── README.md                   # Project documentation
├── composer.json               # Composer dependencies
└── LICENSE                     # License file
```

## Installation
1. Clone the repository:
   ```
  git clone --->
   ```
2. Navigate to the project directory:
   ```
   cd php-judging-app
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```
4. Set up the database by running the SQL schema:
   ```
   mysql -u username -p < database/schema.sql
   ```
5. Configure your database settings in `config/config.php`.

## Usage
- Access the application by navigating to `public/index.php` in your web browser.
- Judges can log in using their credentials and will be directed to the grading interface.
- Admin users can log in to access the admin dashboard and manage grades and users.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.# CSC_350_FINAL
